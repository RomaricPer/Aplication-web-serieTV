<?php
declare(strict_types=1);

use Entity\Collection\SeasonCollection;
use Html\AppWebPage;
use Entity\TvShow;
use Entity\Exception\EntityNotFoundException;

$tvShowId = $_GET['tvShowId'];

if (isset($tvShowId) && ctype_digit($tvShowId)) {
    try{
        $tvShow = TvShow::findById((int)$tvShowId);
    }
    catch (EntityNotFoundException){
        http_response_code(404);
    }

    $webPage = new AppWebPage();

    $webPage -> setTitle("Séries TV : {$webPage->escapeString($tvShow->getName())}");
    $seasons = SeasonCollection::findSeasonByTvShowId((int)$tvShowId);

    $webPage -> appendCssUrl("css/styles.css");
    $webPage -> appendButton("home", "Accueil", "index.php");
    $webPage -> appendButton("delete","Supprimer", "tvshow-delete.php?tvShowId={$tvShow->getId()}");
    $webPage -> appendContent(<<<HTML
    <div class='container'>
        <div class='content_serie'>
            <div class='poster'>
                <img src='poster.php?posterId={$tvShow->getPosterId()}'>
            </div>
            <div class='text'>
                <div class='name'>
                    {$webPage->escapeString($tvShow->getName())}
                </div>
                <div class='original_name'>
                    {$webPage->escapeString($tvShow->getOriginalName())}
                </div>
                <div class='description'>
                    {$webPage->escapeString($tvShow->getOverview())}
                </div>
            </div>
        </div><br>
        <div class="container_season">
HTML);

    foreach ($seasons as $seasonNum){
        $webPage -> appendContent(
            <<<HTML

        <div class="content_saison">
            <a href="season.php?seasonId={$seasonNum->getId()}">
                <div class="poster_season">
                    <img src='poster.php?posterId={$seasonNum->getPosterId()}'>
                </div>
                <div class="name_season">
                    {$webPage->escapeString($seasonNum->getName())}
                </div>
            </a>
        </div><br>
HTML);
    }
    $webPage->appendContent('</div></div>');

    echo $webPage->toHTML();
}
else{
    header('Location: index.php');
    exit();
}
