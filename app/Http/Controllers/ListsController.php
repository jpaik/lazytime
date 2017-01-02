<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Todolist;

class ListsController extends Controller
{
    /*
    ====================================
    API functionality goes under here
    ====================================
    */
    public function get($id) {
      $user = \Auth::user();
      $list = Todolist::find($id);

      if ($list != null) {
        if ($user->id != $list->user_id) {
          return response('Unauthorized', 401);
        }

        return response()->json([
          'id' => $list->id,
          'name' => $list->name,
          'description' => $list->description,
          'due_date' => $list->due_date,
          'position' => $list->position,
          'is_completed' => $list->is_completed,
          'priority' => $list->priority,
          'color' => $list->color,
          'created_at' => $list->created_at,
          'updated_at' => $list->updated_at
        ]);
      } else {
        return response('Not found', 404);
      }
    }

    public function post(Request $request) {
      $user = \Auth::user();
      $data = $request->only('name', 'description', 'position');
      $data['user_id'] = $user->id;
      $list = Todolist::create($data);

      if($list){
        return response()->json([
          'id' => $list->id,
          'name' => $list->name,
          'description' => $list->description,
          'due_date' => $list->due_date,
          'position' => $list->position,
          'is_completed' => $list->is_completed,
          'priority' => $list->priority,
          'color' => $list->color,
          'created_at' => $list->created_at,
          'updated_at' => $list->updated_at
        ]);
      }
      return response('Error', 500);
    }

    /*
    ====================================
    Web Application functionality goes under here
    ====================================
    */

    public function updatePosition(Request $request){
      $data = $request->only('id', 'position');
      $list = Todolist::find($data->id);
      $list->position = $data->position;
      if($list->save()){
        return response('Success', 200);
      }
      return response('Error', 500);
    }


}
