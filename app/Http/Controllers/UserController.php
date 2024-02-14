<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

     private array $validationRules = [
        'name' => 'required|string|min:6|max:255',
        'role' => 'required|in:Admin,Learner,super admin',
    ];

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $query = User::query();

    if ($searchQuery) {
        $query->where('name', 'LIKE', '%' . $searchQuery . '%')
              ->orWhere('email', 'LIKE', '%' . $searchQuery . '%')
              ->orWhere('role', 'LIKE', '%' . $searchQuery . '%');
    }
    $availableRoles = Role::all()->pluck('name', 'id');
    $users = $query->select('name', 'id', 'email', 'role')->with('roles')->paginate(10);
        return view("dashboard", ['users' => $users, 'availableRoles' => $availableRoles, 'searchQuery' => $searchQuery]);
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
        try {
            $user = User::select('name', 'id', 'role')->findOrFail($id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found. errorcode: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->validationRules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $validatedData = $validator->validated();
        
        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);
            $user->syncRoles([$validatedData['role']]);
            return redirect()->back()->with("success", "user edited successfuly!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error editing user. Please try again. errorcode: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = intval($id);
        try {
            $advert = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
        $advert->delete();
        return redirect()->back()->with('success','user deleted successfuly');
    }
}
