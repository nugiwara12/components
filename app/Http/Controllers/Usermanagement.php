<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\User;
use App\Models\Role;

class Usermanagement extends Controller
{
   public function index()
   {
      return view('user-management.index');
   }

   public function getRoles() 
   {
      // Get roles from database
      $roles = Role::select('id', 'name')->get();

      // Return JSON in format: [{ value: 1, label: 'Admin' }, ...]
      $roles = $roles->map(function($role) {
         return [
               'value' => $role->id,
               'label' => $role->name
         ];
      });

      return response()->json($roles);
   }

   public function getEmployeeId()
   {
      return response()->json([
         'employee_id' => User::generateEmployeeId()
      ]);
   }

   public function userDetails(Request $request)
   {
      $perPage = (int) $request->get('per_page', 10);

      // Get all users with their roles
      $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
         ->select(
               'users.id',
               'users.employee_id',
               'users.name',
               'users.avatar_image',
               'users.email',
               'users.mobile_number',
               'users.join_date',
               'users.status',
               'users.role_id',
               'roles.name as role_name'
         )
         ->orderBy('users.id', 'desc')
         ->paginate($perPage);

      return response()->json([
         'status' => true,
         'users'  => $users->items(),
         'pagination' => [
               'current_page' => $users->currentPage(),
               'last_page'    => $users->lastPage(),
               'per_page'     => $users->perPage(),
               'total'        => $users->total(),
         ]
      ]);
   }

   public function addUser(Request $request)
   {
      $request->validate([
         'name'          => 'required|string|max:255',
         'email'         => 'required|email|unique:users,email',
         'role'          => 'required|exists:roles,id',
         'password'      => 'required|min:6|confirmed',
         'mobile_number' => 'required|string|regex:/^09\d{9}$/|unique:users,mobile_number',
         'join_date'     => 'required|date',
         'avatar_image'  => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // validate avatar
      ]);

      // Handle avatar upload
      $avatarPath = null;
      if ($request->hasFile('avatar_image')) {
         $avatarFile = $request->file('avatar_image');
         $filename = time() . '_' . $avatarFile->getClientOriginalName();
         $avatarFile->move(public_path('avatar'), $filename); // save to public/avatar
         $avatarPath = 'avatar/' . $filename; // store relative path in DB
      }

      // Create user with auto-generated employee_id
      $user = User::create([
         'employee_id'   => User::generateEmployeeId(),
         'name'          => $request->name,
         'email'         => $request->email,
         'role_id'       => $request->role,
         'password'      => Hash::make($request->password),
         'mobile_number' => $request->mobile_number,
         'join_date'     => $request->join_date,
         'avatar_image'  => $avatarPath, // save avatar path
      ]);

      return response()->json([
         'status'  => true,
         'message' => 'User created successfully.',
         'data'    => $user
      ], 201);
   }

   public function UpdateUser(Request $request, $id)
   {
      $user = User::find($id);

      if (!$user) {
         return response()->json([
               'status' => false,
               'message' => 'User not found.'
         ], 404);
      }

      // Validation rules
      $rules = [
         'name' => 'bail|required|string|max:255',
         'email' => "bail|required|email|unique:users,email,{$id}",
         'role' => 'bail|required|exists:roles,id',
         'password' => 'nullable|min:6|confirmed',
         'mobile_number' => "required|string|regex:/^09\d{9}$/|unique:users,mobile_number,{$id}",
         'join_date' => 'required|date',
         'avatar_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // optional image
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
         return response()->json([
               'status' => false,
               'message' => $validator->errors()->first() ?? 'Validation failed.',
         ], 422);
      }

      // Update basic fields
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role_id = $request->role;
      $user->mobile_number = $request->mobile_number;
      $user->join_date = $request->join_date;

      if ($request->filled('password')) {
         $user->password = Hash::make($request->password);
      }

      // Handle avatar replacement
      if ($request->hasFile('avatar_image')) {
         // Delete old avatar if exists
         if ($user->avatar_image && file_exists(public_path($user->avatar_image))) {
               @unlink(public_path($user->avatar_image));
         }

         $avatarFile = $request->file('avatar_image');
         $filename = time() . '_' . $avatarFile->getClientOriginalName();
         $avatarFile->move(public_path('avatar'), $filename);
         $user->avatar_image = 'avatar/' . $filename;
      }

      $user->save();

      return response()->json([
         'status' => true,
         'message' => 'User updated successfully.',
         'data' => [
               'id' => $user->id,
               'name' => $user->name,
               'email' => $user->email,
               'role' => $user->role_id,
               'mobile_number' => $user->mobile_number,
               'join_date' => $user->join_date,
               'avatar_image' => $user->avatar_image ? asset($user->avatar_image) : null,
         ]
      ], 200);
   }

   public function deleteUser($id)
   {
      $user = User::find($id);

      if (!$user) {
         return response()->json(['status' => false, 'message' => 'User not found.'], 404);
      }

      // Soft delete: just mark inactive
      $user->status = 0;
      $user->save();

      return response()->json(['status' => true, 'message' => 'User deleted successfully.']);
   }

   public function restoreUser($id)
   {
      $user = User::find($id);
      if (!$user) {
         return response()->json(['status' => false, 'message' => 'User not found.'], 404);
      }

      $user->status = 1;
      $user->save();

      return response()->json(['status' => true, 'message' => 'User restored successfully.']);
   }
}
