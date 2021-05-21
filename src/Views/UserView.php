<?php

namespace blogapp\Views;

use blogapp\Models\Post;
use blogapp\Views\View;

class UserView extends View {
    const NOUVEAU_VUE = 1;
    const CONNECTION_VUE = 2;
    const MANAGE_VUE = 3;
    
    public function render() {
        switch($this->selecteur) {
        case self::NOUVEAU_VUE:
            $content = $this->createUser();
            break;
        case self::CONNECTION_VUE:
            $content = $this->connection();
            break;
        case self::MANAGE_VUE:
            $content = $this->manageUsers();
            break;
        }
        return $this->userPage($content);
    }

    public function createUser() {
        return <<<YOP
        <form class="row g-3 full_form p-3 rounded shadow" method="post" action="{$this->cont['router']->pathFor('user_create')}">
            <h1>Creation of user</h1>
            <div class="col-md-4">
                <label for="name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="name" placeholder="John" required name="name">
            </div>
            <div class="col-md-4">
                <label for="surname" class="form-label">Nom</label>
                <input type="text" class="form-control" id="surname" placeholder="Doe" required name="surname">
            </div>
            <div class="col-md-4">
                <label for="nickname" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="nickname" placeholder="xXDarkJohnD_69Xx" required name="nickname">
            </div>
            <div class="col-md-8">
                <label for="mail" class="form-label">Email</label>
                <input type="email" class="form-control" id="mail" placeholder="john.doe@example.com" required name="mail">
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="1234" required name="password">
            </div>
            <div class="col-md-12">
                <label for="image" class="form-label">Image de profil</label>
                <input type="file" class="form-control" id="image" aria-label="file example" name="image">
                <div class="invalid-feedback">Example invalid form file feedback</div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary bg-dark" type="submit">S'inscrire</button>
            </div>
        </form>
YOP;
    }

    public function connection() {
        return <<<YOP
        <form class="row g-3 full_form p-3 rounded shadow" method="post" action="{$this->cont['router']->pathFor('user_connection')}">
            <h1>Connection of user</h1>
            <div class="col-md-6">
                <label for="nick" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="nick" placeholder="Pseudo" required name="nick">
            </div>
            <div class="col-md-6">
                <label for="pass" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="pass" placeholder="1234" required name="pass">
            </div>
            <div class="col-12">
                <button class="btn btn-primary bg-dark" type="submit">Se connecter</button>
            </div>
        </form>
YOP;

    }

    public function manageUsers() {
        $res = "";

        if ($this->source != null) {
            foreach ($this->source as $user) {
                $nbPosts = $user->getPosts()->count();
                $nbComments = $user->getComments()->count();
                $status = ($user->date_deletion != null) ? "Radié depuis le " . $user->date_deletion : "Non radié";
                $res .= <<<YOP
    <div class="card p-3">
        <div class="row card-body d-flex">
            <div class="col-md-2">
                <img src="default_post_image.jpg">
            </div>
            <div class="col-md-10">
                <h3 class="card-title">$user->name $user->surname ($user->nickname)</h3>
                <div class="card-info d-flex" style="margin-bottom: 1rem;">
                    <div class="card-info-sub">
                        <i class="far fa-calendar-alt"></i> $user->date_creation
                    </div>
                    <div class="card-info-sub">
                        <i class="far fa-file"></i> $nbPosts post(s)
                    </div>
                    <div class="card-info-sub">
                        <i class="far fa-comments"></i> $nbComments comment(s)
                    </div>
                </div>
                <p class="card-text">$user->email</p>
                <p class="card-text">Status : $status</p>
YOP;
                if ($user->date_deletion == null)
                    $res .= <<<YOP
                <form method="post" action="{$this->cont->router->pathFor('user_expel', ['id' => $user->id])}">
                    <button class="btn btn-primary bg-dark" type="submit">Radier</button>
YOP;
                else
                    $res .= <<<YOP
                <form method="post" action="{$this->cont->router->pathFor('user_unexpel', ['id' => $user->id])}">
                    <button class="btn btn-primary bg-dark" type="submit">Dé-radier</button>
                </form>
YOP;


                $res .= <<<YOP
            </div>
        </div>
    </div>
YOP;
            }

        }
        else
            $res = <<<YOP
    <div class="card p-3">
        <div class="row card-body d-flex">
            <h3 class="card-title">Aucun utilisateur trouvé</h3>
        </div>
    </div>
YOP;

        return $res;
    }

}
