<?php
declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Poster;

try {
    if (isset($_GET['posterId']) && (ctype_digit($_GET['posterId']))) {
        $poster = \Entity\Poster::findById((int)$_GET['posterId']);
    } else {
        throw new ParameterException();
    }
    header('Content-Type: image/jpeg');
    echo $poster->getJpeg();

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);

}
