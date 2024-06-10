<?php
declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\TvShowCollection;
use Entity\Poster;


$webPage = new AppWebPage("Séries TV");

$ligne = TvShowCollection::findAll();
$webPage->appendContent('<div class="container">');
foreach ($ligne as $tvshow) {
    $webPage->appendContent("<div class='content'>
                                        <div class='name'>
                                            <a href=''>{$webPage->escapeString($tvshow->getName())}</a>
                                        </div>
                                        <div class='description'>{$webPage->escapeString($tvshow->getOverview())}</div>
                                        <div class='poster'><img src='poster.php?posterId={$tvshow->getPosterId()}'></div>
                             </div>\n");
}
$webPage->appendContent('</div>');

echo $webPage->toHTML();
