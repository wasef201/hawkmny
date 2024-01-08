<?php

namespace App\Http\Controllers;

use App\Models\FinancialAppraisalUser;
use App\Models\FinancialInput;
use App\Models\FinancialInputUser;
use App\Models\Review;
use App\Models\Standard;
use App\Models\User;
use App\Services\FinancialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class FinancialInputController extends Controller
{
    //
    public function edit(Request $request, FinancialService $financialService)
    {
        if (\auth()->user()->type !== User::ASSOCIATION) {
            abort(401);
        }
        $appraisal=FinancialAppraisalUser::firstOrCreate(['user_id'=>\auth()->id()]);
        $financial_inputs = FinancialInput::whereNull('equation')->get();
        $user_financial_inputs = FinancialInputUser::where('user_id', \auth()->id())->get();
        $userInputsArr=$financialService->getUserInputs(\auth()->id());
        $review=Review::firstOrCreate(['user_id'=> \auth()->id()], [
            'status'=>Review::IN_PROGRESS
        ]);
        $review_id=$review->id;
        $questions=Standard::find(Standard::Financial_ID)
            ->questions()
            ->with('practice.field')
            ->with('answer', function ($q)use($review_id){
                $q->where('review_id', $review_id);
            })
            ->equational()->get();

        return view('pages.financial.edit', compact('userInputsArr','questions','appraisal', 'financial_inputs', 'user_financial_inputs'));
    }

    public function update(Request $request, FinancialService $financialService)
    {
        // user to edit his financial inputs
        $user = Auth::user();

        // authorization
        if (!(($user->type == User::ASSOCIATION))) {
            abort(401);
        }
        //validate
        $this->validator($request->all())->validate();

        $financial_inputs = $financialService->getFinancialInputs();
        $user_financial_inputs = $request->get('financial_inputs', []);
        $symbolsValues = [];
        // create array $symbolsValues that maps equations symbols to their values
        foreach ($financial_inputs as $financial_input) {
            $user_financial_inputs[$financial_input->id] = data_get($user_financial_inputs, $financial_input->id);
            $symbolsValues[$financial_input->key] = $user_financial_inputs[$financial_input->id];
        }
        // evaluate computed inputs that have equations
        foreach ($financial_inputs->whereNotNull('equation')->sortBy('id') as $financial_input) {
            $financial_value = null;
            $financial_value = $financialService->evaluateEquation($financial_input->equation, $symbolsValues);
            $symbolsValues[$financial_input->key] = $user_financial_inputs[$financial_input->id] = $financial_value;
        }

        FinancialAppraisalUser::updateOrCreate([
            'user_id'=>$user->id,
        ],
        $request->only(['duration_type', 'reservations_count', 'reservation_type'])
        );
        // update inputs in db
        foreach ($financial_inputs as $financial_input) {
            $financial_value = null;

            if (isset($user_financial_inputs[$financial_input->id])) {
                $financial_value = $user_financial_inputs[$financial_input->id];
            }
            FinancialInputUser::updateOrCreate([
                'user_id' => $user->id,
                'financial_input_id' => $financial_input->id,
            ],
                [
                    'financial_value' => $financial_value
                ]);

        }
         $financialService->compute_financial2($user->id);

        session()->flash('success', 'تم الحفظ بنجاح');
        return back();
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'financial_inputs' => 'required|array',
            'financial_inputs.*' => 'numeric|min:0|max:999999999999',
        ],[
            'financial_inputs.*.max'=>'يجب أن تكون قيمة هذا المؤشر مساوية أو أصغر ل :max.',
            'financial_inputs.*.min'=>'يجب أن تكون قيمة هذا المؤشر مساوية أو اكبر ل :min.',
            'financial_inputs.*.numeric'=>'يجب أن تكون قيمة هذا المؤشر رقمية '
        ]);
    }

}
