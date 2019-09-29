<?php

namespace App\Http\Controllers\Task;


use App\Http\Controllers\ApiController;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        // dd($usuarios);
        return $this->showAll($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [  
            'name' => 'required',
            'description' => 'required',
        ];


        $this->validate($request, $rules);

        $task = Task::create($request->all());

        return $this->showOne($task, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->showOne($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->fill($request->only([
            'name',
            'description',
            'status',
            'user_id',

        ]) );

        if($task->isClean()){
            return $this->errorResponse('Debes especificar al menos un valor a ser actualizado.', 422);
        }

        $task->save();

        return $this->showOne($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->showOne($task);
    }
}
