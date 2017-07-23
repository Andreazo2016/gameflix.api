<?php


require 'vendor/autoload.php';
require 'app/database/settings.php';

//imports
use Api\Model\Game;
use Api\Model\Usuario;

$app = new \Slim\Slim();
$app->response->headers->set('Access-Control-Allow-Origin',  'http://localhost/app.multimeios/app/');
$app->response->headers->set('Access-Control-Allow-Headers', '*');
$app->response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

    $app->get('/', function () use ($app){
        $routes = [
            'Api-GameFlix'=>'ANDREAZO'
        ];

        $app->response->setBody(json_encode($routes));
    });
    //get all Games
    $app->get('/games',function () use ($app){
        $games = Game::all();
        $app->response->setBody(json_encode($games));
    });
    //get Games by id
    $app->get('/games/:id',function ($id) use ($app){
        $game = Game::find($id);
        if($game === null) $game = false;
        $app->response->setBody(json_encode($game));
    });
    //get Games by Categoria
    $app->get('/games-categoria/:categoria',function ($categoria) use ($app){
        $gameByCategoria = Game::select('*')->where('categoria','=',$categoria)->get();

        $app->response->setBody(json_encode($gameByCategoria));
    });
    //create Games
    $app->post('/games',function () use ($app){
        $nome = $app->request->post('nome');
        $categoria = $app->request->post('categoria');
        $preco = $app->request->post('preco');
        $url =$app->request->post('url');

        Game::create(['id'=>0,'nome'=>$nome,'categoria'=>$categoria,'preco'=>$preco,'url'=>$url]);
        $reposta = [
            '200'=>'OK'
        ];
        $app->response->setBody(json_encode($reposta));

    });
    //get all Users
    $app->get('/usuarios',function () use ($app){
        $usuarios = Usuario::all();
        $app->response->setBody(json_encode($usuarios));
    });
    //create Users
    $app->post('/usuarios',function () use ($app){
        $cpf = $app->request->post('cpf');
        $nome = $app->request->post('nome');
        $email = $app->request->post('email');
        $endereco = $app->request->post('endereco');
        $login = $app->request->post('login');
        $senha = $app->request->post('senha');

        Usuario::create(['cpf'=>$cpf,'nome'=>$nome,'email'=>$email,'endereco'=>$endereco,'login'=>$login,'senha'=>$senha]);
        $reposta = [
            '200'=>'OK'
        ];
        $app->response->setBody(json_encode($reposta));
    });


//    /* Encrypt password */
//    $app->get('/bcrypt/:password', function ($password) use ($app){
//        $passwordDC = Bcrypt::hash($password);
//        $data = [
//            'Password Bcrypt' => $passwordDC
//        ];
//        $app->response->setBody(json_encode($data));
//    });

//    /* Get all users */
//    $app->get('/users', function () use ($app) {
//        $user =  User::all();
//        $app->response->setBody(json_encode($user));
//    });
//
//    /* Get user if exist */
//    $app->get('/users/:registration/:password', function ($registration, $password) use ($app) {
//        $registrationUser = User::select('*')->where('registration', '=', $registration)->get()->first();
//        $data = json_decode($registrationUser, true);
//        if(Bcrypt::check($password, $data['password'])) {
//            $app->response->setBody(json_encode($registrationUser));
//        }else{
//            $app->response->setBody(json_encode(false));
//        }
//    });
//
//    /* Get user by ID */
//    $app->get('/users/:id', function ($id) use ($app) {
//        $user =  User::find($id);
//        if($user === null) $user = false;
//        $app->response->setBody(json_encode($user));
//    });
//
//    $app->get('/discipline', function () use ($app){
//        $disciplines = Discipline::all();
//        $app->response->setBody(json_encode($disciplines));
//    });
//
//    /* Get discipline user by ID */
//    $app->get('/users-discipline/:id', function ($id) use ($app){
//       $userRelationsDiscipline = UserDiscipline::select('discipline.id','discipline.code', 'discipline.name', 'discipline.teacher', 'discipline.workload', 'discipline.semester')
//            ->where('user_id', '=', $id)
//            ->join('user', 'user_id', '=', 'user.id')
//            ->join('discipline', 'discipline_id', '=', 'discipline.id')
//            ->get();
//
//        $userRelationsDisciplineNameWithArchive = UserDiscipline::select('discipline.name')
//            ->where('user_id', '=', $id)
//            ->join('user', 'user_id', '=', 'user.id')
//            ->join('discipline', 'discipline_id', '=', 'discipline.id')
//            ->join('archive','archive.discipline_id', '=', 'discipline.id')
//            ->get()->first();
//
//        $userRelationsDisciplineAmountArchive = UserDiscipline::select('discipline.id','discipline.code', 'discipline.name', 'discipline.teacher', 'discipline.workload', 'discipline.semester')
//            ->where('user_id', '=', $id)
//            ->join('user', 'user_id', '=', 'user.id')
//            ->join('discipline', 'discipline_id', '=', 'discipline.id')
//            ->join('archive','archive.discipline_id', '=', 'discipline.id')
//            ->get()->count();
//
//        $userRelationsDiscipline = json_decode($userRelationsDiscipline, true);
//
//        $userRelationsDiscipline[] = ['discipline_archive' => $userRelationsDisciplineNameWithArchive['name'], 'amount' => $userRelationsDisciplineAmountArchive];
//
//        $app->response->setBody(json_encode($userRelationsDiscipline));
//    });
//
//    /* Get archives of discipline by ID*/
//    $app->get('/archives-discipline/:id', function($id) use ($app){
//        $archives = Archive::select('archive.name', 'archive.url')
//                    ->where('discipline_id', '=', $id)
//                    ->get();
//
//        $app->response->setBody(json_encode($archives));
//    });
$app->run();