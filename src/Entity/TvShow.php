<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class TvShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    protected int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): TvShow
    {
        $stmt = MyPDO::getInstance()->prepare(<<<'SQL'
        SELECT id, name, originalName,overview,postedId
        FROM tvshow
        WHERE id = :id
        ORDER BY name
        SQL);
        $stmt->execute(['id' => $id]);

        $artist = $stmt->fetchObject(TvShow::class);
        if($artist === false) {
            throw new EntityNotFoundException("TvShow identifiant $id non trouvé");
        }
        return $artist;
    }
}