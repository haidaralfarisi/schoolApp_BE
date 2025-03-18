<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index($school_id)
    {
        $school = School::where('school_id', $school_id)->first();
        $classes = ClassModel::where('school_id', $school_id)->get(); // Sesuaikan dengan model kelas
        $students = Student::where('school_id', $school_id)->get(); // Sesuaikan dengan model siswa

        return view('superadmin.student.index', compact('school', 'classes', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|unique:students,student_id',
            'school_id' => 'required|exists:schools,school_id',
            'class_id' => 'required|exists:classes,class_id',
            'nisn' => 'required|string|max:15|unique:students,nisn',
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:students,username',
            'gender' => 'required|in:Male,Female',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'entry_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        Student::create([
            'student_id' => $request->student_id,
            'school_id' => $request->school_id,
            'class_id' => $request->class_id,
            'nisn' => $request->nisn,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'gender' => $request->gender,
            'pob' => $request->pob,
            'dob' => $request->dob,
            'entry_year' => $request->entry_year,
        ]);

        return redirect()->back()->with('success', 'Student added successfully');
    }

    public function update(Request $request, $student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        $request->validate([
            'class_id' => 'required|exists:classes,class_id',
            'nisn' => 'required|string|max:15|unique:students,nisn,' . $student_id . ',student_id',
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:students,username,' . $student_id . ',student_id',
            'gender' => 'required|in:Male,Female',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'entry_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $student->update([
            'class_id' => $request->class_id,
            'nisn' => $request->nisn,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'gender' => $request->gender,
            'pob' => $request->pob,
            'dob' => $request->dob,
            'entry_year' => $request->entry_year,
        ]);

        return redirect()->back()->with('success', 'Student updated successfully');
    }

    public function destroy($student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully');
    }
}
