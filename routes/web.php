<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/projects', 'ProjectsController@getProjects');
Route::post('/projects', 'ProjectsController@createNewProject');
Route::put('/projects', 'ProjectsController@editExistingProject');
Route::delete('/projects', 'ProjectsController@deleteProject');

Route::post('/projects/markAsDone', 'ProjectsController@markProjectAsDone');

Route::get('/tasks/{project_id}/', 'TasksController@getTasks');
Route::put('/tasks', 'TasksController@editTask');
Route::delete('/tasks', 'TasksController@deleteTask');
Route::post('/tasks', 'TasksController@createNewTask');

Route::get('/admin', 'AdminController@getProjectsForDeletionCount');
Route::get('/admin/getProjectsForDeletion', 'AdminController@getProjectsForDeletion');
Route::post('/admin/acceptDeletion', 'AdminController@acceptDeletion');
Route::post('/admin/rejectDeletion', 'AdminController@rejectDeletion');