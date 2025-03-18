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

        // dd($user_schools); // Cek apakah data benar-benar ada


        return view('superadmin.manage.manage-userschools', compact('users', 'user_schools', 'schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'school_id' => 'required',
        ]);

        User::findOrFail($request->user_id);
        Userschool::create([
            'user_id' => $request->user_id,
            'school_id' => $request->school_id,
        ]);

        return redirect()->back()->with('success', 'User berhasil dikaitkan dengan sekolah.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required',
        'school_id' => 'required',
    ]);

    $userschool = Userschool::findOrFail($id);
    $userschool->update([
        'user_id' => $request->user_id,
        'school_id' => $request->school_id,
    ]);

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($Id)
    {
        $userSchool = Userschool::findOrFail($Id);
        $userSchool->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus dari sekolah.');
    }
}
