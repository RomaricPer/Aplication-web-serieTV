# SAÉ 2.01 - Développement d’une application

### Membres du binome : 
- MARCOUX Corentin - **marc0237**
- PERICHARD Romaric - **peri0060**

#### Mise en place du projet
Dans une première partie, nous avons d'abord ajouter les fichiers vitaux pour notre projet dans notre branche 'main'.
Les fichiers concernés sont :
- run-server.sh : commande de lancement du serveur
- composer.json
- .gitignore : exclue les fichiers .mypdo.ini, .idea ainsi que le fichier /vendor/
- Les classes WebPage et AppWebPage : permettent la création d'une page web

Nous avons également chacun de notre côté installé composer dans notre projet.
La base de données a aussi été généré sur chaque session.


#### Création de la page d'acceuil index.php

Afin de pouvoir créer notre page d'acceuil, il était nécessaire d'avoir des classes qui récupère toutes les informations
des séries, et que l'on puisse les lister.
Nous avons donc fait :
- TvShow.php qui récupère tous les attributs de la table tvshow
- Poster.php qui récupère le poster d'une série
- poster.php qui vérifie et retourne l'image si le poster de la série est valide
- TvShowCollection qui liste toutes les séries que renvoie TvShow.php
- index.php qui créer la page Web avec AppWebPage et qui récupère les données des classes précédentes pour lister les séries.
- style.css qui met en page notre site Web

#### Création des pages Séries

Pour arriver au résultat souhaité, il faut créer de nouvelles classes qui répertorie les différentes saisons d'une série. Enfin, il faut faire un nouveau fichier php qui utilisent les méthodes
de ces classes et qui produit une page web affichant le titre et le poster de la série, les titres et les poster de chaques saisons.
Les classes nécessaires sont : 
- 

