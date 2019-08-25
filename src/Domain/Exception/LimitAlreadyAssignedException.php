<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Domain\Model\CreditCard;

class LimitAlreadyAssignedException extends DomainException
{
    public static function forCard(CreditCard $card): self
    {
        return new self(sprintf('Limit already assigned for card with id %s', $card->getId()));
    }
}
