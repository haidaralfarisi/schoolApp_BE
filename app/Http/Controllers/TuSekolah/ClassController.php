<?php

namespace App\Http\Controllers\TuSekolah;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index()
    {

        $schools = School::all(); // Ambil semua sekolah jika diperlukan

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        if ($user->level === 'SUPERADMIN') {
            $classes = ClassModel::with('school')->get();
        } else {
            $schools = $user->schools;
            $classes = ClassModel::with('school')->whereIn('school_id', $schools->pluck('id'))->get();
        }

        return view('tusekolah.class.index', compact('classes', 'schools'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|unique:classes,class_name',
            'class_id'   => 'required|unique:classes,class_id',
            'school_id'   => 'required',
            'grade' => 'required',
        ]);

        ClassModel::create([
            'class_name' => $validated['class_name'],
            'class_id' => $validated['class_id'],
            'school_id' => $validated['school_id'],
            'grade' => $validated['grade'],

        ]);

        return redirect()->back()->with('success', 'Class successfully added.');
    }

    public function update(Request $request, $id)
    {
        // DB::enableQueryLog(); // Debugging untuk melihat query yang dijalankan

        // Validasi data
        $validated = $request->validate([
            'class_id' => 'required|unique:classes,class_id,' . $id,
            'class_name' => 'required|string|max:255',
            'school_id'  => 'required|exists:schools,id',
            'grade'      => 'required|string|max:10',
        ]);

        // Temukan data berdasarkan ID (karena primary key adalah id, bukan class_id)
        $class = ClassModel::findOrFail($id);

        // Update data
        $class->update([
            'class_id'   => $validated['class_id'], // Tambahkan class_id agar bisa diperbarui
            'class_name' => $validated['class_name'],
            'school_id'  => $validated['school_id'],
            'grade'      => $validated['grade'],
        ]);

        return redirect()->back()->with('success', 'Class updated successfully');
    }



    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);

        $class->delete();
        return redirect()->back()->with('success', 'School Deleted successfully');
    }
}
