<?php

namespace blogapp\Views;
use blogapp\Models\Comment;
use blogapp\Models\Post;
use blogapp\Views\View;

class PostView extends View {
    const BILLET_VUE = 1;
    const LISTE_VUE = 2;
    const CREATE_POST_VUE = 3;
    
    public function render() {
        switch($this->selecteur) {
        case self::BILLET_VUE:
            $content = $this->billet();
            break;
        case self::LISTE_VUE:
            $content = $this->liste();
            break;
        }
        return $this->userPage($content);
    }

    public function billet() {
        $res = "";

        if ($this->source != null) {
            $post = $this->source;
            $usr = Post::getAuthor($post->user_id);
            $nbComments = $post->getComments()->count();
            $lastModif = ($post->date_modification != null) ? "Dernière modification : " . $post->date_modification : "";
            $authorImg = ($usr->image == null) ? '/images/default_post_image.jpg' : $usr->image;
            $content = <<<YOP
    <h2 class="title">$post->title</h2>
    <div class="card-info d-flex" style="margin-bottom: 1rem;">
        <div class="card-info-sub">
            <i class="far fa-calendar-alt"></i> Création : $post->date_creation $lastModif
        </div>
        <div class="card-info-sub">
            <i class="far fa-comments"></i> $nbComments comment(s)
        </div>
    </div>
    <div class="post_body">
        $post->body
    </div>
YOP;

            $author = <<<YOP
    <h3>A propos de l'auteur</h3>
    <img src="{$this->baseURL()}$authorImg" class="author-pic" alt="...">
    <h5>$usr->name $usr->surname</h5>
YOP;


        $comments = $post->getComments;
        $commentsPanel = "";
        foreach ($comments as $comment) {
            $commentAuthor = Comment::getAuthor($comment->user_id);
            $commentLastModif = ($comment->date_modification == null) ? "" : "Dernière modification : " . $comment->date_modification;
            $commentsPanel .= <<<YOP
    <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                $comment->title
              </div>
              <div class="card-body">
                <div class="card-info d-flex" style="margin-bottom: 1rem;">
                    <div class="card-info-sub">
                        <i class="far fa-user"></i> $commentAuthor->name $commentAuthor->surname
                    </div>
                    <div class="card-info-sub">
                        <i class="far fa-calendar-alt"></i> $post->date_creation $commentLastModif
                    </div>
                </div>
                <p class="card-text">$comment->body</p>
              </div>
            </div>
        </div>
    </div>
YOP;

        }
        } else {
            $content = "<h1>Erreur : le billet n'existe pas !</h1>";
            $author = "";
            $commentsPanel = "";
        }

            $res = <<<Yop
    <div class="row">
        <div class="post col-md-8 post-panel p-3">
            $content
        </div>
        <div class="col-md-4 author-panel p-3">
            $author
        </div>
    </div>

    <h1>Commentaires</h1>
    $commentsPanel
Yop;


        return $res;
    }

    public function liste() {
        $res = "";
        
        if ($this->source != null) {
            $res = <<<YOP
    <h1>Affichage de la liste des billets</h1>
    <ul>
YOP;

            foreach ($this->source as $billet) {
                $url = $this->cont->router->pathFor('post_display', ['id' => $billet->id]);
                $res .= <<<YOP
      <li><a href="$url">{$billet->titre}</a></li>
YOP;
            }
            $res .= "</ul>";
        }
        else
            $res = "<h1>Erreur : la liste de billets n'existe pas !</h1>";

        return $res;
    }
}
