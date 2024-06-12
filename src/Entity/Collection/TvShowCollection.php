<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
class TvShowCollection
{
    /**
     * @return TvShow[]
     */
    public static function findAll(): array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT id, name, overview, posterId
        FROM tvshow
        ORDER BY name
SQL);
        $stmt -> execute();
        return $stmt -> fetchAll(\PDO::FETCH_CLASS, TvShow::class);
    }
    public static function findByGenreId(int $genreId):array
    {
        $stmt = MyPdo::getInstance()->prepare(<<<'SQL'
        SELECT id,name,overview,posterId
        FROM tvshow
        WHERE id IN (SELECT tvShowId
                     FROM tvshow_genre
                     WHERE genreId = :genreId)
        ORDER BY name
        SQL);
        $stmt->execute(['genreId'=>$genreId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS,TvShow::class);
    }
}