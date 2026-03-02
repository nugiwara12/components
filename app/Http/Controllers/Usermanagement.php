<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Usermanagement extends Controller
{
   public function index()
   {
      $users = User::all();
      return view('user-management.index', compact('users'));
   }
}
