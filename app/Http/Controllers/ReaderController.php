<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Reader;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ResponseController;
class ReaderController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:reader')->except('logout');
    }

    public function sendResponse($response)
    {
        return response()->json($response, 200);
    }

    public function sendError($error, $code = 404)
    {
        $response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:readers',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Reader::create($input);
        if($user){
            $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration successfull..";
            $success['user']=$user;
            return $this->sendResponse($success);
        }
        else{
            $error = "Sorry! Registration is not successfull.";
            return $this->sendError($error, 401);
        }

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
       if (Reader::where('email', request()->email)->exists()){
           $user = Reader::where('email', request()->email)->first();
           // do the passwords match?
           if (!Hash::check(request()->password, $user->password)) {
               $error = "Incorrect password.";
               return $this->sendError($error, 401);
           }
           $success['token'] =  $user->createToken('token')->accessToken;
           $success['user']=$user;
           // return token in json response
           return $this->sendResponse($success);
       }else{
           return response()->json(array('error' => 'Email Address Not Found'));
       }
        // log the user in (needed for future requests)
//        Auth::login($user);
    }
}
