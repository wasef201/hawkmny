<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use Auth;
class ProfileController extends Controller
{
    final public function index()
    {
        $user = \Auth::user();
        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        return view('pages.account.index', compact('user', 'sections', 'areas'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function update(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'phone' => ['required', 'string'],
            'number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->id()],
            'logo' => ['nullable' , 'image'] ,
        ];

        $user = Auth::user();
        if($user->type == User::ADMIN){

          $rules = array_merge($rules, [
                'section' => ['nullable'],
                'number' => ['nullable', 'string'],
            ]);
        }

        $validated = $request->validate($rules);
        $user->update(array_merge($validated, [
            'city_id' => $request->get('city'),
            'area_id' => $request->get('area'),
        ]));
        if ($request->hasFile('logo')) {
            // dd(basename($request->file('logo')->store('associations')));
            $user->logo = basename($request->file('logo')->store('associations'));
            $user->save();
        }
        return back()->with(['flash' => 'تم تعديل بيانات الملف الشخصي بنجاح']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        \Auth::user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        return back()->with(['flash' => 'تم تعديل كلمة المرور بنجاح']);
    }

}
