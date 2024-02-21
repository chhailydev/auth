<?php

namespace Modules\AuthenticationModule\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\AuthenticationModule\App\Models\auth_user;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = "/home";

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function loginForm(){
        return view('authenticationmodule::auth.login.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($this->attemptLogin($request)){
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function username(){
        return 'email';
    }

    protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();

        return $this->authenticated($request, $this->guard()->user())
        ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request){
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
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
