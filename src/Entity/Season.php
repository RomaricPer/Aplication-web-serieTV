<?php
declare(strict_types=1);

namespace Entity;

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

}