<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
    $list = List::find($task->list_id);

    if ($task != null) {
      if ($user->id != $list->user_id) {
        return response('Unauthorized', 401);
      }

      return response()->json([
        'task_id' => $task->id,
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

  /*
  ====================================
  Web App functionality goes under here
  ====================================
  */

  /**
   * Store the task
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $this->validate($request, Task::$create_validation_rules);
      $data = $request->only('list_id', 'description', 'position');
      $task = Task::create($data);
      if($task){
        return response()->json([
          'task_id' => $task->id,
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

}
