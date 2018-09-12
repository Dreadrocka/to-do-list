<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskListResource;
use App\Http\Requests\TaskRequest;
use App\Category;

class Tasks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // needs to return multiple articles
        // so we use the collection method
        return TaskListResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        // get post request data for title and article
    $data = $request->only(["title", "notes", "dueDate"]);

    // create article with data and store in DB
    $task = Task::create($data);

    $categories = Category::parse($request->get("categories"));
    $task->setCategories($categories);

    return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
    // get the request data
    $data = $request->only(["title", "notes", "dueDate"]);

    // update the article
    $task->fill($data)->save();

    $categories = Category::parse($request->get("categories"));
    $task->setCategories($categories);

    // return the updated version
    return new TaskResource($task);
    }

    public function markComplete(TaskRequest $request, Task $task)
    {
        // get the request data
        $data = $request->only(["complete"]);

        // update the article
        $task->fill($data)->save();

        $categories = Category::parse($request->get("categories"));
        $task->setCategories($categories);

        // return the updated version
        return new TaskResource($task);
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

    // use a 204 code as there is no content in the response
    return response(null, 204);
    }
}
