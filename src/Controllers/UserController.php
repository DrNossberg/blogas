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
        $nom = filter_var($rq->getParsedBodyParam('nom'), FILTER_SANITIZE_STRING);
        $password = filter_var($rq->getParsedBodyParam('password'), FILTER_SANITIZE_STRING);

        // Test if password is ok
        $user = User::getByUsername($nom);
        $good = password_verify($password, $user->password);

        if ($good) {
            Auth::authentify($user);
            $this->cont->flash->addMessage('info', "Utilisateur $user->name connecté !");
        }
        else
            $this->cont->flash->addMessage('info', "Wrong password!");

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
}
