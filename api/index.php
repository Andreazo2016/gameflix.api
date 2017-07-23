<?php
/**
 * Created by PhpStorm.
 * User: luisfernando
 * Date: 16/04/2017
 * Time: 18:58
 */

require 'vendor/autoload.php';
require 'app/database/settings.php';




use Api\Model\Game;

$app = new \Slim\Slim();
$app->response->headers->set('Access-Control-Allow-Origin',  'http://localhost/app.multimeios/app/');
$app->response->headers->set('Access-Control-Allow-Headers', '*');
$app->response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

    $app->get('/', function () use ($app){
        $routes = [
            'total' => 6,
            'routes' => [
                'GET' => [
                    'CRYPT' => ['bcrypt/:password'],
                    'STUDENT' => [
                         'users',
                         'users/:registration/:password',
                         'users/:id',
                         'users-discipline/:id',
                         'archives-discipline/:id'
                    ]
                ]
            ]
        ];

        $app->response->setBody(json_encode($routes));
    });
    /* Encrypt password */
//    $app->get('/bcrypt/:password', function ($password) use ($app){
//        $passwordDC = Bcrypt::hash($password);
//        $data = [
//            'Password Bcrypt' => $passwordDC
//        ];
//        $app->response->setBody(json_encode($data));
//    });
//
//    /* Get all users */
//    $app->get('/users', function () use ($app) {
//        $user =  User::all();
//        $app->response->setBody(json_encode($user));
//    });
$app->get('/games', function () use ($app) {
    $games =  Game::all();
    $app->response->setBody(json_encode($games));
});
$app->get('/games/:id', function ($id) use ($app) {
    $game =  Game::find($id);
        if($game === null) $user = false;
       $app->response->setBody(json_encode($game));
});

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