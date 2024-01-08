<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\FinancialInput;
use App\Models\FinancialInputUser;
use App\Models\User;
use App\Models\Review;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\LoginInfoEmail;
use App\Notifications\AssociationApprovingNotification;

class AssociationController extends Controller
{

    final public function index(): View
    {
        $total = User::where('type', User::ASSOCIATION)->count();
        $canCreateOrEditOrDelete = auth()->user()->type === User::ADMIN;

        return view('pages.association.index', compact('total', 'canCreateOrEditOrDelete'));
    }

    final public function create(): View
    {
        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        return view('pages.association.create',
            compact('sections', 'areas'));
    }

    final public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'phone' => ['required', 'string'],
            'number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'logo' => ['nullable' , 'image'] ,
        ]);



        $user = User::query()->create(array_merge($validated, [
            'type' => User::ASSOCIATION,
            'city_id' => $request->get('city'),
            'area_id' => $request->get('area'),
            'password' => Hash::make($validated['password']),
            'approved' => 1 ,
        ]));
        if ($request->hasFile('logo')) {
            $user->logo = $request->file('logo')->store('associations');
            $user->save();
        }
        Mail::to($user->email)->send(new LoginInfoEmail($validated['email'], $validated['password'] , $validated['name'] ));

        return redirect()->route('association.index')
        ->with(['flash' => 'تم اضافة حساب للجمعية بنجاح']);
    }

    final public function edit(User $association): View
    {
        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        return view('pages.association.edit', compact('sections', 'areas', 'association'));
    }


    public function show(User $association)
    {
        $association->load(['area', 'city', 'reviews' => fn($q) => $q->latest()]);
        $questions_count = Question::count();

        $last_review  = $association->reviews->first();


        $mo2sher_elhwkmah  = 0;
        if($last_review) {
            foreach ($last_review->standards as $standard) {
                $mo2sher_elhwkmah  += (( ($standard->degree) * (optional($standard->standard)->percentage/100) ) );
            }
        }

        $canEditOrDelete = auth()->user()->type === User::ADMIN;
        $auth_user = Auth::user();
        $user = User::findOrFail($association->id);
        if ( ! ($auth_user->type === User::ADMIN || ($auth_user->type===User::SUPERVISOR && $association->supervisor_id==$auth_user->id))) {
            abort(401);
        }
        $financial_inputs = FinancialInput::all();
        $user_financial_inputs = FinancialInputUser::where('user_id', $user->id)->get();
        return view('pages.association.show' ,
            compact('financial_inputs', 'user_financial_inputs','association' , 'mo2sher_elhwkmah' , 'last_review' , 'questions_count', 'canEditOrDelete'));
    }

    public function approve(User $association)
    {
        $association->approved = 1;
        $association->save();
        $association->notify(new AssociationApprovingNotification);
        return back()
        ->with(['flash' => 'تم الموافقه على الجمعيه بنجاح']);
    }

    final public function update(User $association,Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'phone' => ['required', 'string'],
            'number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$association->id],
            'featured'=>'nullable'
            ]);

        $validated['featured']=(boolean) $request->featured;
        $association->update(array_merge($validated, [
            'city_id' => $request->get('city'),
            'area_id' => $request->get('area'),
        ]));

        if ($request->hasFile('logo')) {
            Storage::delete($association->logo);
            $association->logo = $request->file('logo')->store('associations');
            $association->save();
        }
        return redirect()->route('association.index')
        ->with(['flash' => 'تم تعديل حساب الجمعية بنجاح']);
    }

    /**
     * @param int $id
     * @return int
     */
    final public function destroy(int $id): int
    {
        return User::destroy($id);
    }

    final public function changePassword(User $association, Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        $association->update([
            'password' => Hash::make($request->get('password'))
        ]);
        return back()->with(['flash' => 'تم تعديل كلمة مرور الجمعية بنجاح']);
    }

    public function reviews(User $association)
    {

        $last_review = Review::with(['answers' , 'standards' ])->where('user_id' , $association->id )->latest()->first();
        $total_degree = optional(optional($last_review)->answers)->sum('degree');
        return view('pages.association.reviews' , compact('association' , 'total_degree' , 'last_review' ) );
    }

}
