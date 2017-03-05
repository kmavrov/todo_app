@extends('layouts.app')


@section('content')
@include('includes.addproject')
@include('includes.addtask')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-md-4 expand-to-bottom">
                        <h2><span id="logo"></span> Projects</h2>
                        <div id="projects-toolbar" class="btn-toolbar">
                            <!-- <div class="btn-group" role="group" aria-label="Projects Toolbar"> -->
                                <button type="button" class="btn btn-success btn-group btn-group-sm" aria-label="Add Project" id="add-project-btn">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                                </button>
                                <button type="button" class="btn btn-primary btn-group btn-group-sm" aria-label="Edit Project" id="edit-project-btn">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-group btn-group-sm" aria-label="Remove Project" id="remove-project-btn">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove
                                </button>
                            <!-- </div> -->
                        </div>
                        <div class="alert alert-danger alert-dismissable" id="no-projects-selected-alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            No project selected
                        </div>
                        <div id="projects-tree">
                            
                        </div>
                    </div>
                    <div class="col-md-8" id="no-projects-selected"><h1>No project selected</h1></div>
                    <div class="col-md-8" id="project-info-fields">                        
                        <div id="pending-deletions">
                            <table id='deletion-grid'>
                                <thead>
                                    <tr>
                                        <th data-column-id="email" data-identifier="true">User e-mail</th>
                                        <th data-column-id="name" data-order="desc">Task name</th>
                                        <th data-column-id="accept" data-formatter="accept" data-sortable="false">Accept</th>
                                        <th data-column-id="reject" data-formatter="reject" data-sortable="false">Reject</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <p><strong>Name:</strong> <span id="project-name-field"></span></p>
                        <p><strong>Description:</strong> <span id="project-description-field"></span></p>
                        <p><strong>Start date: </strong> <span id="project-start-date-field"></span><strong> Due date: </strong> <span id="project-due-date-field"></span></p>
                        <p><strong>Completed: </strong> <span id="project-completion-field"></span></p>

                        <!-- <div class="btn-group" role="group" aria-label="Projects Toolbar"> -->
                            <button type="button" class="btn btn-success btn-group btn-group-sm" aria-label="Add Task" id="add-task-btn">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                            </button>
                            <button type="button" class="btn btn-primary btn-group btn-group-sm" aria-label="Edit Task" id="edit-task-btn">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-group btn-group-sm" aria-label="Delete Task" id="remove-task-btn">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove
                            </button>
                            <button type="button" class="btn btn-warning btn-group btn-group-sm" aria-label="Export Task" id="export-task-btn">
                                <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export
                            </button>
                        <!-- </div> -->
                        
                        <table id='tasks-grid'>
                            <thead>
                                <tr>
                                    <th data-column-id="name" data-identifier="true">Task name</th>
                                    <th data-column-id="description" data-order="desc">Description</th>
                                    <th data-column-id="completed" data-formatter="completed" data-order="desc">Status</th>
                                    <th data-column-id="actions" data-formatter="actions" data-sortable="false">Finished at</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
