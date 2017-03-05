<?php

namespace App\Http\Controllers;

use Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
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
     * Return all of the projects for the current user
     *
     * @return \Illuminate\Http\Response
     */
    public function getProjects()
    {
        $id = Auth::user()->id;

        $projects = \App\Project::where('user_id', $id)
                ->select(DB::raw('
                    projects.id as id, 
                    projects.name, 
                    projects.description, 
                    count(tasks.id) as all_tasks, 
                    sum(CASE WHEN tasks.completed = true then 1 else 0 end) as completed_count, 
                    projects.start_date, 
                    projects.due_date,
                    projects.delete_pending'))
                ->leftJoin('tasks', 'tasks.project_id', '=', 'projects.id')
                ->orderBy('projects.id', 'desc')
                ->groupBy('id')
                ->get();

        $returnedProjects = [];

        foreach ($projects as $project) {
            $tmpProj                    = [];
            $tmpProj['name']            = $project->name;
            $tmpProj['text']            = $project->name;
            $tmpProj['text']            .= ' ('.$project->completed_count.'/'.$project->all_tasks.')';
            $tmpProj['completed']       = $project->completed;
            $tmpProj['id']              = $project->id;
            $tmpProj['description']     = $project->description;
            $tmpProj['all_tasks']       = $project->all_tasks;
            $tmpProj['delete_pending']  = $project->delete_pending;
            $tmpProj['completed_count'] = $project->completed_count;
            $tmpProj['start_date']      = date('m/d/Y', strtotime($project->start_date));
            $tmpProj['due_date']        = date('m/d/Y', strtotime($project->due_date));
            $tmpProj['completed']       = $project->completed_count == $project->all_tasks ? true : false;
            $returnedProjects[]         = $tmpProj;
        }

        return \Response::json($returnedProjects);
    }

    /**
    * Create a new project for the current user
    *  @param string name        - name of the project
    *  @param string description - project description
    *  @param date start_date    - start date of the project
    *  @param date due_date      - due date of the project
    */
    public function createNewProject(Request $request) {
        $input = $request->input('projectVariables');
        
        $project = new \App\Project();
        $user_id = Auth::user()->id;
        $project->name        = $input['name'];
        $project->user_id     = $user_id;
        $project->description = $input['description'];
        $project->start_date  = date('Y-m-d', strtotime($input['start_date']));
        $project->due_date    = date('Y-m-d', strtotime($input['due_date']));

        $project->save();
    }


    /**
    * Edit existing project for the current user
    *  @param integer id         - id of the selected project
    *  @param string name        - name of the project
    *  @param string description - project description
    *  @param date start_date    - start date of the project
    *  @param date due_date      - due date of the project
    */
    public function editExistingProject(Request $request) {
        $input = $request->input('projectVariables');

        $project = \App\Project::find($input['id']);
        
        $user_id = Auth::user()->id;
        if ($project->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }
        $project->name        = $input['name'];
        $project->description = $input['description'];
        $project->start_date  = date('Y-m-d', strtotime($input['start_date']));
        $project->due_date    = date('Y-m-d', strtotime($input['due_date']));

        $project->save();
    }


    /**
    * Deletes existing project for the current user
    *  @param integer id - id of the selected project
    */
    public function deleteProject(Request $request) {
        $id = $request->input('id');

        $project = \App\Project::find($id);
        
        $user_id = Auth::user()->id;
        if ($project->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }
        if (Auth::user()->admin) {
            $project->delete();
        } else {
            $project->delete_pending = 1;
        }
    }

    /**
    * Marks all project tasks as done
    *  @param integer id - id of the selected project
    */
    public function markProjectAsDone(Request $request) {
        $id = $request->input('id');
        
        $project = \App\Project::find($id);
        // dd($project->id);
        $user_id = Auth::user()->id;
        if ($project->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }

        DB::table('tasks')->where('project_id', '=', $id)->update(array('completed' => true));
    }
}
