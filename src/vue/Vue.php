<?php

namespace blogapp\vue;

use blogapp\Authentification\Auth;

class Vue {
    protected $cont;
    protected $source;
    protected $selecteur;

    public function __construct($cont, $src, $sel) {
        $this->cont = $cont;
        $this->source = $src;
        $this->selecteur = $sel;
    }

    // Méthode qui calcule la base de l'URL (nécessaire pour le bon
    // fonctionnnement des fichiers « statiques », comme styles.css)
    public function baseURL() {
        $url = $this->cont['environment']['SCRIPT_NAME'];
        $url = str_replace("/index.php", "", $url);
        return $url;
    }
    
    public function userPage($cont) {
        $flash = $this->cont->flash->getMessages();
        // Décommenter la ligne suivante pour voir la
        // structure des flashs (pour info)
        //var_dump($flash);
        $res = <<<YOP
 <!doctype html>
 <html>
   <head>
     <title>Application de Blog !</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="{$this->baseURL()}/css/styles.css" type="text/css" />
     <meta charset="utf-8" />
   </head>
   <body>

    <nav class="navbar navbar-expand-md bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
YOP;
        // Navbar
        if (Auth::isAuthentified())
            $res .= <<<NAV
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{url('/login')}">My Account</a>
        </li>
    </ul>
NAV;
        else
            $res .= <<<NAV
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{url('/login')}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{url('/register')}">Register</a>
        </li>
    </ul>
NAV;

        $res .= <<<NAV
        </div>
    </nav>
NAV;

        // Gestion des flashs
        if ($flash) {
            foreach ($flash as $catFlash => $lesFlash) {
                $res .= <<<YOP
            <div class="flash-$catFlash">
              <ul>
YOP;
                foreach($lesFlash as $f)
                    $res .= "<li>$f</li>";

                $res .= "</ul></div>";
            }
        }
        
        $res .= <<<YOP
     $cont
   </body>
</html>
YOP;

        return $res;
    }
}
