<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentNote;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {

        $schools = School::all();
        $schoolClasses = ClassModel::all();
        $videos = Video::with(['school', 'schoolClass'])->get();

        return view('superadmin.video.index', compact('schools', 'schoolClasses', 'videos'));
    }

    public function getClasses(Request $request)
    {
        if ($request->ajax()) {
            $schoolClass = ClassModel::where('school_id', $request->school_id)->get();
            return response()->json($schoolClass);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'class_id' => 'required|exists:classes,id',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        Video::create($request->all());
        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'class_id' => 'required|exists:classes,id',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $video->update($request->all());
        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus!');
    }
}
