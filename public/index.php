<?php
declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\TvShowCollection;
use Entity\Poster;


$webPage = new AppWebPage();

$ligne = TvShowCollection::findAll();
$webPage -> appendCssUrl("css/styles.css");
$webPage -> setTitle("Séries TV");
$webPage -> appendButton("create","Créer", "tvshow-form.php");
$webPage->appendContent('<div class="container">');
foreach ($ligne as $tvshow) {
    $webPage->appendContent("<a href='tvshow.php?tvShowId={$tvshow->getId()}'>
                                    <div class='content_serie'>
                                        <div class='poster'><img src='poster.php?posterId={$tvshow->getPosterId()}'></div>
                                        <div class='text'>
                                            <div class='name'>
                                                {$webPage->escapeString($tvshow->getName())}
                                            </div>
                                            <div class='description'>{$webPage->escapeString($tvshow->getOverview())}</div>
                                        </div>
                                    </div></a>\n");
}
$webPage->appendContent('</div>');

echo $webPage->toHTML();

