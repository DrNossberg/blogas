<?php


namespace blogapp\Controllers;

use blogapp\Models\Comment;


class CommentController
{
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function createComment($rq, $rs, $args) {
        $post_id = $args['id'];
        $comment = [
            'title' => filter_var($rq->getParsedBodyParam('title'), FILTER_SANITIZE_STRING),
            'body' => filter_var($rq->getParsedBodyParam('body'), FILTER_SANITIZE_STRING),
            'post_id' => $post_id
        ];

        Comment::create($comment);

        $this->cont->flash->addMessage('info', "Commentaire créé !");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('post_display', ['id' => $post_id]));
    }
}