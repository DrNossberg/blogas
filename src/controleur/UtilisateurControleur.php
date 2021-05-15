<?php

namespace blogapp\controleur;

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
        $user = User::where('name', '=', $nom)->first();
        echo $user->name . ' ' . $user->password;
        $good = password_verify($password, $user->password);

        if ($good)
            $this->cont->flash->addMessage('info', "Utilisateur $user->name connecté !");
        else
            $this->cont->flash->addMessage('info', "Wrong password!");

        return $rs->withRedirect($this->cont->router->pathFor('billet_liste'));
    }

    public function cree($rq, $rs, $args) {
        // Récupération variable POST + nettoyage
        $nom = filter_var($rq->getParsedBodyParam('nom'), FILTER_SANITIZE_STRING);
        $password = filter_var($rq->getParsedBodyParam('password'), FILTER_SANITIZE_STRING);

        // Insertion dans la base...
        $user = User::create([
            'name' => $nom,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // Ajout d'un flash
        $this->cont->flash->addMessage('info', "Utilisateur $nom ajouté !");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('billet_liste'));
    }
}
