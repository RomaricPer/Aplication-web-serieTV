<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;

class SeasonCollection
{
    /**
     * @return Season[]
     */
    public static function findSeasonByTvShowId($tvShowId): array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT id, tvShowId, name, seasonNumber, posterId
        FROM season
        WHERE tvShowId = :tvShowId
        ORDER BY seasonNumber
        SQL);
        $stmt -> execute(['tvShowId'=> $tvShowId]);
        return $stmt -> fetchAll(\PDO::FETCH_CLASS, Season::class);
    }
}