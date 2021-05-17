<?php

namespace blogapp\Controllers;

use blogapp\Models\Post;
use blogapp\Views\PostView;
use blogapp\Views\IndexView;

class PostController {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function displayPost($rq, $rs, $args) {
        $id = $args['id'];
        $billet = Post::where('id', '=', $id)->first();

        $bl = new PostView($this->cont, $billet, PostView::BILLET_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function listPosts($rq, $rs, $args) {
        $billets = Post::get();

        $bl = new IndexView($this->cont, $billets, IndexView::INDEX_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }
}
