<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function index()
{
return view('usuarios.user.index')->with('users',user::orderBy('name','asc')->get());
}

public function create()
{
  return view('usuarios.user.create');
}
public function store(Request $request)
{
  $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:6|confirmed',
  ]);

  $user = new User;
  $user->name = $request->input('name');
  $user->email = $request->input('email');
  $user->level = $request->input('level');
  $user->password = bcrypt($request->input('password'));
  $user->save();

  return view('usuarios.user.create')->with('msg', 'Usuário Adicionado com Sucesso.');
}

}
