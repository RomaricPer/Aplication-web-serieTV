<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

/**
 *
 */
class Season
{
    private int $id;
    protected int $tvShowId;
    private string $name;
    protected int $seasonNumber;
    protected int $posterId;

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
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * @param int $id
     * @return Season
     */
    public static function findById(int $id):Season
    {
        $stmt = MyPdo::getInstance()-> prepare(
            <<<'SQL'
        SELECT id, tvShowId, name, seasonNumber, posterId
        FROM season
        WHERE id = :id
        SQL);
        $stmt -> execute(['id' => $id]);

        $season = $stmt->fetchObject(Season::class);
        if ($season === false) {
            throw new EntityNotFoundException("Season $id non trouvable");
        }
        return $season;
    }
}