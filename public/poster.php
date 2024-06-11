<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Poster;

try {
    if (isset($_GET['posterId']) && (ctype_digit($_GET['posterId']))) {
        $poster = \Entity\Poster::findById((int)$_GET['posterId']);
    } else {
        throw new ParameterException("id de poster non valide");
    }
    header('Content-Type: image/jpeg');
    echo $poster->getJpeg();
} catch (ParameterException) {
    header('Location: /img/default.png');
} catch (EntityNotFoundException) {
    header('Location: /img/default.png');
} catch (Exception) {
    http_response_code(500);

}
