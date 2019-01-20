<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;

class AuthController extends Controller
{
    //
     function sendMail($code,$mail){
        Mail::send('mail', ['code'=>$code], function ($m) use ($mail) {
            $m->from('waikovixstudio@gmail.com', 'SmartTrainer');
            $m->to($mail)
                ->subject('Verify your email address');
        });
    }
    public function Register(RegisterFormRequest $request){
        $user = new User;
        $confirmCode = str_random(30);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->calories  = $request->calories;
        $user->protein = $request->protein;
        $user->carbs = $request->carbs;
        $user->fat = $request->fat;
        $user->code = $confirmCode;
        $this->sendMail($confirmCode,$request->email);
        $user->save();
        
        return response()->json([
            'status'=>'succ'
        ]);
    }
    public function Login(Request $request){
        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token'=>$token
        ])
            ->header('Authorization', $token);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    
    public function confirmCode($code){
        $user = User::where('code',$code)->first();
        $user->isconfirm = 1;
        $user->save();
        return view('complete');
    }
}
