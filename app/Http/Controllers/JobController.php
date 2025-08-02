<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job = Job::with('employer')->latest()->simplePaginate(5);

        return view('jobs.index', ['jobs' => $job ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
            // validate
        request()->validate([
            'title' =>['required', 'min:3'],
            'salary'=>['required']
        ]);
        // authorize(on hold...)

        //update and persist
        // $job = Job::findOrFail($id);

        $job->update([
            'title'=> request('title'),
            'salary'=> request('salary')
        ]);

        //redirect to job page
        return redirect('/jobs/' . $job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
         $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
