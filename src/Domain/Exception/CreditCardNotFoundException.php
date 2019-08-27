<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Common\Id;

final class CreditCardNotFoundException extends DomainException
{
    public static function forId(Id $id): self
    {
        return new self(
            sprintf("Credit card with id %s not found", $id)
        );
    }
}
