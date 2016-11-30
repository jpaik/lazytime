<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
  public function index(){
    return view('index');
  }

  public function login(){
      if(\Auth::user()){
        return redirect()->route('dashboard');
      }
      if(\Auth::viaRemember()){
         return redirect()->route('dashboard')->with('success', 'Welcome back!');
      }
      return view('auth.login');
  }

  public function handleLogin(Request $request){
        $this->validate($request, User::$login_validation_rules);
        $data = $request->only('email', 'password');
        $rem = false;
        if($request->remember_me == "true"){
          $rem = true;
        }
        if(\Auth::attempt($data, $rem)){
	        return redirect()->route('dashboard');
        }
        return back()->withInput()->withErrors(['email' => 'Email or password is invalid']);
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('/');
    }

    //Confirm Email Address
    public function confirm($confirmation_code){
      if(!$confirmation_code){
        return redirect()->route('/')->with('danger', 'Confirmation Code is empty');
      }
      if(\Auth::check()){
        if(\Auth::user()->email_confirmed){
          return redirect()->route('dashboard')->with('warning', 'You already verified your email.');
        }
      }
      $user = User::where('confirmation_code', $confirmation_code)->first();
      if(!$user){
        return redirect()->route('/')->with('danger', 'Invalid confirmation code');
      }
      $user->email_confirmed = 1;
      $user->confirmation_code = null;
      $user->save();
      if(\Auth::check()){
        return redirect()->route('dashboard')->with('success', 'Thank you for verifying your email.');
      }
      return redirect()->route('login')->with('success', 'Thank you for verifying your email! Please login.');
    }

    public function email(){
      $user = \Auth::user();
      if($user->email_confirmed){
        return redirect()->route('dashboard')->with('warning', 'Your email is already confirmed');
      }
      return view('auth.confirm', ['user'=> $user]);
    }

}
