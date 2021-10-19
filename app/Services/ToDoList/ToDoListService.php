<?php

namespace  App\Services\ToDoList;

use App\Http\Resources\ToDoListResource;
use App\Models\TodoList;

class ToDoListService
{
    private $todoList;

    public  function  __construct(TodoList $todoList, ToDoListResource $todoListResource)
    {
       $this->todoList =  $todoList ;
       $this->todoListResource = $todoListResource;
    }

    public function  details()
    {
        return $this->todoListResource->collection($this->todoList->with('user')->get());
    }

    public function update($id, $request)
    {
        $todoList = $this->todoList->find($id);
        $todoList->update($request->all());

        return $this->details();
    }
}
