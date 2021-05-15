<?php


namespace blogapp\modele;


class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
      'name',
      'password'
    ];
}