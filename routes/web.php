<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {

    return view('home');
});

// displays all jobs- index
Route::get('/jobs', function() {
    $job = Job::with('employer')->latest()->cursorPaginate(5);

    return view('jobs.index', ['jobs' => $job ]);
});

// Create
Route::get('jobs/create',function() {
    return view('jobs.create');
});

// Edit

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Store or Persists a new job
Route::post('/jobs', function(){

    request()->validate([
        'title' =>['required', 'min:3'],
        'salary'=>['required']
    ]);


    Job::create([
        'title'=> request('title'),
        'salary' => request('salary'),
        'employer_id'=> 1
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
    'title' =>['required', 'min:3'],
    'salary'=>['required']
]);
    // authorize(on hold...)

    //update and persist
    $job = Job::findOrFail($id);

    $job->update([
        'title'=> request('title'),
        'salary'=> request('salary')
    ]);

    //redirect to job page
    return redirect('/jobs/' . $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    //authorize (on hold...)
    // delete
    $job = Job::findOrFail($id);
    $job->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
