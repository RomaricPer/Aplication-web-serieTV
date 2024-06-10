<?php
declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\TvShowCollection;
use Entity\Poster;


$webPage = new AppWebPage();

$ligne = TvShowCollection::findAll();
$webPage -> appendCssUrl("css/styles.css");
$webPage -> setTitle("Séries TV");
$webPage->appendContent('<div class="container">');
foreach ($ligne as $tvshow) {
    $webPage->appendContent("<div class='content'>
                                        <div class='poster'><img src='poster.php?posterId={$tvshow->getPosterId()}'></div>
                                        <div class='text'>
                                            <div class='name'>
                                                <a href=''>{$webPage->escapeString($tvshow->getName())}</a>
                                            </div>
                                            <div class='description'>{$webPage->escapeString($tvshow->getOverview())}</div>
                                        </div>
                             </div>\n");
}
$webPage->appendContent('</div>');

echo $webPage->toHTML();
