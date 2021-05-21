# Projet Blog

Projet de blog réalisé dans le cadre du cours de programmation Web à l'IUT Nancy-Charlemagne en DUT AS (2020-2021).

## Installation
1. Clone the repo localy

```bash
git clone https://github.com/DrNossberg/blogas.git
```

2. Install the packages with composer

```bash
composer install
```

3. Create the database and import `blog.sql` in your new database
4. Duplicate `conf.ini.skel`, remove `.skel` extension and complete it :

```
driver=mysql
username=
password=
host=
database=
charset=utf8
collation=utf8_unicode_ci
```

5. Enjoy!


## Features

* Home page with 20 last posts (pagination button exists but doesn not work)
* Registering of a new member: it verifies if nickname and email are not already existing
* Connexion of a member (remember session for 7 days, works on one browser at the time), you can also disconnect manually
* Display of a complete post with its comments
* Entry of a new post (members and admins only)
* Entry of a new comment on a post (members and admins only)

In the database, passwords are hashed for more security and connexion tokens are hashed too.

Admin panel (for admins only):
* Entry of a new category: it verifies if the category name doesn't already exists 
* Display list of members: ordered by names
* Possibility to expel a member (and unexpel): when expeled, a member cannot connect and their posts / comments are not shown
⋅⋅⋅ For some reasons expeling a member sometimes bugs and another member is expeled (May be odds be ever in your favor)

