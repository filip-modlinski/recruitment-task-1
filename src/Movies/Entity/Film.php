<?php

namespace App\Movies\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table(name="film", indexes={@ORM\Index(name="idx_fk_language_id", columns={"language_id"}), @ORM\Index(name="idx_title", columns={"title"}), @ORM\Index(name="idx_fk_original_language_id", columns={"original_language_id"})})
 * @ORM\Entity(repositoryClass="App\Movies\Repository\FilmRepository")
 */
class Film
{
    /**
     * @var int
     *
     * @ORM\Column(name="film_id", type="smallint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $filmId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="release_year", type="string", nullable=true)
     */
    private $releaseYear;

    /**
     * @var bool
     *
     * @ORM\Column(name="rental_duration", type="boolean", nullable=false, options={"default"="3"})
     */
    private $rentalDuration = '3';

    /**
     * @var string
     *
     * @ORM\Column(name="rental_rate", type="decimal", precision=4, scale=2, nullable=false, options={"default"="4.99"})
     */
    private $rentalRate = '4.99';

    /**
     * @var int|null
     *
     * @ORM\Column(name="length", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="replacement_cost", type="decimal", precision=5, scale=2, nullable=false, options={"default"="19.99"})
     */
    private $replacementCost = '19.99';

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $rating;

    /**
     * @var array|null
     *
     * @ORM\Column(name="special_features", type="simple_array", length=0, nullable=true)
     */
    private $specialFeatures;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="original_language_id", referencedColumnName="language_id")
     * })
     */
    private $originalLanguage;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Actor", mappedBy="film")
     */
    private $actor;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="film")
     * @ORM\JoinTable(name="film_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     *   }
     * )
     */
    private $category;

    /**
     * Film constructor.
     */
    public function __construct()
    {
        $this->actor = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getFilmId(): ?int
    {
        return $this->filmId;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReleaseYear(): ?string
    {
        return $this->releaseYear;
    }

    /**
     * @param string|null $releaseYear
     * @return $this
     */
    public function setReleaseYear(?string $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRentalDuration(): ?bool
    {
        return $this->rentalDuration;
    }

    /**
     * @param bool $rentalDuration
     * @return $this
     */
    public function setRentalDuration(bool $rentalDuration): self
    {
        $this->rentalDuration = $rentalDuration;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRentalRate(): ?string
    {
        return $this->rentalRate;
    }

    /**
     * @param string $rentalRate
     * @return $this
     */
    public function setRentalRate(string $rentalRate): self
    {
        $this->rentalRate = $rentalRate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     * @return $this
     */
    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReplacementCost(): ?string
    {
        return $this->replacementCost;
    }

    /**
     * @param string $replacementCost
     * @return $this
     */
    public function setReplacementCost(string $replacementCost): self
    {
        $this->replacementCost = $replacementCost;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRating(): ?string
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     * @return $this
     */
    public function setRating(string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSpecialFeatures(): ?array
    {
        return $this->specialFeatures;
    }

    /**
     * @param array|null $specialFeatures
     * @return $this
     */
    public function setSpecialFeatures(?array $specialFeatures): self
    {
        $this->specialFeatures = $specialFeatures;

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
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Language|null $language
     * @return $this
     */
    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Language|null
     */
    public function getOriginalLanguage(): ?Language
    {
        return $this->originalLanguage;
    }

    /**
     * @param Language|null $originalLanguage
     * @return $this
     */
    public function setOriginalLanguage(?Language $originalLanguage): self
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    /**
     * @param Actor $actor
     * @return $this
     */
    public function addActor(Actor $actor): self
    {
        if (!$this->actor->contains($actor)) {
            $this->actor[] = $actor;
            $actor->addFilm($this);
        }

        return $this;
    }

    /**
     * @param Actor $actor
     * @return $this
     */
    public function removeActor(Actor $actor): self
    {
        if ($this->actor->removeElement($actor)) {
            $actor->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
}
