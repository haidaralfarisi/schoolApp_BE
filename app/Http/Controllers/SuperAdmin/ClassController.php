<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\School;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index($school_id)
    {
        $schools = School::where('school_id', $school_id)->firstOrFail();
        $classes = ClassModel::where('school_id', $school_id)->get(); // Sesuaikan dengan model kelas
        

        return view('superadmin.kelas.index' ,compact('schools', 'classes'));
    }
}

