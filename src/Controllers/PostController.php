<?php

namespace blogapp\Controllers;

use blogapp\Authentification\Auth;
use blogapp\Models\Post;
use blogapp\Models\User;
use blogapp\Views\PostView;
use blogapp\Views\IndexView;
use blogapp\Views\UserView;

class PostController {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function createPostForm($rq, $rs, $args) {
        if (Auth::hasRight(1)) {
            $bl = new PostView($this->cont, null, PostView::CREATE_POST_VUE);
            $rs->getBody()->write($bl->render());
            return $rs;
        }
        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }

    public function createPost($rq, $rs, $args) {
        $post = [
          'title' => filter_var($rq->getParsedBodyParam('title'), FILTER_SANITIZE_STRING),
            'body' => filter_var($rq->getParsedBodyParam('body'), FILTER_SANITIZE_STRING),
            'category' => filter_var($rq->getParsedBodyParam('cat'), FILTER_SANITIZE_STRING)
        ];

        Post::create($post);

        $this->cont->flash->addMessage('info', "Post créé !");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }

    public function displayPost($rq, $rs, $args) {
        $id = $args['id'];
        $billet = Post::where('id', '=', $id)->first();

        $bl = new PostView($this->cont, $billet, PostView::BILLET_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function listPosts($rq, $rs, $args) {
        $billets = Post::orderBy('date_creation', 'desc')->limit(20, 0)->get();

        $bl = new IndexView($this->cont, $billets, IndexView::INDEX_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function getPosts($rq, $rs, $args) {
        $no = filter_var($rq->getParsedBodyParam('getresult'), FILTER_SANITIZE_STRING);
        $posts = Post::orderBy('date_creation', 'desc')->limit(1, $no)->get();

        

    }
}
