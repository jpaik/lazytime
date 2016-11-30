<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class EmailController extends Controller
{
   public function test($id){
      $user = User::findOrFail($id);
      \Mail::queue('emails.test', ['user'=>$user], function ($message) use ($user) {
        $message
          ->from('no-reply@lazyti.me', 'Lazytime')
          ->to('james@lazyti.me', 'James Paik')
          ->subject('Welcome to Lazytime, '.$user->name);
      });
      return redirect()->route('dashboard')->with('success', 'Email Sent');
    }

    public function send_confirmation(){
      $user = \Auth::user();
      if($user->email_confirmed){
        return redirect()->route('dashboard')->with('warning', 'Your email is already confirmed');
      }
      \Mail::queue('emails.confirmation', ['user'=>$user], function ($message) use ($user) {
        $message
          ->from('no-reply@lazyti.me', 'Lazytime')
          ->to($user->email, $user->first_name . ' ' . $user->last_name)
          ->subject('Welcome to Lazytime, '.$user->first_name);
      });
      return redirect()->route('confirm_email')->with('success', 'Confirmation code sent. Please check your email.');
    }

}
