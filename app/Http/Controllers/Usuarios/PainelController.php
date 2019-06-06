<?php
 namespace App\Http\Controllers\Usuarios;

 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;

Public class PainelController extends Controller
{
 public function index()
{
  return view('usuarios.painel');
}
}
