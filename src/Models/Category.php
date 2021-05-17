<?php

namespace blogapp\Models;

class Category extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    public function billets() {
        return $this->hasMany('\blogapp\Models\Post', 'cat_id');
    }
}

?>
