<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_confirmed'
    ];

    protected $casts = [
      'account_type' => 'integer',
    ];

    public static $login_validation_rules = [
      'email' => 'required|email|exists:users',
      'password' => 'required'
    ];

    public static $register_validation_rules = [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed|min:6',
      'password_confirmation' => 'required|min:6'
    ];

    public static $update_validation_rules = [
      'first_name' => 'required',
      'last_name' => 'required'
    ];

    public static $update_email_validation_rules = [
      'email' => 'required|email|unique:users'
    ];

    public static $pass_change_validation_rules = [
      'old_password' => 'required',
      'password' => 'required|confirmed|min:6',
      'password_confirmation' => 'required|min:6'
    ];

    public function isAdmin(){
      return $this->account_type == 314;
    }
}
