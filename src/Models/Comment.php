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

    public static function getAuthor($id) {
        return (User::getById($id));
    }

    public static function create($comment_info) {
        $comment = new Comment();
        $comment->title = $comment_info['title'];
        $comment->body = $comment_info['body'];
        $comment->user_id = User::getByUsername($_COOKIE['user_login'])->id;
        $comment->id_post = $comment_info['post_id'];
        $comment->save();
    }
}