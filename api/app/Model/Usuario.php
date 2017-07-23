<?php
/**
 * Created by PhpStorm.
 * User: andreazo
 * Date: 23/07/17
 * Time: 10:04
 */

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model as Illuminate;


class Usuario extends Illuminate
{
    protected $table = 'usuario';
    public $timestamps = false;

    public $fillable = ['cpf', 'nome', 'email','endereco','login','senha'];

    //função para validar Token
    //implementar de uma maneira melhor futuramente
    public function validarToken($tokenP,$tokenC){
       //logica para validação do token
        if(($tokenP === 'ok') || ($tokenC === 'ok')){
            return true;
        }
        return false;
    }
}