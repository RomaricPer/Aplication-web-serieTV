<?php
declare(strict_types=1);

use Html\Form\TvShowForm;
use Entity\Exception\ParameterException;

try {
    $tvshowForm = new TvShowForm();
    $tvshowForm->setEntityFromQueryString();
    $tvshowForm->getTvShow()->save();

    header("Location: /index.php");
    exit();
} catch (ParameterException){
    http_response_code(400);
} catch (Exception){
    http_response_code(500);
}