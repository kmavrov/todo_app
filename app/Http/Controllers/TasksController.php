<?php

namespace App\Http\Controllers;

use Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return all of the tasks for the selected project
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasks(Request $request, $project_id)
    {
        $id = Auth::user()->id;
        $input = $request->all();

        $page = $request->input('current');
        $rowCount = $request->input('rowCount');
        $sort = $request->input('sort');
        $sortColumn = array_keys($sort);
        $sortColumn = $sortColumn[0];
        $tasks = \App\Task::where('project_id', $project_id)
                ->groupBy('id')
                ->orderBy($sortColumn, $sort[$sortColumn])
                ->limit($rowCount)
                ->offset(($page - 1) * $rowCount)
                ->get();


        $finalTasks = array();
        foreach ($tasks as $task) {
        	$tmpTask = array();

        	$tmpTask['id'] = $task->id;
        	$tmpTask['name'] = $task->name;
        	$tmpTask['description'] = $task->description;
        	$tmpTask['completed'] = $task->completed;
        	$tmpTask['updated_at'] =  date('m/d/Y', strtotime($task->updated_at));
        	$finalTasks[] = $tmpTask;
        }
        $responseArray = array(
    		"current" => $page,
    		"rowCount" => $rowCount,
    		"rows" => $finalTasks,
    		"total" => count($finalTasks)
        );
        return $responseArray;
    }

    /**
    * Edit existing task for the selected project
    *  @param integer id         - id of the selected task
    *  @param string name        - name of the task
    *  @param string description - task description
    *  @param bool completed     - completed status
    */
    public function editTask(Request $request) {
        $task_id     = $request->input('task_id');
        $completed   = $request->input('completed');
        $name        = $request->input('name');
        $description = $request->input('description');

        $task = \App\Task::find($task_id);
        
        if (isset($completed)) {
        	$task->completed = $completed ? 1 : 0;
        }
        if (isset($name)) {
        	$task->name = $name;
        }
        if (isset($description)) {
        	$task->description = $description;
        }

        $task->save();
    }

    /**
    * Delete existing task for the selected project
    *  @param integer id         - id of the selected task
    */
    public function deleteTask(Request $request) {
        $task_id = $request->input('task_id');

        $task = \App\Task::find($task_id);

        $task->delete();
    }

    /**
    * Create a new task for the current project
    *  @param string name        - name of the project
    *  @param string description - project description
    *  @param date start_date    - start date of the project
    *  @param date due_date      - due date of the project
    */
    public function createNewTask(Request $request) {
        $input = $request->input('taskVariables');

        $task = new \App\Task();
        
        $task->name        = $input['name'];
        $task->description = $input['description'];
        $task->project_id  = $input['project_id'];

        $task->save();
    }
}
