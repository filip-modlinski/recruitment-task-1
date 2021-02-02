<?php

namespace App\Movies\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var bool
     *
     * @ORM\Column(name="category_id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Film", mappedBy="category")
     */
    private $film;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->film = new ArrayCollection();
    }

    /**
     * @return bool|null
     */
    public function getCategoryId(): ?bool
    {
        return $this->categoryId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLastUpdate(): ?DateTimeInterface
    {
        return $this->lastUpdate;
    }

    /**
     * @param DateTimeInterface $lastUpdate
     * @return $this
     */
    public function setLastUpdate(DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    /**
     * @param Film $film
     * @return $this
     */
    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
            $film->addCategory($this);
        }

        return $this;
    }

    /**
     * @param Film $film
     * @return $this
     */
    public function removeFilm(Film $film): self
    {
        if ($this->film->removeElement($film)) {
            $film->removeCategory($this);
        }

        return $this;
    }
}
