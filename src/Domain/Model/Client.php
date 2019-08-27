<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;

class Client
{
    /** @var Id */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param Id $id
     * @param string $name
     */
    public function __construct(
        Id $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
