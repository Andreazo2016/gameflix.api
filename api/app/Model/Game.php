<?php
/**
 * Created by PhpStorm.
 * User: luisfernando
 * Date: 16/04/17
 * Time: 22:09
 */

namespace Api\Model;
use \Illuminate\Database\Eloquent\Model as Illuminate;



class Game extends Illuminate
{
    protected  $table = 'game';

    public $fillable = ['ID','nome','categoria'];

}