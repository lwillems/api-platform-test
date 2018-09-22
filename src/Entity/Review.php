<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * A review of a book.
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={
 *              Review::READ,
 *              Book::READ
 *              }
 *          },
 *     denormalizationContext={"groups"={Review::WRITE}}
 * )
 * @ORM\Entity
 */
class Review
{
    const READ = 'Review:Read';
    const WRITE = 'Review:Write';

    /**
     * @var int The id of this review.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({Review::READ})
     */
    private $id;

    /**
     * @var int The rating of this review (between 0 and 5).
     *
     * @ORM\Column(type="smallint")
     * @Groups({Review::READ, Review::WRITE})
     */
    public $rating;

    /**
     * @var string the body of the review.
     *
     * @ORM\Column(type="text")
     * @Groups({Review::READ, Review::WRITE})
     */
    public $body;

    /**
     * @var string The author of the review.
     *
     * @ORM\Column
     * @Groups({Review::READ, Review::WRITE})
     */
    public $author;

    /**
     * @var \DateTimeInterface The date of publication of this review.
     *
     * @ORM\Column(type="datetime_immutable")
     * @Groups({Review::READ, Review::WRITE})
     */
    public $publicationDate;

    /**
     * @var Book The book this review is about.
     *
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @Groups({Review::READ, Review::WRITE})
     * @ApiProperty(
     *     attributes={
     *         "swagger_context"={
     *             "type"="string",
     *             "example"="/api/books/1"
     *         }
     *     }
     * )
     */
    public $book;

    public function getId(): ?int
    {
        return $this->id;
    }
}

