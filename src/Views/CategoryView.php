<?php

namespace blogapp\Views;

class CategoryView extends View {
    const LIST_VIEW = 1;

    public function render() {
        switch($this->selecteur) {
            case self::LIST_VIEW:
                $content = $this->list();
                break;
        }
        return $this->userPage($content);
    }

    public function list() {
        $res = "";

        $res .= <<<YOP
    <form class="row g-3 full_form shadow rounded p-3" method="post" action="{$this->cont['router']->pathFor('cat_create')}">
        <div class="col-md-6">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" placeholder="Un super titre" required name="title">
        </div>
        <div class="col-md-6">
            <label for="desc" class="form-label">Description</label>
            <input type="text" class="form-control" id="desc" placeholder="Une petite description" required name="desc">
        </div>
        <div class="col-12">
            <button class="btn btn-primary bg-dark" type="submit">Créer une catégorie</button>
        </div>
    </form>
YOP;

        if ($this->source != null) {
            $res .= <<<YOP
            <div class="row">
YOP;

            foreach($this->source as $cat) {
                $nbPosts = $cat->billets()->count();

                $res .= <<<YOP
    <div class="card p-3 col-lg-3 shadow card_cat">
        <div class="row card-body">
            <div>
                <h3 class="card-title">$cat->title</h3>
                <div class="card-info d-flex" style="margin-bottom: 1rem;">
                    <div class="card-info-sub">
                        <i class="far fa-file"></i> $nbPosts post(s)
                    </div>
                </div>
                <p class="card-text">$cat->description</p>

                <form method="post" action="{$this->cont->router->pathFor('cat_delete', ['id' => $cat->id])}">
                    <button class="btn btn-primary bg-dark" type="submit">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
YOP;
            }

            $res .= <<<YOP
            </div
YOP;
        }

        return $res;
    }
}