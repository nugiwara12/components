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
               'users.email',
               'users.mobile_number',
               'users.join_date',
               'users.status',
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
      ]);

      // Create user with auto-generated employee_id
      $user = User::create([
         'employee_id'   => User::generateEmployeeId(),
         'name'          => $request->name,
         'email'         => $request->email,
         'role_id'       => $request->role,
         'password'      => Hash::make($request->password),
         'mobile_number' => $request->mobile_number,
         'join_date'     => $request->join_date,
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

      // Merge missing request fields with existing DB values
      $request->merge([
         'name' => $request->name ?: $user->name,
         'email' => $request->email ?: $user->email,
         'role' => $request->role ?: $user->role,
         'business_name' => $request->business_name ?: $user->business_name,
         'company_email' => $request->company_email ?: $user->company_email,
         'company_contact' => $request->company_contact ?: $user->company_contact,
      ]);

      // Validation rules
      $rules = [
         'name' => 'bail|required|string|max:255',
         'email' => "bail|required|email|unique:users,email,{$id}",
         'role' => 'bail|required|in:super_admin,admin,user,pharmacy',
         'password' => 'nullable|min:6|confirmed',
      ];

      if ($request->role === 'pharmacy') {
         $rules['business_name'] = 'bail|required|string|max:255';
         $rules['company_email'] = 'bail|required|email';
         $rules['company_contact'] = 'bail|required|string|regex:/^09\d{9}$/';
         $rules['proof_legitimacy'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
      }

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
      $user->role = $request->role;

      if ($request->filled('password')) {
         $user->password = Hash::make($request->password);
      }

      // Update pharmacy fields
      if ($request->role === 'pharmacy') {
         $user->business_name = $request->business_name;
         $user->company_email = $request->company_email;
         $user->company_contact = $request->company_contact;

         if ($request->hasFile('proof_legitimacy')) {
               // Delete old file if exists
               if ($user->proof_legitimacy && file_exists(public_path($user->proof_legitimacy))) {
                  @unlink(public_path($user->proof_legitimacy));
               }

               // Save new file
               $file = $request->file('proof_legitimacy');
               $filename = time() . '_' . $file->getClientOriginalName();
               $file->move(public_path('proofs'), $filename);
               $user->proof_legitimacy = 'proofs/' . $filename;
         }
      } else {
         // Clear pharmacy fields if role changed
         $user->business_name = null;
         $user->company_email = null;
         $user->company_contact = null;

         // Delete old file if exists
         if ($user->proof_legitimacy && file_exists(public_path($user->proof_legitimacy))) {
               @unlink(public_path($user->proof_legitimacy));
         }
         $user->proof_legitimacy = null;
      }

      $user->save();

      return response()->json([
         'status' => true,
         'message' => 'User updated successfully.',
         'data' => [
               'id' => $user->id,
               'name' => $user->name,
               'email' => $user->email,
               'role' => $user->role,
               'business_name' => $user->business_name,
               'company_email' => $user->company_email,
               'company_contact' => $user->company_contact,
               'proof_legitimacy' => $user->proof_legitimacy ? asset($user->proof_legitimacy) : null,
         ]
      ], 200);
   }
}
