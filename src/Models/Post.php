<?php

namespace blogapp\Models;

class Post extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'body',
        'cat_id',
        'date_modification',
        'user_id',
        'image'
    ];

    public function categorie() {
        return $this->belongsTo('\blogapp\Models\Category', 'cat_id');
    }

    public static function getAuthor($id) {
        return (User::getById($id));
    }

    public function getComments() {
        return $this->hasMany('\blogapp\Models\Comment', 'id_post');
    }

    public static function create($post_info) {
        $post = new Post();
        $post->title = $post_info['title'];
        $post->body = $post_info['body'];
        $post->cat_id = $post_info['category'];
        $post->user_id = User::getByUsername($_COOKIE['user_login'])->id;
        $post->save();
    }

}

?>
