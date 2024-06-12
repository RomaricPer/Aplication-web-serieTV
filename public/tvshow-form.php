<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\Form\TvShowForm;

try {
    $tvshow = null;

    if (isset($_GET['tvShowId']))
    {
        if (!ctype_digit($_GET['tvShowId']))
        {
            throw new ParameterException("Identifiant de la série invalide");
        }
        else
        {
            $tvshow = TvShow::findById((int)$_GET['tvShowId']);
        }
    }
    $tvShowForm = new TvShowForm($tvshow);

    echo $tvShowForm->getHtmlForm("./tvshow-save.php");
}catch (ParameterException) {
    http_response_code(400);
}catch (EntityNotFoundException){
    http_response_code(404);
}catch (Exception){
    http_response_code(500);
}
