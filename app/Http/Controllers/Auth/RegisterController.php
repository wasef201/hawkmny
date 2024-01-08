<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewAssociationRegisterdNotification;
use App\Mail\WelcomeEmail;
use Mail;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(): View
    {

        $sections = User::SECTIONS;
        $areas = City::query()->where('type', City::AREA)->get();
        return view('auth.register', compact('sections', 'areas'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'section' => ['required', 'int'],
            'area' => ['required', 'int'],
            'city' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'logo' => ['required',  'image','max:10000'],
            'payment_receipt' => ['required',  'file','max:10000'],
            'phone' => ['required', 'phone:SA' , 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'term' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data): User
    {
//        dd($data['logo']);
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'section' => $data['section'],
            'area_id' => $data['area'],
            'city_id' => $data['city'],
            'phone'   => $data['phone'],
            'approved' => 0 ,
            'type' => 'association' ,
            'logo' => $data['logo'],
            'payment_receipt' => $data['payment_receipt'],
            'password' => Hash::make($data['password']),
        ]);


        $admins = User::where('type' , 'admin')->get();

        Mail::to($data['email'])->send(new WelcomeEmail);


        foreach ($admins as $admin) {
            $admin->notify(new NewAssociationRegisterdNotification($user));
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $data = $this->validator($request->all())->validate();



        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')?->store('associations');
        }

        if ($request->hasFile('payment_receipt')) {

            $data['payment_receipt'] = $request->file('payment_receipt')?->store('associations');
        }

        $user = $this->create($data);

        event(new Registered($user));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
