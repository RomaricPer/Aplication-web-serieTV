<?php
declare(strict_types=1);

namespace Html\Form;
use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm{
    use StringEscaper;

    private ?TvShow $tvShow;
    public function __construct(?TvShow $tvShow = null)
    {
        $this->tvShow = $tvShow;
    }
        public function getTvShow(): ?TvShow
        {
            return $this->tvShow;
        }

    public function getHtmlForm(string $action): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="utf8">
            <title></title>
        </head>
        <body> 
            <form method="post" action="{$action}">
            <input name="id" type="hidden" value="{$this->tvShow?->getId()}">
                <label> 
                    Name
                    <input name="name" type="text" value="{$this->escapeString($this->tvShow?->getName())}" required>
                </label>
                <label>
                    Original Name
                    <input name="original_name" type="text" value="{$this->escapeString($this->tvShow?->getOriginalName())}" required>
                </label>
                <label>
                    Home page
                    <input name="homepage" type="text" value="{$this->escapeString($this->tvShow?->getHomepage())}" required>
                </label>
                <label>
                    Overview
                    <input name="overview" type="text" value="{$this->escapeString($this->tvShow?->getOverview())}" required>
                </label>
                <button type="submit">Save</button>
            </form>
        </body>
        </html>
    HTML;
    }

    public function setEntityFromQueryString(): TvShow{
        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = (int) $_POST['id'];
        }
        if (!empty($_POST['name'])) {
            $name = $this->escapeString($this->stripTagsAndTrim($_POST['name']));
        } else {
            throw new ParameterException("Nom de série manquante");
        }
        if (!empty($_POST['original_name'])) {
            $original_name = $this->escapeString($this->stripTagsAndTrim($_POST['original_name']));
        } else {
            throw new ParameterException("Nom de série original manquant");
        }
        if (!empty($_POST['homepage'])) {
            $homepage = $this->escapeString($this->stripTagsAndTrim($_POST['homepage']));
        } else {
            throw new ParameterException("Lien de la page manquant");
        }
        if (!empty($_POST['overview'])) {
            $overview = $this->escapeString($this->stripTagsAndTrim($_POST['overview']));
        } else {
            throw new ParameterException("Description manquante");
        }
        return $this->tvShow = TvShow::create($id, $name, $original_name, $homepage, $overview);
    }
    }

