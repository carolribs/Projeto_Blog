<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/* modificar a função index para ter um parametro dfe nome e também listar os usuários que foram deletados   */
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
public function destroy($id)
{
  User::find($id)->delete();
  return back()->with('msg','Usuário Deletado Com Sucesso.');
}
public function config()
{
  return view('usuarios.user.config');
}
public function config_update(Request $request)
{
  switch ($request->input('tipo')) {
    case 'avatar':
      # code...
      break;

    case 'n.e.d':
      # code...
      break;

    case 'senha':
      $request->validate([
        'senha_atual' => 'required|string|min:6',
        'password' => 'required|string|min:6|confirmed',
      ]);

      if(password_verify($request->input('senha_atual'),Auth::user()->password)){
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return back()->with('msg', 'Senha Alterada com Sucesso.');
      }else{
        return back()->with('erro', 'Senha Atual não é compatível.');
      }

      break;
  }
}


}
