<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $attendances = Attendance::with('student')->get();
          return response()->json(['attendances'=>$attendances],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $validatedData =$request->validated();

        $attendance = Attendance::create($validatedData);

        return response()->json(['message'=>'Attendance recorded successfully','attendance'=>$attendance],201);
        
    }
}
