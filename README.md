# Projet-4

## Qu'est ce que c'est ?

L'objectif de ce projet est de créer un blog (ou CRUD), en PHP-MySQL sans framework et en respectant le modèle MVC.

## Comment ça marche ?

A la racine se trouvent 3 dossier : _app_, _core_ et _public_.

Dans le dossier _core_ se trouvent les logiques génériques qui ne sont pas propres à l'application et qui peuvent être facilement réutilisées dans d'autres projet.

Dans le dossier _app_ se trouvent par contre toutes les logiques propres à l'application dans le format du modèle MVC avec les controllers, les modèles, les vues ainsi que les entités. C'est aussi dans le dossier _app_ que se trouve le router de l'application.

Dans le dossier _public_ se trouvent notre fichier __index.php__ dans lequel est initialisé l'application, ainsi que tous les fichiers et dossiers relatifs au thème du site (css et js) et logiques frontend (/public/js/blog.js).


## Comment l'utiliser ?

Vous êtes les bienvenues pour reprendre cette application de blog pour vos propres projets et l'enrichir en fonction de vos besoins. Il s'agit je l'espère d'une bonne base pour commencer :)

Si c'est votre souhait, téléchargez l'application depuis github. Il ne vous manquera plus qu'a importer la BDD dont je vous propose un dump à la racine et a créer un dossier config à la racine contenant un fichier config.php dont le template est le suivant :

```php
<?php

namespace \Config;

return array(
		'db_user' => 'user',
		'db_pass' => 'password',
		'db_host' => 'host',
		'db_name' => 'dbname',
	);
```

## Les librairies utilisées

Pour ce projet j'ai utilisé les librairies JQuery (https://jquery.com/) et MDBootstrap (https://mdbootstrap.com/) qui m'a fourni un très beau template de blog gratuit.





