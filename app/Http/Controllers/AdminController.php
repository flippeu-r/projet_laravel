<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Affiche la liste des utilisateurs
    public function index() {

        if (Auth::user()->role != 'admin') {
            return redirect('/dashboard');
        }


        $users = User::all();
        return view('admin', compact('users'));
    }

    // Change le rôle d'un utilisateur
    public function changerRole(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        return redirect('/admin');
    }
}