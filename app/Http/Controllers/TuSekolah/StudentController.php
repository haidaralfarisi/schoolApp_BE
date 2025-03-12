<?php

namespace App\Http\Controllers\TuSekolah;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['school', 'class'])->get();
        $schools = School::all();
        $classes = ClassModel::all();
        return view('tusekolah.student.index', compact('students', 'schools', 'classes'));
    }

    public function store()
    {
        // Validasi data
        $validated = request()->validate([
            'student_id' => 'required',
            'nisn' => 'required',
            'fullname' => 'required',
            'username' => 'required',
            'gender' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'school_id' => 'required',
            'class_id' => 'required',
            'entry_year' => 'required',
        ]);

        // Simpan data ke database
        Student::create($validated);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Student successfully added.');
    }

    public function update()
    {
        // Validasi data
        $validated = request()->validate([
            'name' => 'required',
            'nis' => 'required',
            'class_id' => 'required',
            'school_id' => 'required',
        ]);

        // Simpan data ke database
        Student::create($validated);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Student successfully updated.');
    }
}
