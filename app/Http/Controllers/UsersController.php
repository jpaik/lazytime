<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(\Auth::user()){
        return redirect()->intended('dashboard');
      }
      return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::$register_validation_rules);
        $data = $request->only('first_name', 'last_name', 'email' , 'password');
        $data['password'] = bcrypt($data['password']); //Hash
        $confirmation_code = str_random(32); //Generate a random 32-bit confirmation code
        $data['confirmation_code'] = $confirmation_code;
        $user = User::create($data);
        if($user){
          //We will create a default list for users, where they can just type in to the top input box and their tasks will appear here.
          $default_list = ['name' => 'Default List', 'description' => 'The list where uncategorized tasks go to.', 'position' => '0'];
          $default_list['user_id'] = $user->id;
          $list = Todolist::create($default_list);
          $user->default_list_id = $list->id;
          $user->save();

          \Auth::login($user);
          return redirect()->route('send_verification_code');
        }
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        if(!$id){
          return redirect()->route('viewUser', ['id'=>\Auth::user()->id]); //For admins
        }
        try{
        $user = User::findOrFail($id);
        if($user->id == \Auth::user()->id){
          return view('users.account')
            ->with(array('user'=> \Auth::user()));
        }
        elseif(\Auth::user()->isAdmin()){
          return view('users.account')
            ->with(['user'=> $user]);
        }
        else{
          return redirect()->route('dashboard')->with('warning', "You can't view their page");
        }
      }
      catch(ModelNotFoundException $e){
        return redirect()->route('dashboard')->withErrors(['404' => 'User Not Found!']);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate($request, User::$update_validation_rules);
        $data = $request->only('first_name', 'last_name', 'old_password', 'password');
        $is_pass_changed = false;
        $user = User::findOrFail($id);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        if($data['old_password']!= ""){
          $validate_pass = $this->validate($request, User::$pass_change_validation_rules);
          if(\Hash::check($data['old_password'], $user->password)){
            $user->password = bcrypt($data['password']);
            $is_pass_changed = true;
          }
          else{
            return back()->withInput()->with('danger', "Current password doesn't match.");
          }
        }
        if($user->save()){
          if($is_pass_changed){
            return back()->with('success','Account and password updated successfully.');
          }
          return back()->with('success','Account updated successfully.');
        }
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard(){
        return view('users.dashboard')
          ->with(['user'=> \Auth::user()]); //, 'lists'=> List::where('user_id', \Auth::user()->id)->orderBy('position', 'asc')->get()
    }

    public function settings(){
     return view('users.settings')
       ->with(['user'=> \Auth::user()]);
   }
}
