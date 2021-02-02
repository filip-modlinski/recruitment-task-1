<?php

namespace App\Movies\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="actor", indexes={@ORM\Index(name="idx_actor_last_name", columns={"last_name"})})
 * @ORM\Entity(repositoryClass="App\Movies\Repository\ActorRepository")
 */
class Actor
{
    /**
     * @var int
     *
     * @ORM\Column(name="actor_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $actorId;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=false)
     */
    private $lastName;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Film", inversedBy="actor")
     * @ORM\JoinTable(name="film_actor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="actor_id", referencedColumnName="actor_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     *   }
     * )
     */
    private $film;

    /**
     * Actor constructor.
     */
    public function __construct()
    {
        $this->film = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getActorId(): ?int
    {
        return $this->actorId;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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
        }

        return $this;
    }

    /**
     * @param Film $film
     * @return $this
     */
    public function removeFilm(Film $film): self
    {
        $this->film->removeElement($film);

        return $this;
    }
}
