<?php

namespace blogapp\Controllers;

use blogapp\Authentification\Auth;
use blogapp\Views\UserView;
use blogapp\Models\User;

class UserController {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function createUserForm($rq, $rs, $args) {
        $bl = new UserView($this->cont, null, UserView::NOUVEAU_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function connectionUserForm($rq, $rs, $args) {
        $bl = new UserView($this->cont, null, UserView::CONNECTION_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function connect($rq, $rs, $args) {
        // Get variables POST + cleaning
        $nickname = filter_var($rq->getParsedBodyParam('nick'), FILTER_SANITIZE_STRING);
        $password = filter_var($rq->getParsedBodyParam('pass'), FILTER_SANITIZE_STRING);

        // Test if password is ok
        $user = User::getByUsername($nickname);

        if (password_verify($password, $user->password)) {
            Auth::authentify($user);
            $this->cont->flash->addMessage('info', "Utilisateur $user->name connecté !");
        }
        else {
            $this->cont->flash->addMessage('info', "Wrong password! " .$nickname);
        }

        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }

    public function create($rq, $rs, $args) {
        // Récupération variable POST + nettoyage
        $user = [
          'name' => filter_var($rq->getParsedBodyParam('name'), FILTER_SANITIZE_STRING),
            'surname' => filter_var($rq->getParsedBodyParam('surname'), FILTER_SANITIZE_STRING),
            'nick' => filter_var($rq->getParsedBodyParam('nickname'), FILTER_SANITIZE_STRING),
            'email' => filter_var($rq->getParsedBodyParam('mail'), FILTER_SANITIZE_STRING),
            'password' => password_hash(filter_var($rq->getParsedBodyParam('password'), FILTER_SANITIZE_STRING), PASSWORD_DEFAULT),
        ];

        // Insertion dans la base...
        User::create($user);

        // Ajout d'un flash
        $this->cont->flash->addMessage('info', "Utilisateur ajouté ! $user");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }

    public function disconnect($rq, $rs, $args) {
        $usr = User::getByUsername($_COOKIE['user_login']);
        $usr->token = null;
        $usr->save();
        $_COOKIE['user_login'] = null;
        $_COOKIE['token'] = null;
        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }
}
