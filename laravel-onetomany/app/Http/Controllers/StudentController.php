<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::with('subjects')->get();
    }

    public function store(Request $request)
    {
        $studentData = $request->only('name', 'course');
        $student = Student::create($studentData);

        if ($request->has('subjects')) {
            $student->subjects()->createMany($request->input('subjects'));
        }

        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    public function show(Student $student)
    {
        return $student->load('subjects');
    }

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

    public function destroy(Student $student)
    {
        $student->subjects()->delete();
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}