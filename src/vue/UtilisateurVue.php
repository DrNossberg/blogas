<?php

namespace blogapp\vue;

use blogapp\vue\Vue;

class UtilisateurVue extends Vue {
    const NOUVEAU_VUE = 1;
    const CONNECTION_VUE = 2;
    
    public function render() {
        switch($this->selecteur) {
        case self::NOUVEAU_VUE:
            $content = $this->nouveau();
            break;
        case self::CONNECTION_VUE:
            $content = $this->connection();
            break;
        }
        return $this->userPage($content);
    }

    public function nouveau() {
        return <<<YOP
        <h1>Creation of user</h1>
        <form method="post" action="{$this->cont['router']->pathFor('util_cree')}">
          Name: <input type="text" name="nom">
          Password: <input type="password" name="password">
          <input type="submit" value="Go go go !">
        </form>
YOP;
    }

    public function connection() {
        return <<<YOP
        <h1>Connection of user</h1>
        <form method="post" action="{$this->cont['router']->pathFor('util_connect')}">
            <input type="text" name="nom">
            <input type="password" name="password">
            <input type="submit" value="Sign in">
        </form>
YOP;

    }
}
