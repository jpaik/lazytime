<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'list_id', 'description', 'position', 'state', 'comment', 'color'
    ];

    public static $create_validation_rules = [
      'description' => 'required'
    ];
}
