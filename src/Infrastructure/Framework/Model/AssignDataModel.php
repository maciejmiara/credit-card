<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Model;

use Symfony\Component\Validator\Constraints as Assert;

class AssignDataModel
{
    /**
     * @Assert\GreaterThan(0)
     * @Assert\NotNull
     */
    public $limit;
}
