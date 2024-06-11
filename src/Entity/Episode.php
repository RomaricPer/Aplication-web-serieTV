<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Episode
{
    private int $id;
    protected int $seasonId;
    private string $name;
    private string $overview;
    protected int $episodeNumber;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }

    public static function findById(int $id):Season
    {
        $stmt = MyPdo::getInstance()-> prepare(
            <<<'SQL'
        SELECT id, seasonId, name, overview, episodeNumber
        FROM episode
        WHERE id = :id
        SQL);
        $stmt -> execute(['id' => $id]);

        $episode = $stmt->fetchObject(Episode::class);
        if ($episode === false) {
            throw new EntityNotFoundException("Episode $id non trouvable");
        }
        return $episode;
    }
}