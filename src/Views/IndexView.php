<?php


namespace blogapp\Views;


use blogapp\Models\Post;
use blogapp\Authentification\Auth;

class IndexView extends View
{
    const INDEX_VUE = 1;

    public function render() {
        $content = $this->displayPosts();

        return $this->userPage($content);
    }

    public function displayPosts() {
        $res = "";

        if ($this->source != null) {

            foreach ($this->source as $post) {
                if (!Auth::isExpeled($post->user_id)) {
                    $url = $this->cont->router->pathFor('post_display', ['id' => $post->id]);
                    $usr = Post::getAuthor($post->user_id);
                    $nbComments = $post->getComments()->count();
                    $body = substr($post->body, 0, 300) . "...";
                    $image = ($post->image == null) ? '/images/default_post_image.jpg' : $post->image;
                    $category = $post->categorie->title;
                    $res .= <<<YOP
        <div class="card p-3 shadow">
            <div class="row card-body d-flex">
                <h3 class="card-title">$post->title</h5>
                    <div class="card-info d-flex" style="margin-bottom: 1rem;">
                        <div class="card-info-sub">
                            <i class="far fa-user"></i> $usr->name $usr->surname
                        </div>
                        <div class="card-info-sub">
                            <i class="far fa-calendar-alt"></i> $post->date_creation
                        </div>
                        <div class="card-info-sub">
                            <i class="far fa-comments"></i> $nbComments comment(s)
                        </div>
                        <div class="card-info-sub">
                            <i class="far fa-folder-open"></i> $category
                        </div>
                    </div>
                <div class="col">
                    <img src="{$this->baseURL()}$image" class="card-img-top" alt="...">
                </div>
                <div class="col-lg-8">
                    <div class="row" style="height: 80%;">
                        <p class="card-text m-8">$body</p>
                    </div>
                    <div class="row justify-content-end">
                        <a href="$url" class="btn btn-primary bg-dark" style="width: auto;">See more</a>
                    </div>
                </div>
            </div>
        </div>
YOP;                
                }

            }
        }
        else
            $res = "<h1>Erreur : la liste de billets n'existe pas !</h1>";

        return $res;

    }
}