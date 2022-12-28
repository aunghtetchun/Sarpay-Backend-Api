<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:reader')->except('logout');
    }


//    public function showReaderLoginForm()
//    {
//        return view('auth.login', ['url' => 'reader']);
//    }

//    public function readerLogin(Request $request)
//    {
//        $this->validate($request, [
//            'email'   => 'required|email',
//            'password' => 'required|min:6'
//        ]);
//
//        if (Auth::guard('reader')->attempt(
//            ['email' => $request->email,
//                'password' => $request->password],
//            $request->get('remember')
//        )) {
//            $user = $request->user();
//            $success['token'] =  $user->createToken('token')->accessToken;
//            return $this->sendResponse($success);
//
//            return redirect()->intended('/reader');
//        }
//        return back()->withInput($request->only('email', 'remember'));
//    }
}
