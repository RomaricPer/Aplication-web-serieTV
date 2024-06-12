<?php
declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Html\AppWebPage;
use Entity\Collection\TvShowCollection;

$webPage = new AppWebPage();

if (isset($_GET['genre']) && ctype_digit($_GET['genre'])) {
    $genreId = (int)$_GET['genre'];
    $ligne = TvShowCollection::findByGenreId($genreId);
} else {
    $ligne = TvShowCollection::findAll();
}

$ligneGenre = GenreCollection::findAll();
$webPage -> appendCssUrl("css/styles.css");
$webPage -> setTitle("Séries TV");
$webPage -> appendButton("create","Ajouter une série", "tvshow-form.php");
$webPage->appendContent(<<<HTML
                        <div class="filter">
                            <form action="index.php">
                                <label>
                                    Sélectionner un genre
                                </label>
                                <select name="genre">
HTML);

foreach ($ligneGenre as $genre) {
    $webPage->appendContent(<<<HTML
                        <option value="{$genre->getId()}">{$genre->getName()}</option>
HTML);}

$webPage->appendContent(<<<HTML
                                </select>
                                <button type="submit">Enregistrer</button>
                                <button class="reset" onclick="window.location.href = 'index.php'">Rénitialiser</button>
                            </form>
                        </div>
HTML
);
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

