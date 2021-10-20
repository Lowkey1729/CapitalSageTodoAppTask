<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected  $fillable = [
      'user_id', 'todo_content', 'completed'
    ];
    protected $casts = [
        'completed' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }
}
