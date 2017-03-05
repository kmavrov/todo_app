<?php

namespace App\Http\Controllers;

use Project;
use Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

    public function getProjectsForDeletionCount() {

        $isAdmin = Auth::user()->admin;
        
        if (!$isAdmin) {
        	return false;
        }

        $projectsForDeletion = \App\Project::where('delete_pending', 1)
                ->select(DB::raw('COUNT(*)'))
                ->get();

        return array('forDeletion' => count($projectsForDeletion));
    }

    public function getProjectsForDeletion(Request $request) {

        $isAdmin = Auth::user()->admin;
        
        if (!$isAdmin) {
        	return false;
        }

        $page = $request->input('current');
        $rowCount = $request->input('rowCount');
        $sort = $request->input('sort');
        $sortColumn = array_keys($sort);
        $sortColumn = $sortColumn[0];

        $projectsForDeletion = \App\Project::where('delete_pending', 1)
                ->select(DB::raw('projects.id, projects.name, users.email'))
                ->leftJoin('users', 'users.id', '=', 'projects.user_id')
                ->orderBy($sortColumn, $sort[$sortColumn])
                ->get();

        $returnedProjects = [];

        foreach ($projectsForDeletion as $project) {
            $tmpProj            = [];
            $tmpProj['id']      = $project->id;
            $tmpProj['name']    = $project->name;
            $tmpProj['email']   = $project->email;
            $tmpProj['accept']  = '';
            $tmpProj['reject']  = '';
            $returnedProjects[] = $tmpProj;
        }

        
        $responseArray = array(
    		"current" => $page,
    		"rowCount" => $rowCount,
    		"rows" => $returnedProjects,
    		"total" => count($returnedProjects)
        );
        return $responseArray;
    }

    public function acceptDeletion(Request $request) {
    	$isAdmin = Auth::user()->admin;

    	if (!$isAdmin) {
    		return false;
    	}

        $project_id = $request->input('project_id');
        $project = \App\Project::find($project_id);

        $project->delete();
    }
	
	public function rejectDeletion(Request $request) {
    	$isAdmin = Auth::user()->admin;

    	if (!$isAdmin) {
    		return false;
    	}

        $project_id = $request->input('project_id');
        $project = \App\Project::find($project_id);

        $project->delete_pending = 0;
        $project->save();
	}
}
