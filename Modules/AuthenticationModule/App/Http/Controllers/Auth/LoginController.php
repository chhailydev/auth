<?php

namespace Modules\AuthenticationModule\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\AuthenticationModule\App\Models\auth_user;

class LoginController extends Controller
{
    protected $redirectTo = "/home";

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function loginForm(){
        return view('authenticationmodule::auth.login.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'))->with('success', 'Login successful!');
        }

        return redirect()->back()->withInput()->withErrors([
                'alert' => 'Invalid email or password. Please try again!',
        ]);
    }

    public function username(){
        return 'email';
    }

    protected function attemptLogin(Request $request)
    {
        // Your authentication logic here
        return $this->guard(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('home');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function create(array $data){
        return auth_user::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
