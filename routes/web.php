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

Route::get('tasks/index', [\App\Http\Controllers\Task\IndexController::class, 'index'])->name('tasks.index');
Route::get('task/create', [\App\Http\Controllers\Task\CreateController::class, 'create'])->name('tasks.create');
Route::post('task/store', [\App\Http\Controllers\Task\StoreController::class, 'store'])->name('tasks.store');
Route::get('task/show/{task}', [\App\Http\Controllers\Task\ShowController::class, 'show'])->name('tasks.show');
Route::get('task/{task}/edit', [\App\Http\Controllers\Task\EditController::class, 'edit'])->name('tasks.edit');
Route::patch('task/{task}', [\App\Http\Controllers\Task\UpdateController::class, 'update'])->name('tasks.update');
Route::delete('task/index/{task}', [\App\Http\Controllers\Task\DeleteController::class, 'destroy'])->name('tasks.destroy');


Route::get('tags/index', array(\App\Http\Controllers\Tag\IndexController::class, 'index'))->name('tags.index');
Route::get('tag/create', array(\App\Http\Controllers\Tag\CreateController::class, 'create'))->name('tags.create');
Route::post('tag/store', array(\App\Http\Controllers\Tag\StoreController::class, 'store'))->name('tags.store');
Route::get('tag/show/{id}', array(\App\Http\Controllers\Tag\ShowController::class, 'show'))->name('tags.show');
Route::get('tag/{id}/edit', array(\App\Http\Controllers\Tag\EditController::class, 'edit'))->name('tags.edit');
Route::patch('tag/{id}', array(\App\Http\Controllers\Tag\UpdateController::class, 'update'))->name('tags.update');
Route::delete('tag/index/{id}', array(\App\Http\Controllers\Tag\DeleteController::class, 'destroy'))->name('tags.destroy');


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', array(\App\Http\Controllers\Admin\IndexController::class, 'index'))->name('admin.index');

    Route::get('/users', array(\App\Http\Controllers\Admin\User\IndexController::class, 'index'))->name('admin.users');
    Route::get('/user/{id}/edit', array(\App\Http\Controllers\Admin\User\EditController::class, 'edit'))->name('admin.editUser');
    Route::get('/users/create', array(\App\Http\Controllers\Admin\User\CreateController::class, 'create'))->name('admin.createUser');
    Route::post('/users', array(\App\Http\Controllers\Admin\User\StoreController::class, 'store'))->name('admin.storeUser');
    Route::patch('/users/{id}', array(\App\Http\Controllers\Admin\User\UpdateController::class, 'update'))->name('admin.updateUser');
    Route::delete('/users/{id}', array(\App\Http\Controllers\Admin\User\DeleteController::class, 'destroy'))->name('admin.destroy');

    Route::get('/tasks', array(\App\Http\Controllers\Admin\Task\IndexController::class, 'index'))->name('admin.tasks');
    Route::get('/tasks/{id}/edit', array(\App\Http\Controllers\Admin\Task\EditController::class, 'edit'))->name('admin.editTask');
    Route::patch('/tasks/{id}', array(\App\Http\Controllers\Admin\Task\UpdateController::class, 'update'))->name('admin.updateTask');


    Route::get('/tags', array(\App\Http\Controllers\Admin\Tag\IndexController::class, 'index'))->name('admin.tags');
    Route::get('/tags/{id}/edit', array(\App\Http\Controllers\Admin\Tag\EditController::class, 'edit'))->name('admin.tags.edit');
    Route::patch('/tags/{id}', array(\App\Http\Controllers\Admin\Tag\UpdateController::class, 'update'))->name('admin.tags.update');
    Route::delete('/tags/{id}', array(\App\Http\Controllers\Admin\Tag\DeleteController::class, 'destroy'))->name('admin.tags.destroy');
});

