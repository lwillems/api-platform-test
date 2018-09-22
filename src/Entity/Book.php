<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * A book.
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={
 *              Book::READ,
 *              Review::READ
 *              }
 *          },
 *     denormalizationContext={"groups"={Book::WRITE}}
 * )
 * @ORM\Entity
 */
class Book
{
    const READ = 'Book:Read';
    const WRITE = 'Book:Write';

    /**
     * @var int The id of this book.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({Book::READ})
     */
    private $id;

    /**
     * @var string|null The ISBN of this book (or null if doesn't have one).
     *
     * @ORM\Column(nullable=true)
     * @Groups({Book::READ, Book::WRITE})
     */
    public $isbn;

    /**
     * @var string The title of this book.
     *
     * @ORM\Column
     * @Groups({Book::READ, Book::WRITE})
     */
    public $title;

    /**
     * @var string The description of this book.
     *
     * @ORM\Column(type="text")
     * @Groups({Book::READ, Book::WRITE})
     */
    public $description;

    /**
     * @var string The author of this book.
     *
     * @ORM\Column
     * @Groups({Book::READ, Book::WRITE})
     */
    public $author;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     * @Groups({Book::READ, Book::WRITE})
     */
    public $publicationDate;

    /**
     * @var Review[] Available reviews for this book.
     *
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book")
     * @Groups({Book::READ, Book::WRITE})
     */
    public $reviews;

    public function __construct() {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}

