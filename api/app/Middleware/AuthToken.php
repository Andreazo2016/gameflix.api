<?php
 use Slim\Middleware as Middleware;


 class AuthToken extends Middleware{


     //função pra emitir codigo de erro
    public function acesso_negado(){
        $resposta =  $this->app->response();
        $resposta->status(401);
    }


    //função principal a ser chamada
     public function call()
     {
         //pega o valor do token q vem pelo o post
        $tokenP = $this->app->request->post('token');
        //pega pego o valor do token q vem pelo o cabecalho
         $tokenC = $this->app->request->headers->get('token');
         //instancia a classe user e invoca o metodo de validar token
        $user = new \Api\Model\Usuario();
        if($user->validarToken($tokenP,$tokenC)){
            $this->next->call();
        }else{
            $this->acesso_negado();
        }
     }
 }