<?php


namespace blogapp\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'body',
        'id_post',
        'date_modification',
        'user_id'
    ];

    public static  function getAuthor($id) {
        return (User::getById($id));
    }
}