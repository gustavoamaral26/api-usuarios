<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    // BUSCA TODOS OS USUARIOS
    public function getAll()
    {
        $usuarios = Usuarios::All();

        if($usuarios){
            return response()->json(['dados' => $usuarios, 'status'=> 200]);
        }else{
            return response()->json(['message'=> 'Erro ao listar dados dos usuários!!!', 'status'=> 500]);
        }
    }

    // BUSCA USUARIO PELO SEU ID 
    public function getId($id)
    {
        $usuario = Usuarios::find($id);
        return $usuario;
    }

    // CRIA UM NOVO REGISTRO DE USUARIO NO BANCO
    public function store(Request $request)
    {
        $usuario = new Usuarios;
        
        $usuario->email = $request->input('email');
        $usuario->senha = $request->input('senha');

        $usuario->save();

        if($usuario){
            return response()->json(['dados' => $usuario, 'message'=> 'Usuário inserido com sucesso!!!', 'status'=> 201]);
        }else{
            return response()->json(['message'=> 'Erro ao inserir dados do usuário!!!', 'status'=> 500]);
        }
    }

    // ATUALIZA DADOS DO USUARIO INFORMADO A PARTIR DO ID
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);

        $usuario->email = $request->input('email');
        $usuario->senha = $request->input('senha');

        $usuario->save();

        if($usuario){
            return response()->json(['dados' => $usuario, 'message'=> 'Dados do usuário atualizados com sucesso!!!', 'status'=> 201]);
        }else{
            return response()->json(['message'=> 'Erro ao atualizar dados do usuário!!!', 'status'=> 500]);
        }
    }

    // EXCLUI O REGISTRO DE UM USUÁRIO PELO ID INFORMADO
    public function destroy($id)
    {
        $usuario = Usuarios::find($id);

        $usuario->delete();

        if($usuario){
            return response()->json(['dados' => $usuario, 'message'=> 'Dados do usuário excluídos com sucesso!!!', 'status'=> 200]);
        }else{
            return response()->json(['message'=> 'Erro ao excluir dados do usuário!!!', 'status'=> 500]);
        }
    }

    // REALIZA A BUSCA DO USUARIO A PARTIR DOS CARACTERES INFORMADOS POR PARAMETRO (BUSCA PELO CAMPO EMAIL)
    public function busca($str){
        $usuario = Usuarios::where('email', 'like', '%'.$str.'%')->get();
        if($usuario){
            return response()->json(['dados' => $usuario, 'status'=> 200]);
        }else{
            return response()->json(['message'=> 'Erro ao listar dados dos usuários!!!', 'status'=> 500]);
        }
    }
}
