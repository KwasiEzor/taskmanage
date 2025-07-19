<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', HomeController::class)->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::post('/projects/{project}/tasks', [ProjectController::class, 'createProjectTask'])->name('projects.tasks.store');
    Route::get('/projects/{project:slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project:slug}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project:slug}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/trashed', [ProjectController::class, 'trashed'])->name('projects.trashed');
    Route::patch('/projects/{project:slug}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{project:slug}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
});
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task:slug}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task:slug}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task:slug}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/trashed', [TaskController::class, 'trashed'])->name('tasks.trashed');
    Route::patch('/tasks/{task:slug}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::delete('/tasks/{task:slug}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.force-delete');
});
Route::get('/tasks/{task:slug}', [TaskController::class, 'show'])->name('tasks.show');

Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
Route::middleware('auth')->group(function () {
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment:slug}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/assignments/{assignment:slug}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/assignments/{assignment:slug}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
    Route::get('/assignments/trashed', [AssignmentController::class, 'trashed'])->name('assignments.trashed');
    Route::patch('/assignments/{assignment:slug}/restore', [AssignmentController::class, 'restore'])->name('assignments.restore');
    Route::delete('/assignments/{assignment:slug}/force-delete', [AssignmentController::class, 'forceDelete'])->name('assignments.force-delete');
});

Route::get('/assignments/{assignment:slug}', [AssignmentController::class, 'show'])->name('assignments.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
