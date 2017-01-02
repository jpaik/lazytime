<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Todolist;

class TasksController extends Controller
{
  /*
  ====================================
  API functionality goes under here
  ====================================
  */
  public function get($id) {
    $user = \Auth::user();
    $task = Task::find($id);
    $list = Todolist::find($task->list_id);

    if ($task != null) {
      if ($user->id != $list->user_id) {
        return response('Unauthorized', 401);
      }

      return response()->json([
        'id' => $task->id,
        'list_id'=> $task->list_id,
        'description' => $task->description,
        'position' => $task->position,
        'state' => $task->state,
        'comment' => $task->comment,
        'color' => $task->color,
        'created_at' => $task->created_at,
        'updated_at' => $task->updated_at
      ]);
    } else {
      return response('Not found', 404);
    }
  }

  /**
   * Store the task
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function post(Request $request)
  {
      $this->validate($request, Task::$create_validation_rules);
      $data = $request->only('list_id', 'description', 'position');

      $user = \Auth::user();
      $list = Todolist::find($data['list_id']);
      if ($user->id != $list->user_id) {
        return response('Unauthorized', 401);
      }

      $task = Task::create($data);
      if($task){
        return response()->json([
          'id' => $task->id,
          'list_id'=> $task->list_id,
          'description' => $task->description,
          'position' => $task->position,
          'state' => $task->state,
          'comment' => $task->comment,
          'color' => $task->color,
          'created_at' => $task->created_at,
          'updated_at' => $task->updated_at
        ]);
      }
      return response('Error', 500);
  }

  /*Update the task*/
  public function update(Request $request) {
    $task = Task::find($request->id);
    $data = $request->only('description', 'position', 'state');

    $user = \Auth::user();
    $list = Todolist::find($task->list_id);

    if ($task != null) {
      if ($user->id != $list->user_id) {
        return response('Unauthorized', 401);
      }

      if($data['description'] != ""){
        $task->description = $data['description'];
      }
      if($data['position'] != ""){
        $task->position = $data['position'];
      }
      if($data['state'] != ""){
        $task->state = $data['state'];
      }

      if($task->save()){
        return response()->json([
          'id' => $task->id,
          'list_id'=> $task->list_id,
          'description' => $task->description,
          'position' => $task->position,
          'state' => $task->state,
          'comment' => $task->comment,
          'color' => $task->color,
          'created_at' => $task->created_at,
          'updated_at' => $task->updated_at
        ]);
      }
      else{
        return response('Error', 500);
      }
    } else {
      return response('Not found', 404);
    }
  }


  /*
  ====================================
  Web App functionality goes under here
  ====================================
  */

}
