<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $query = User::sortable();
    
            // Check if there is a search query
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('id', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('role', 'LIKE', '%' . $search . '%');
            }
    
            $users = $query->paginate(1);
    
            return view('users.indexuser', compact('users'));
        }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
       return view('users.edituser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'role' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules for the photo
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.min' => 'Name must be at least 3 characters.',
            'role.required' => 'Role is required.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'Only JPEG, PNG, JPG, and GIF files are allowed.',
            'photo.max' => 'The maximum allowed file size is 2MB.',
        ]);
    
        $user = User::find($id);
    
        if ($user) {
            $user->name = $request['name'];
            $user->role = $request['role'];
    
            // Check if a new photo is uploaded
            if ($request->hasFile('photo')) {
                // Delete the old photo
                Storage::disk('public')->delete($user->image);
                // Store the new photo
                $user->image = $request->file('photo')->store('userImage', 'public');
            }
    
            // Save the changes
            $user->save();
    
            return redirect()->route('user.index')->with('message', 'User updated successfully');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

    // Delete the user
    $user->delete();

    return redirect()->route('user.index')->with('message', 'User deleted successfully');
    }
}
