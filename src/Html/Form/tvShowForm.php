<?php
declare(strict_types=1);

namespace Html\Form;
use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class tvShowForm{
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
    }

