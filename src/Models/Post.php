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
}

?>
