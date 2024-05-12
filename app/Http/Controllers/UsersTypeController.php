<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UsersTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersList = UserType::all();
        return view('admin.auth.index', compact('usersList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'user_type' => 'required|string',
            'name' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        // Create a new UserType instance
        $userType = new UserType();
        $userType->user_type = $validatedData['user_type'];
        $userType->name = $validatedData['name'];
        $userType->status = $validatedData['status'];

        $userType->save();

        return redirect()->back()->with('success', 'User Type Added Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(UserType $id)
    {
        return view('admin.auth.view',['userType' => $id]);
    }
    public function edit(UserType $id)
    {
        return view('admin.auth.edit',['userType' => $id]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserType $userType)
    {
        $userType->update([
            'user_type' => $request->input('user_type'),
            'name' => $request->input('name'),
            'status' => $request->input('status')
        ]);

        return redirect()->back()->with('success', 'User Type Updated Successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
