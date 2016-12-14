<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
  protected $fillable = [
    'user_id', 'name', 'description', 'due_date', 'position', 'is_completed', 'priority', 'color'
  ];

  public static $create_validation_rules = [
    'name' => 'required'
  ];
}
