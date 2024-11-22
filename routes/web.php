<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\MenuController as FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


use App\Exports\TasksExport;
use App\Http\Controllers\Back\AdminController;
use Maatwebsite\Excel\Facades\Excel;


Route::get('tasks/export-excel', function () {
    return Excel::download(new TasksExport, 'tasks_list.xlsx');
});

Route::get('tasks/export-csv', function () {
    return Excel::download(new TasksExport, 'tasks_list.csv');
});

Route::get('tasks/export-pdf', [TaskController::class, 'exportPdf']);


// Home
Route::name('home')->get('/', [FrontController::class, 'index']);
Route::name('category')->get('category/{category:slug}', [FrontController::class, 'category']);
Route::name('author')->get('author/{user}', [FrontController::class, 'user']);
Route::name('tag')->get('tag/{tag:slug}', [FrontController::class, 'tag']);

Route::prefix('menus')->group(function () {
    Route::name('menus.display')->get('{slug}', [FrontController::class, 'show']);
    Route::name('menus.search')->get('', [FrontController::class, 'search']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/', [UserController::class, 'show']);
});

Route::resource('users', UserController::class);
Route::get('advance', 'UserController@advance')->name('advance_search');
//Route::get('changeStatus', 'UserController@changeStatus');
Route::get('user/{id}',[ UserController::class, 'changeStatus']);
Route::get('/users/simple', 'UserController@simple')->name('simple_search');
//Route::get('/users/advance', 'UserController@advance')->name('advance_search');
Route::get('users-filter', [\App\Http\Controllers\UserController::class, 'filter'])->name('users.filter');



Route::prefix('menus')->group(function () {
    Route::name('menus.display')->get('{slug}', [FrontController::class, 'show']);
});

Route::name('category')->get('category/{category:slug}', [FrontController::class, 'category']);

/* Route::get('/', function () {
    return view('welcome');
}); */



Route::name('home')->get('/', [FrontController::class, 'index']);
//Route::view('/admin', 'admin.dashboard.index');
Route::get('/admin', [AdminController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['auth']], function() {
 //   Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('task/{id}',[ TaskController::class, 'changeStatus']);
   // route::resource('tasks', TaskController::class);
});

Route::resource('tasks', TaskController::class);

require __DIR__.'/auth.php';
