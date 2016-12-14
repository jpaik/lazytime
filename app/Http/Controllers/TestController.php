<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class TestController extends Controller
{
  /**
   * James god
   *
   * @return James god
   */
  public function jamesgod()
  {
    return view('jamesgod');
  }

  public function createList() {
    return view('test_todolist_create');
  }

}
