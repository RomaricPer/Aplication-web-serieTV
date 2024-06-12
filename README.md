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
- SeasonCollection : est utilisé pour lister toutes les saisons d'une série
- Season : est utilisé pour créer des instances 'Season' représentant une saison.

Une modification du css a également été apporté pour mettre en forme les pages.

#### Création des pages Saisons

Dans cette partie, notre objectif était d'afficher chaque épisode d'une saison. Il était donc nécessaire de développer de nouvelles classes pour récupérer tous les épisodes d'une saison.
Les classes nécessaires à cet objectif sont :
- Episode.php : une méthode findById qui est utilisé pour récupérer un épisode d'une saison selon son identifiant de saison.
- EpisodeCollection.php : Une méthode findEpisodeBySeasonId qui récupère tous les épisodes d'une saison selon son identifiant de saison.

#### Création d'un formulaire d'ajout, suppression, modification de séries

Trois fichiers et des modifications ont été nécessaires afin de créer ce formulaire. En effet,
3 fichiers majeurs ont été développés lors de cette partie :
- TvShowForm.php : créer le formulaire sur la page.
- tvshow-form.php : enregistre les modifications dans la base de données
- tvshow-save.php : permet la création ou la modification d'une série
- tvshow-delete.php : permet la suppression d'une série

#### Création d'un filtre sur les séries dans index.php

Pour faire ce filtre, nous avons développé deux nouvelles classes : Genre.php, GenreCollection.php qui ont des méthodes similaires à nos classes précédentes
Il fallait également ajouter un nouveau formulaire dans index.php correspondant à une liste déroulante qui permet de sélectionner un genre et de supprimer de l'affichage
ceux ne correspondant pas à l'identifiant de genre demander.

#### Modification du CSS

En vue des modifications et de l'ajout de nouvelles pages web, nous avons donc dû développer davantage notre CSS pour qu'il s'adapte aux différentes pages, aux différentes tailles d'écrans pour chaques pages. 
Nous avions auparavant ajouté des classes dans notre page HTML pour simplifier la mise en page de celle-ci.
