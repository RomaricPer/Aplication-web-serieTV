<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;

class EpisodeCollection
{
    /**
     * @return Episode[]
     */
    public static function findEpisodeBySeasonId($seasonId): array{
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT id, seasonId, name, overview, episodeNumber
        FROM episode
        WHERE seasonId = :seasonId
        ORDER BY episodeNumber
        SQL);
        $stmt -> execute(['seasonId'=> $seasonId]);
        return $stmt -> fetchAll(\PDO::FETCH_CLASS, Episode::class);
    }
}