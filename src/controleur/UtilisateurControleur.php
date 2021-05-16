<?php

namespace blogapp\controleur;

use blogapp\Authentification\Auth;
use blogapp\vue\UtilisateurVue;
use blogapp\modele\User;

class UtilisateurControleur {
    private $cont;
    
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function nouveau($rq, $rs, $args) {
        $bl = new UtilisateurVue($this->cont, null, UtilisateurVue::NOUVEAU_VUE);
        $rs->getBody()->write($bl->render());
        return $rs;
    }

    public function connection($rq, $rs, $args) {
        $bl = new UtilisateurVue($this->cont, null, UtilisateurVue::CONNECTION_VUE);
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

        return $rs->withRedirect($this->cont->router->pathFor('billet_liste'));
    }

    public function cree($rq, $rs, $args) {
        // Récupération variable POST + nettoyage
        $nom = filter_var($rq->getParsedBodyParam('nom'), FILTER_SANITIZE_STRING);
        $password = password_hash(filter_var($rq->getParsedBodyParam('password'), FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

        // Insertion dans la base...
        User::create($nom, $password);

        // Ajout d'un flash
        $this->cont->flash->addMessage('info', "Utilisateur $nom ajouté !");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('billet_liste'));
    }
}
