<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('guest:customer')->except('logout');
    }


    public function showCustomerLoginForm()
    {
        return view('booking.auth.login', ['route' => route('customer.login'), 'title' => 'customer']);
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        return redirect('/dashboard');
    }


    public function adminLogin(\Illuminate\Http\Request $request)
    {

        $this->validate($request, [
            'personal_id' => 'required',
            'password'    => 'required|min:6'
        ]);


        $user = Customer::where('personal_id', $request->personal_id)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                Auth::guard('customer')->loginUsingId($user->id, true);
                return redirect('/panel');
            }
        } else {

            return Redirect::back()->withErrors(['msg' => 'نام کاربری یا گذرواژه اشتباه است']);
        }

//        if (Auth::guard('customer')->attempt($request->only(['personal_id', 'password'],true))) {
//            return redirect('/panel');
//        }

        return back()->withInput($request->only('personal_id', 'remember'));
    }

    public function logoutPanel(Request $request)
    {

        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
