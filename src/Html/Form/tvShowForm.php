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
    }

