<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('tasks/index', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
Route::get('task/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::post('task/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::get('task/show/{task}', [\App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
Route::get('task/{task}/edit', [\App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('task/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::delete('task/index/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');


Route::get('tags/index', array(\App\Http\Controllers\TagController::class, 'index'))->name('tags.index');
Route::get('tag/create', array(\App\Http\Controllers\TagController::class, 'create'))->name('tags.create');
Route::post('tag/store', array(\App\Http\Controllers\TagController::class, 'store'))->name('tags.store');
Route::get('tag/show/{id}', array(\App\Http\Controllers\TagController::class, 'show'))->name('tags.show');
Route::get('tag/{id}/edit', array(\App\Http\Controllers\TagController::class, 'edit'))->name('tags.edit');
Route::patch('tag/{id}', array(\App\Http\Controllers\TagController::class, 'update'))->name('tags.update');
Route::delete('tag/index/{id}', array(\App\Http\Controllers\TagController::class, 'destroy'))->name('tags.destroy');


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', array(\App\Http\Controllers\AdminController::class, 'index'))->name('admin.index');
    Route::get('/users', array(\App\Http\Controllers\AdminController::class, 'users'))->name('admin.users');
    Route::get('/tasks', array(\App\Http\Controllers\AdminController::class, 'tasks'))->name('admin.tasks');
    Route::get('/tasks/{id}/edit', array(\App\Http\Controllers\AdminController::class, 'editTask'))->name('admin.editTask');
    Route::patch('/tasks/{id}', array(\App\Http\Controllers\AdminController::class, 'updateTask'))->name('admin.updateTask');
    Route::get('/user/{id}/edit', array(\App\Http\Controllers\AdminController::class, 'editUser'))->name('admin.editUser');
    Route::patch('/users/{id}', array(\App\Http\Controllers\AdminController::class, 'updateUser'))->name('admin.updateUser');
    Route::get('/users/create', array(\App\Http\Controllers\AdminController::class, 'createUser'))->name('admin.createUser');
    Route::post('/users', array(\App\Http\Controllers\AdminController::class, 'storeUser'))->name('admin.storeUser');
    Route::delete('/users/{id}', array(\App\Http\Controllers\AdminController::class, 'destroyUser'))->name('admin.destroy');
    Route::get('/tags', array(\App\Http\Controllers\AdminController::class, 'tags'))->name('admin.tags');
    Route::get('/tags/{id}/edit', array(\App\Http\Controllers\AdminController::class, 'editTag'))->name('admin.tags.edit');
    Route::patch('/tags/{id}', array(\App\Http\Controllers\AdminController::class, 'updateTag'))->name('admin.tags.update');
    Route::delete('/tags/{id}', array(\App\Http\Controllers\AdminController::class, 'destroyTag'))->name('admin.tags.destroy');
});

