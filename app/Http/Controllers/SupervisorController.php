<?php

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\LoginInfoEmail;
class SupervisorController extends Controller
{

    final public function index(): View
    {
        return view('pages.supervisor.index');
    }

    final public function create(): View
    {
        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        $scopes = User::SCOPES;
        $associations = User::query()->where('type', User::ASSOCIATION)
            ->whereNull('supervisor_id')->get();
        return view('pages.supervisor.create',
            compact('sections', 'areas', 'scopes', 'associations'));
    }

    final public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'scope' => ['required', 'string'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $supervisor = User::query()->create(array_merge($validated, [
            'type' => User::SUPERVISOR,
            'city_id' => $request->get('city'),
            'area_id' => $request->get('area'),
            'password' => Hash::make($validated['password']),
            'approved' => 1 , 
            ]));
        if($request->has('associations') && $request->get('scope') === User::SCOPE_LIMIT) {
          User::query()->whereIn('id', $request->get('associations'))
              ->update(['supervisor_id' => $supervisor->id]);
        }

        Mail::to($supervisor->email)->send(new LoginInfoEmail($validated['email'], $validated['password'] , $validated['name'] )); 
        return redirect()->route('supervisor.index')
            ->with(['flash' => 'تم اضافة حساب المشرف بنجاح']);
    }

    final public function edit(User $supervisor): View
    {
        $supervisor->load('associations');
        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        $scopes = User::SCOPES;
        $associations = User::query()->where('type', User::ASSOCIATION)
            ->where(function ($q) use($supervisor){
                $q->whereNull('supervisor_id')->orWhere('supervisor_id', $supervisor->id);
            })
            ->get();
        return view('pages.supervisor.edit', compact('sections', 'areas', 'supervisor', 'scopes', 'associations'));
    }

    final public function update(User $supervisor,Request $request): RedirectResponse
    {
        \DB::beginTransaction();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'scope' => ['required', 'string'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$supervisor->id],
        ]);
        $supervisor->update(array_merge($validated, [
            'city_id' => $request->get('city'),
            'area_id' => $request->get('area'),
        ]));
        User::query()->where('supervisor_id', $supervisor->id)
        ->update(['supervisor_id' => null]);
        if($request->has('associations') && $request->get('scope') === User::SCOPE_LIMIT) {
            User::query()->whereIn('id', $request->get('associations'))
                ->update(['supervisor_id' => $supervisor->id]);
        }
        \DB::commit();
        return redirect()->route('supervisor.index')
            ->with(['flash' => 'تم تعديل حساب المشرف بنجاح']);
    }

    /**
     * @param int $id
     * @return int
     */
    final public function destroy(int $id): int
    {
        \DB::beginTransaction();
        User::query()->where('supervisor_id', $id)
            ->update(['supervisor_id' => null]);
         User::destroy($id);
         \DB::commit();
         return 1;
    }

    final public function changePassword(User $supervisor, Request $request)
    {
      $request->validate([
           'password' => 'required|min:6|confirmed'
       ]);
       $supervisor->update([
           'password' => Hash::make($request->get('password'))
       ]);
        return back()->with(['flash' => 'تم تعديل كلمة مرور المشرف بنجاح']);
    }

}
