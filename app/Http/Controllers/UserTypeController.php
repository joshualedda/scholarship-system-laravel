<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function create()
    {
        return view('userTypes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_types',
        ]);

        $userType = strtolower($request->name);

        // Map user types to corresponding values
        switch ($userType) {
            case 'admin':
                $userTypeId = 1;
                break;
            case 'staff':
                $userTypeId = 0; // Assuming 0 for staff
                break;
            case 'campus':
                $userTypeId = 2;
                break;
            default:
                // Get the last user type ID and increment it
                $latestUserType = UserType::max('user_type');
                $userTypeId = $latestUserType + 1;
                break;
        }

        UserType::create([
            'name' => $request->name,
            'user_type' => $userTypeId,
        ]);

        return redirect()->back()->with('success', 'User type created successfully.');
    }


}
