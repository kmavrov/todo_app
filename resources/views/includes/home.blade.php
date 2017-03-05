@extends('layouts.app')

@include('includes.popup')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-md-4 expand-to-bottom">
                        <div id="projects-toolbar" class="btn-toolbar">
                            <!-- <div class="btn-group" role="group" aria-label="Projects Toolbar"> -->
                                <button type="button" class="btn btn-success btn-group btn-group-sm" aria-label="Add Project" id="add-project-btn">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                                </button>
                                <button type="button" class="btn btn-primary btn-group btn-group-sm" aria-label="Edit Project" id="edit-project-btn">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-group btn-group-sm" aria-label="Delete Project" id="remove-project-btn">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove
                                </button>
                            <!-- </div> -->
                        </div>
                        <h4>Списък с проекти</h4>
                        <div id="projects-tree">
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Projects Toolbar">
                            <button type="button" class="btn btn-default btn-group btn-group-sm" aria-label="Add Project" id="add-project-btn">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                            </button>
                            <button type="button" class="btn btn-default btn-group btn-group-sm" aria-label="Edit Project" id="edit-project-btn">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                            </button>
                            <button type="button" class="btn btn-default btn-group btn-group-sm" aria-label="Delete Project" id="remove-project-btn">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove
                            </button>
                            <button type="button" class="btn btn-default btn-group btn-group-sm" aria-label="Delete Project" id="remove-project-btn">
                                <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export
                            </button>
                        </div>
                        <h4>Списък със задачите, към избрания проект</h4>
                        <table id="grid-basic" class="table table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
