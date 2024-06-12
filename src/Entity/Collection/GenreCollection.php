<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Collection\TvShowCollection;
use Entity\Genre;

class GenreCollection
{
    /**
     * @return Genre[]
     */
    public static function findAll():array
    {
        $stmt = MyPdo::getInstance()->prepare(<<<'SQL'
        SELECT id, name
        FROM genre
        ORDER BY name
        SQL);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Genre::class);
    }
}