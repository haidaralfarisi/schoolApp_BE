<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use App\Models\Userschool;
use Illuminate\Http\Request;

class ManageUserSchoolController extends Controller
{
    public function index()
    {
        $users = User::with('schools')->get();
        $schools = School::all(); // Ambil semua sekolah jika diperlukan
        $user_schools = Userschool::all();

        return view('superadmin.manage.manage-userschools', compact('users', 'user_schools','schools'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'school_id' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);
        Userschool::create([
            'user_id' => $request->user_id,
            'school_id' => $request->school_id,
        ]);
        // $user->schools()->syncWithoutDetaching([$request->school_id]);

        return redirect()->back()->with('success', 'User berhasil dikaitkan dengan sekolah.');
    }

    public function destroy($userId, $schoolId)
    {
        $user = User::findOrFail($userId);
        $user->schools()->detach($schoolId);

        return redirect()->back()->with('success', 'User berhasil dihapus dari sekolah.');
    }
}
