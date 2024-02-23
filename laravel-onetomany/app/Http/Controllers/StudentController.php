<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //* Display all students with subjects
    public function index()
    {
        return Student::with('subjects')->get();
    }

    //* Create new student with subject
    public function store(Request $request)
    {
        $studentData = $request->only('name', 'course');
        $student = Student::create($studentData);

        if ($request->has('subjects')) {
            $student->subjects()->createMany($request->input('subjects'));
        }

        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    //* Display student subject
    public function show(Student $student)
    {
        return $student->load('subjects');
    }

    //* Update student and subject
    public function update(Request $request, Student $student)
    {
        $studentData = $request->only('name', 'course');
        $student->update($studentData);

        if ($request->has('subjects')) {
            $student->subjects()->delete();
            $student->subjects()->createMany($request->input('subjects'));
        }

        return response()->json(['message' => 'Student updated successfully']);
    }

    //* Delete student and subject
    public function destroy(Student $student)
    {
        $student->subjects()->delete();
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
