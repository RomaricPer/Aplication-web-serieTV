<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    private string $menu ="";
    public function __construct(string $title = "")
    {
        parent::__construct();
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>{$this->getTitle()}</title>
            {$this -> getHead()}
        </head>
        <body>
            <div class="header">
                <h1>{$this->getTitle()}</h1>
            </div>
            <div></div>
            <div class="content">
                {$this->getBody()}
            </div>
             <div class="footer">
                {$this->getLastModification()}
            </div>     
        </body>
        </html>
HTML;
    }

    /**
     * @return string
     */
    public function getMenu(): string
    {
        return $this->menu;
    }
    public function appendButton(string $name, string $link):void
    {
        $this->menu = "<a href='{$link}'>img = src='{$name}'></a>";
    }
}
