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

    /**
     * @param int $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $originalName
     */
    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * @param string $overview
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @param int $posterId
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

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
        SELECT id, name, originalName,overview,posterId
        FROM tvshow
        WHERE id = :id
        ORDER BY name
        SQL);
        $stmt->execute(['id' => $id]);

        $tvshow = $stmt->fetchObject(TvShow::class);
        if($tvshow === false) {
            throw new EntityNotFoundException("TvShow identifiant $id non trouvé");
        }
        return $tvshow;
    }
    public function delete(): TvShow
    {
        $stmt = MyPDO::getInstance()->prepare(<<<'SQL'
        DELETE FROM tvshow
        WHERE id = :id
        SQL);
        $stmt->execute(['id' => $this->getId()]);
        $this->setId(null);
        return $this;
    }
    public function update(): TvShow
    {
        $stmt = MyPDO::getInstance()->prepare(<<<'SQL'
        UPDATE tvshow
        SET name = :name,
            originalName = :originalName,
            homepage = :homepage,
            overview = :overview
        WHERE id = :id
        SQL);
        $stmt->execute(['id' => $this->getId(),
            'name' => $this->getName(),
            'originalName'=>$this->getOriginalName(),
            'homepage'=>$this->getHomepage(),
            'overview' => $this->getOverview()
            ]);
        return $this;
    }
    public static function create(?int $id = null, string $name,string $originalName, string $homepage, string $overview, ?int $posterId = null): TvShow
    {
        $tvshow = new TvShow();
        $tvshow->setId($id);
        $tvshow->setName($name);
        $tvshow->setOriginalName($originalName);
        $tvshow->setOverview($overview);
        return $tvshow;
    }
    protected function insert(): TvShow
    {
        $stmt = MyPDO::getInstance()->prepare(<<<'SQL'
        INSERT INTO tvShow
        VALUES (:id, :name, :originalName, :homepage, :overview, :posterId)
        SQL);
        $stmt->execute(['id' => $this->getId(),
            'name' => $this->getName(),
            'originalName'=>$this->getOriginalName(),
            'homepage'=>$this->getHomepage(),
            'overview' => $this->getOverview()
        ]);
        $this->setId((int)MyPdo::getInstance()->lastInsertId());
        return $this;
    }
    public function save(): TvShow
    {
        if(!$this->getId()) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }
}