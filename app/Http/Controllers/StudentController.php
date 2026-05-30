<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentService;

    /**
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['profile', 'attendances', 'subjects'])->get();
        return response()->json(['students' => $students], 200);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:50',
            'age' => 'required|integer|min:18|max:30',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'city' => 'required|string|max:100',
            'blood_group' => 'required|string',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'exists:subjects,id'
        ]);

        try {
            $student = $this->studentService->registerStudent($validatedData);

            return response()->json([
                'message' => 'Student created successfully',
                'student' => $student
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create student',
                'error' => $e->getMessage()
            ], 500);
        }



        return response()->json($student, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:50',
            'age' => 'required|integer|min:18|max:30',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'exists:subjects,id'
        ]);

        try {
            $updatedStudent = $this->studentService->updateStudent($student, $validatedData);

            return response()->json([
                'message' => 'Student updated successfully',
                'student' => $updatedStudent
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
