<?php

namespace blogapp\Views;
use blogapp\Authentification\Auth;
use blogapp\Models\Category;
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
        case self::CREATE_POST_VUE:
            $content = $this->create();
            break;
        }
        return $this->userPage($content);
    }

    public function billet() {
        $res = "";

        if ($this->source != null && !Auth::isExpeled($this->source->user_id)) {
            /*
             * POST itself
             */
            $post = $this->source;
            $usr = Post::getAuthor($post->user_id);
            $nbComments = $post->getComments()->count();
            $lastModif = ($post->date_modification != null) ? "Dernière modification : " . $post->date_modification : "";
            $authorImg = ($usr->image == null) ? '/images/default_post_image.jpg' : $usr->image;
            $category = $post->categorie->title;
            $content = <<<YOP
    <h2 class="title">$post->title</h2>
    <div class="card-info d-flex" style="margin-bottom: 1rem;">
        <div class="card-info-sub">
            <i class="far fa-calendar-alt"></i> Création : $post->date_creation $lastModif
        </div>
        <div class="card-info-sub">
            <i class="far fa-comments"></i> $nbComments comment(s)
        </div>
        <div class="card-info-sub">
            <i class="far fa-folder-open"></i> $category
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
        $commentsForm = "";
        $commentsPanel = "";

        if (Auth::hasRight(1)) {
            $commentsForm = <<<YOP
    <form class="row g-3 full_form p-3 col-md-8 rounded" method="post" action="{$this->cont->router->pathFor('comment_create', ['id' => $post->id])}">
        <div class="col-md-8">
            <div class="col-md-6">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" placeholder="Titre" required name="title">
            </div>
            <div class="col-md-12">
                <label for="body" class="form-label">Corps du message</label>
                <textarea class="form-control" placeholder="Corps du message" required id="body" name="body" style="height: 200px;"></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary bg-dark" type="submit">Envoyer le commentaire</button>
            </div>
        </div>
    </form>
YOP;

        }

        $comments = $post->getComments;
        $commentsPanel = "";
        foreach ($comments as $comment) {
            if (!Auth::isExpeled($comment->user_id)) {
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
                            <i class="far fa-calendar-alt"></i> $comment->date_creation $commentLastModif
                        </div>
                    </div>
                    <p class="card-text">$comment->body</p>
                  </div>
                </div>
            </div>
        </div>
YOP;
            }

        }
        } else {
            $content = "<h1>Erreur : le billet n'existe pas !</h1>";
            $commentsForm = "";
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
    $commentsForm
    $commentsPanel
Yop;


        return $res;
    }

    public function create() {
        $categories = Category::get();
        $res = <<<YOP
        <h1>Création d'un post</h1>
        <form class="row g-3" method="post" action="{$this->cont['router']->pathFor('post_create')}">
            <div class="col-md-6">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" placeholder="Titre" required name="title">
            </div>
            <div class="col-md-12">
                <label for="body" class="form-label">Corps du message</label>
                <textarea class="form-control" placeholder="Corps du message" required id="body" name="body" style="height: 520px"></textarea>
            </div>
            <div class="col-md-12">
                <label for="cat" class="form-label">Catégorie du message</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="cat" id="cat">
                  <option selected>Choix de la catégorie</option>
YOP;
        foreach ($categories as $category)
            $res .= "<option value='" . $category->id . "'>" . $category->title . "</option>";

        $res .= <<<YOP
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Créer le post</button>
            </div>
        </form>
YOP;

        return $res;
    }
}
