<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Field;
use App\Models\FinancialAppraisalUser;
use App\Models\FinancialInput;
use App\Models\Review;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;


class FinancialService
{
    private ExpressionLanguage $expressionLanguage;
    /**
     * @property $financialInputs
     */
    private $financialInputs;

    public function __construct(ExpressionLanguage $expressionLanguage)
    {
        $this->expressionLanguage = $expressionLanguage;
    }


    /**
     * @param $user_id
     * @return array
     */
    public static function getUserInputs($user_id): array
    {
        return DB::table('financial_inputs as fi')
            ->select(['financial_value', 'key'])
            ->where('user_id', $user_id)
            ->leftJoin('financial_input_users', 'fi.id', 'financial_input_id')
            ->pluck('financial_value', 'key')
            ->toArray();
    }


    /**
     * @param $user_inputs
     * @param $count_inputs
     * @return Validator
     */
    public function validateUserInputs($user_inputs, $count_inputs)
    {
        return Validator::make(
            [
                'p' => $user_inputs
            ],
            [
                'p' => "min:$count_inputs",
                'p.*' => 'required|numeric'
            ]);
    }

    /**
     * @return int
     */
    public static function getFinancialPerformanceStandardId(): int
    {
        return Standard::Financial_ID;
    }


    /**
     * @param $user_id
     * @return array|null
     */
    public function compute_financial2($user_id): array
    {
        $user = auth()->user();

        $review = Review::where('user_id', '=', auth()->id())->with('standards', 'answers')->first();

        if (!$review) {
            $review = new review;
            $review->user_id = Auth::id();
            $review->status = Review::IN_PROGRESS;
            $review->save();
        }
        $standard = Standard::findOrFail(Standard::Financial_ID);

        $review_standard = $review->standards()->where('standard_id', $standard->id)->first();
        if (!$review_standard) {

            $total_standard_questions = $standard->questions()->root()->choical()->count();
            $review->standards()->create([
                'field_id' => null,
                'question_id' => $standard->questions()->root()->choical()->first()?->id,
                'practice_id' => null,
                'progress' => 0,
                'degree' => 0,
                'total_standard_questions' => $total_standard_questions,
                'answered_question_count' => 0,
                'standard_id' => $standard->id,
            ]);
        }

        $details = [];
        $user_inputs = $this->getUserInputs($user_id);
        $financial_inputs = $this->getFinancialInputs();
        $count_inputs = $financial_inputs->count();
        $validator = $this->validateUserInputs($user_inputs, $count_inputs);
        if ($validator->fails()) {

            return [];
        }
        $appraisal = FinancialAppraisalUser::firstOrCreate(['user_id'=> auth()->id()]);

        $indicators = Field::where('standard_id', Standard::Financial_ID)
            ->with('practices.questions.choices.answers')->get();
        $main_sum = 0;
        $analyticalIndicatorsCounter = 0;
        foreach ($indicators as $main_indicator) {
            $analytical_sum = 0;

            foreach ($main_indicator->practices as $analyticalIndicator) {
                foreach ($analyticalIndicator->questions as $question) {

                    if ($question->question_type == 'financial_equation') {

                        $eq = $question->equation($appraisal->duration_type);
                        $degree = null;
                        $result = $this->evaluateEquation($eq, $user_inputs);

                        foreach ($question->choices as $result_condition) {
                            $isConditionApplied = $this->evaluateEquation($result_condition->description, ['r' => $result]);
                            if ($isConditionApplied) {
                                $degree = null;
                                if ($result !== null) {
                                    $degree = $this->evaluateEquation($result_condition->name, ['r' => $result]);

                                }
                                $answer_degree=$degree ? $degree * $analyticalIndicator->degree / 100 : $degree;
                                $answer_degree=$answer_degree>0?$answer_degree:0;
                                Answer::updateOrCreate([
                                    'question_id' => $question->id,
                                    'review_id' => $review->id,
                                    'standard_id' => $standard->id,
                                ], [
                                    'choice_id' => $result_condition->id,
                                    'degree' =>$answer_degree ,
                                ]);

                                break;
                            }
                        }

                        foreach ($financial_inputs as $financial_input) {
                            $eq = str_replace($financial_input->key, $financial_input->label, $eq);
                        }

                        $details[$question->id]['field'] = $main_indicator->name;
                        $details[$question->id]['field_weight'] = $main_indicator->degree;
                        $details[$question->id]['practice'] = $analyticalIndicator->name;
                        $details[$question->id]['practice_weight'] = $analyticalIndicator->degree;
                        $details[$question->id]['equation'] = $eq;
                        $details[$question->id]['result'] = $result;
                        $details[$question->id]['degree'] = $degree * $analyticalIndicator->degree / 100;

                        $analytical_sum += $degree * $analyticalIndicator->degree / 100;
                        if ($analytical_sum > 100) {
                            dd($degree, $analytical_sum, $analyticalIndicator);
                        }
                        $analyticalIndicatorsCounter++;
                    }
                }
            }
            $main_sum += $analytical_sum;//* $main_indicator->degree ;
            if ($main_sum > 100) {
                dd('sum exceed 100 !!!',$main_sum, $analyticalIndicator);
            }
        }

        $this->updateReview($review, $standard, $main_sum);
        return [
            'details' => $details,
            'final_result' => $main_sum
        ];
    }



    public function evaluateEquation($equation, $variables)
    {
        try {
            $r = $this->expressionLanguage->evaluate($equation, $variables);

        } catch (\DivisionByZeroError $e) {
            $r = null;
        }
        return $r;
    }

    public function getFinancialInputs()
    {
        if (!$this->financialInputs) {
            $this->financialInputs = FinancialInput::orderBy('id', 'desc')->get();
        }
        return $this->financialInputs;
    }

    public function readableEquation($eq)
    {
        $financial_inputs = $this->getFinancialInputs();
        foreach ($financial_inputs as $financial_input) {
            $eq = str_replace($financial_input->key, $financial_input->label, $eq);
        }
        return $eq;
    }

    public function computeLegalReviewerResult($result, $reservation_type, $reservations_count = null)
    {
        $r = null;
        $equation = '(1-(0.1*o))*r';
        if ($reservation_type == FinancialAppraisalUser::NO_OPINION) {
            $r = 0;
        } elseif ($reservation_type == FinancialAppraisalUser::NO_RESERVATIONS) {
            $r = $result;
        } elseif ($reservation_type == FinancialAppraisalUser::HAVE_RESERVATIONS) {
            $r = $this->evaluateEquation($equation, [
                'o' => $reservations_count,
                'r' => $result
            ]);
        }

        return $r;

    }


    public  function updateReview($review, $standard, $main_sum){
        $appraisal = FinancialAppraisalUser::firstWhere('user_id', auth()->id());
        $result = $this->computeLegalReviewerResult($main_sum, $appraisal->reservation_type, $appraisal->reservations_count);
        $organization_result = $review->answers()
            ->where('standard_id', $standard->id)
            ->whereHas('question', function($q){
                $q->choical();
            })
            ->sum('degree');

        $financial_indicator = ($organization_result * 0.5 ) + ($result * 0.5);
        $appraisal->update([
            'performance_result_1' => $main_sum,
            'performance_result' => $result,
            'organization_result' => $organization_result,
            'result'=>$financial_indicator,
        ]);

        // update review standard
        $answered_question_count = Answer::where([
            ['review_id', '=', $review->id],
            ['standard_id', '=', $standard->id],
        ])->whereHas('question', function ($query) {
            $query->root()->choical();
        })->count();


        $total_standard_questions = $standard->questions()->root()->choical()->count();
        $review_standard_degree = $review->standards()->where('standard_id', '!=',Standard::Financial_ID)->sum('degree')+$financial_indicator;

        $review->standards()->firstOrCreate(['standard_id'=> $standard->id])
            ->update([
                'total_standard_questions' => $total_standard_questions,
                'answered_question_count' => $answered_question_count,
                'degree' => number_format($financial_indicator, Standard::Financial_ID)
            ]);
        // end update review standard

        // update review

        $review->update([
            'degree'=>number_format($review_standard_degree,2)
        ]);

    }
}
