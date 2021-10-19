<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Services\ToDoList\ToDoListService;
use App\Http\Resources\ToDoListResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->request = new Request();
         $this->todoList = new ToDoList();
         $this->todoListResource = new ToDoListResource($this->request);
    }
    public function index()
    {
        return (new ToDoListService($this->todoList, $this->todoListResource))->details();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        ToDoList::create([
            'user_id' =>  $request->user,
            'todo_content' => $request->todo_content,
        ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return (new ToDoListService($this->todoList, $this->todoListResource))->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ToDoList::where('id',$id)->delete();

        return $this->index();
    }
}
