<?php
/**
 * Created by PhpStorm.
 * User: andreazo
 * Date: 23/07/17
 * Time: 09:37
 */

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model as Illuminate;


class Game extends Illuminate
{
    protected $table = 'game';
    public $timestamps = false;

    public $fillable = ['id', 'nome', 'categoria','preco','url'];
}