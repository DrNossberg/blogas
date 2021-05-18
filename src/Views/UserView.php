<?php

namespace blogapp\Views;

use blogapp\Views\View;

class UserView extends View {
    const NOUVEAU_VUE = 1;
    const CONNECTION_VUE = 2;
    
    public function render() {
        switch($this->selecteur) {
        case self::NOUVEAU_VUE:
            $content = $this->createUser();
            break;
        case self::CONNECTION_VUE:
            $content = $this->connection();
            break;
        }
        return $this->userPage($content);
    }

    public function createUser() {
        return <<<YOP
        <h1>Creation of user</h1>
        <form class="row g-3" method="post" action="{$this->cont['router']->pathFor('user_create')}">
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
                <input type="file" class="form-control" id="image" aria-label="file example" required name="image">
                <div class="invalid-feedback">Example invalid form file feedback</div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">S'inscrire</button>
            </div>
        </form>
YOP;
    }

    public function connection() {
        return <<<YOP
        <h1>Connection of user</h1>
        <form class="row g-3" method="post" action="{$this->cont['router']->pathFor('user_connection')}">
            <div class="col-md-6">
                <label for="nick" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="nick" placeholder="Pseudo" required name="nick">
            </div>
            <div class="col-md-6">
                <label for="pass" class="form-label">Mot dfe passe</label>
                <input type="password" class="form-control" id="pass" placeholder="1234" required name="pass">
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Se connecter</button>
            </div>
        </form>
YOP;

    }
}
