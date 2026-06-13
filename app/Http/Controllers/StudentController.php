<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

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
    public function index(Request $request)
    {
        $query = Student::with(['profile', 'subjects']);

        if ($request->has('course') && !empty($request->course)) {
            $query->where('course', $request->course);
        }

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $students = $query->paginate();

        return response()->json([
            'students' => $students->items(),
            'pagination' => [
                'total' => $students->total(),
                'per_page' => $students->perPage(),
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validatedData = $request->validated();

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
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json([
            'student' => $student->load(['profile', 'subjects'])
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validatedData = $request->validated();

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
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}

