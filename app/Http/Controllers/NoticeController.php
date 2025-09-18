<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('notice.showAll', compact('notices'));
    }

    public function create()
    {
        return view('notice.create');
    }

    public function store(UserRequests $req)
    {
        $validated = $req->validated();

        $role = Auth::user()->role;

        if ($role === "admin" || $role === "teacher") {
            $validated['user_id'] = Auth::id();
            Notice::create($validated);

            return redirect()->route('notice.list')->with('success', 'Notice Published successfully !');
        }
        return redirect()->back()->with('error', "you con't create Notice");
    }

    public function show(string $id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.view', compact('notice'));
    }
    public function edit(string $id)
    {

        $notice = Notice::findOrFail($id);
        return view('notice.edit', compact('notice'));
    }

    public function update(UserRequests $req, string $id)
    {
        $validated = $req->validated();
        $role = Auth::user()->role;
        $notice = Notice::findOrFail($id);


        if ($role === "admin" ||  $notice->user_id === Auth::id()) {
            $validated['user_id'] = Auth::id();

            try {


                $changes = [];

                foreach ($validated as $key => $value) {
                    if ($notice->$key != $value) {
                        $changes[$key] = $value;
                    }
                }

                if (!empty($changes)) {
                    $notice->update($changes);
                     return redirect()->route('notice.list')->with('success', 'Notice updated successfully!');
                }
                return redirect()->back()->with('error','No change Detected');

               
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'You are not allowed to update notice.');
    }


    public function destroy(string $id)
    {
        $notice = Notice::findOrFail($id);
        $role = Auth::user()->role;
        if ($role === "admin" || $role === "teacher" || $notice->user_id === Auth::id()) {
            $notice->delete();
            return redirect()->back()->with('success', 'Notice Deleted successfully !');
        }
        return redirect()->back()->with('error', 'only admin can delete notice');
    }

    public function noticeNav()
    {
        $notices = Notice::latest()->get();
        return view('layouts.navbar', compact('notices'));
    }
}
