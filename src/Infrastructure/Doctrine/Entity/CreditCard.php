<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "credit_card")
 */
class CreditCard
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client", cascade={"persist"})
     */
    private $client;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", name="credit_limit", nullable=true)
     */
    private $limit;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $availableAmount;

    /**
     * @param string $id
     * @param Client $client
     * @param int|null $limit
     * @param int|null $availableAmount
     */
    public function __construct(
        string $id,
        Client $client,
        ?int $limit,
        ?int $availableAmount
    ) {
        $this->id = $id;
        $this->client = $client;
        $this->limit = $limit;
        $this->availableAmount = $availableAmount;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     */
    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return int|null
     */
    public function getAvailableAmount(): ?int
    {
        return $this->availableAmount;
    }

    /**
     * @param int|null $availableAmount
     */
    public function setAvailableAmount(?int $availableAmount): void
    {
        $this->availableAmount = $availableAmount;
    }
}
