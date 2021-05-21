<?php

namespace blogapp\Controllers;

use blogapp\Authentification\Auth;
use blogapp\Models\Category;
use blogapp\Views\CategoryView;

class CategoryController
{
    public function __construct($conteneur) {
        $this->cont = $conteneur;
    }

    public function manageCategories($rq, $rs, $args) {
        if (Auth::hasRight(2)) {
            $cats = Category::orderBy('title', 'asc')->get();
            $bl = new CategoryView($this->cont, $cats, CategoryView::LIST_VIEW);
            $rs->getBody()->write($bl->render());
            return $rs;
        }
        return $rs->withRedirect($this->cont->router->pathFor('index'));
    }

    public function create($rq, $rs, $args) {
        $cat = [
            'title' => filter_var($rq->getParsedBodyParam('title'), FILTER_SANITIZE_STRING),
            'desc' => filter_var($rq->getParsedBodyParam('desc'), FILTER_SANITIZE_STRING)
        ];

        if (Category::getByTitle($cat['title']) != null) {
            $this->cont->flash->addMessage('error', "Une catégorie avec ce nom existe déjà...");
            return $rs->withRedirect($this->cont->router->pathFor('cat_manage'));
        }

        Category::create($cat);

        // Ajout d'un flash
        $this->cont->flash->addMessage('info', "Catégorie créée !");
        // Retour de la réponse avec redirection
        return $rs->withRedirect($this->cont->router->pathFor('cat_manage'));
    }

    public function delete($rq, $rs, $args) {
        if (($cat = Category::getById($args['id'])) != null)
            $cat->delete();

        return $rs->withRedirect($this->cont->router->pathFor('cat_manage'));
    }
}