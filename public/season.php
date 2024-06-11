<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Entity\TvShow;
use Entity\Season;
use Entity\Collection\EpisodeCollection;

$seasonId = $_GET['seasonId'];

if (isset($seasonId) && ctype_digit($seasonId)) {
    try{
        $season = Season::findById((int)$seasonId);
    }
    catch (EntityNotFoundException){
        http_response_code(404);
    }

    $webPage = new AppWebPage();
    $tvShow = TvShow::findById($season->getTvShowId());
    $webPage -> setTitle("Séries TV : {$webPage->escapeString($tvShow->getName())} <br> {$webPage->escapeString($season->getName())}");
    $webPage -> appendCssUrl("css/styles.css");

    $webPage -> appendContent(
        <<<HTML
    <div class="container">
        <div class='contentserie'>
        <div class='poster'>
            <img src='poster.php?posterId={$season->getPosterId()}'>
        </div>
        <div class='text'>
            <div class='name'>
                    <a href="tvshow.php?tvShowId={$season->getTvShowId()}">{$webPage->escapeString($tvShow->getName())}</a>
            </div>
            <div class='description'>
                {$webPage->escapeString($season->getName())}
            </div>
        </div>
    </div><br>

HTML);

    $episodes = EpisodeCollection::findEpisodeBySeasonId($seasonId);
    foreach ($episodes as $episode){
        $webPage -> appendContent(
        <<<HTML
        <div class="content_episode">
            <div class="num_episode">{$episode->getEpisodeNumber()}</div>
            <div class="titre_episode">{$episode->getName()}</div>
            <div class="description_episode">{$episode->getOverview()}</div>
        </div><br>
HTML);
    }

    $webPage -> appendContent("</div>");
    echo $webPage->toHTML();
}
else{

}
