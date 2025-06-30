<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.page.member.index', compact('members'));
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->delete();

            return redirect()->route('admin.member.index')->with('success', 'Member berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.member.index')->with('error', 'Gagal menghapus member!');
        }
    }
}
