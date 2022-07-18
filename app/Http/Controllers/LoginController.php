<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //
    public function index(Request $request){

        $erro = '';

        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha incorretos.';
        }

        if($request->get('erro') == 2){
            $erro = 'É necessário fazer login para acessar essa página.';
        }

        return view('site.login', 
            array(
                'titulo' => 'Login',
                'erro' => $erro
            ));
    }

    public function autenticar(Request $request){
        $regras = array(
            'usuario' => 'email',
            'senha' => 'required',
        );
        $feedback = array(
            'usuario.email' => 'O campo usuário (email) informado precisa ser válido',
            'required' => 'O campo :attribute é obrigatório',
        );

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $autenticado = User::where('email', $email)
                            ->where('password', $password)
                            ->get()
                            ->first();
        
        if (!isset($autenticado->email)){
            return redirect()->route('site.login', array(
                'erro' => 1
            ));
        }

        session_start();
        $_SESSION['nome'] = $autenticado->name;
        $_SESSION['email'] = $autenticado->email;

        return redirect()->route('app.home');

    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }
}
