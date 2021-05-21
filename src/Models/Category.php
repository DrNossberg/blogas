<?php

namespace blogapp\Models;

class Category extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description'
    ];

    public function billets() {
        return $this->hasMany('\blogapp\Models\Post', 'cat_id');
    }

    public static function getByTitle($title) {
        return Category::where('title', '=', $title)->first();
    }

    public static function create($cat_info) {
        $cat = new Category();
        $cat->title = $cat_info['title'];
        $cat->description = $cat_info['desc'];
        $cat->save();
    }

    public static function getById($id) {
        return Category::where('id', "=", $id)->first();
    }
}

?>
