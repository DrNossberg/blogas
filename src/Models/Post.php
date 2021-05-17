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
        return $this->belongsTo('\blogapp\modele\Category', 'cat_id');
    }

    public function getAuthor($id) {
        return (User::getById($id));
    }

    public function getComments() {
        return $this->hasMany('\blogapp\Models\Comment', 'id_post');
    }

}

?>
