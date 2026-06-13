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
}
