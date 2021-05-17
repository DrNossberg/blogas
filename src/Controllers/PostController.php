<?php

namespace blogapp\Controllers;

use blogapp\Models\Post;
use blogapp\Views\PostView;
use blogapp\Views\IndexView;
use blogapp\Views\UserView;

class PostController {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function createPostForm($rq, $rs, $args) {
        $bl = new PostView($this->cont, null, PostView::CREATE_POST_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function createPost($rq, $rs, $args) {

    }

    public function displayPost($rq, $rs, $args) {
        $id = $args['id'];
        $billet = Post::where('id', '=', $id)->first();

        $bl = new PostView($this->cont, $billet, PostView::BILLET_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function listPosts($rq, $rs, $args) {
        $billets = Post::orderBy('date_creation', 'desc')->get();

        $bl = new IndexView($this->cont, $billets, IndexView::INDEX_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }
}
