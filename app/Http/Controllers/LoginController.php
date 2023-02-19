<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request){

        $dados = $request->all();

        // dd($dados);

        $dados = $request->all();

        // dd($dados);

        if (Auth::attempt(['email' => $dados['email'], 'password' => $dados['password'], 'ativo' => 'S'])) {

            return redirect(route('admin.home'));

        } else {
            // redireciona para a tela de login
            return redirect(route('login.login'))->with('mensagem', 'Usuário e/ou senha inválidos!');
        }


    }

    public function logout(Request $request){

        // Log::gravaLog('LOGOUT', 'Efetuou logout');

        if(session('mensagem')){
            $mensagem = session('mensagem');
        } else {
            $mensagem = 'Usuário deslogado com sucesso!';
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        // redireciona para a tela de login
        return redirect(route('login.login'))->with('mensagem', $mensagem);
    }
}
