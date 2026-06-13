<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

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
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $validatedData = $request->validated();
        $subject->update($validatedData);

        return response()->json([
            'message' => 'Subject updated successfully',
            'subject' => $subject
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted successfully'
        ], 200);
    }
}
