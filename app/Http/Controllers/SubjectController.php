<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubjectRequest;

class SubjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('students')->get();

        return response()->json(['subjects'=>$subjects],200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        
        $validatedData =$request->validated();
        

         $subject = Subject::create($validatedData);

         return response()->json(['message'=>'Subject created successfully','subject'=>$subject],201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load('students');
        return response()->json(['subject' => $subject], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
