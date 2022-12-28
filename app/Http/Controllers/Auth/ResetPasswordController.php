<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin')
        {
//            return redirect()->route("admin")->with("toast","Admin Login Successful");
            return 'admin-home';  // admin dashboard path
        } elseif (Auth::user()->role == 'author') {
//            return redirect()->route("home")->with("toast","Student Login Successful");
            return 'author-home';  // member dashboard path
        }else{
            return 'home';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
