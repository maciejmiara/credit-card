<?php

declare(strict_types = 1);

namespace Application\Handler;

use Application\Command\AssignLimit;
use Domain\Repository\CreditCardRepository;

class AssignLimitHandler
{
    /** @var CreditCardRepository */
    private $creditCardRepository;

    /**
     * @param CreditCardRepository $creditCardRepository
     */
    public function __construct(CreditCardRepository $creditCardRepository)
    {
        $this->creditCardRepository = $creditCardRepository;
    }

    public function handle(AssignLimit $command)
    {
        $creditCard = $this->creditCardRepository->getById($command->getCardId());

        $creditCard->assignLimit($command->getLimit());
        $this->creditCardRepository->save($creditCard);
    }
}
