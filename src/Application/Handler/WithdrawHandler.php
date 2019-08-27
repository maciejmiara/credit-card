<?php

declare(strict_types = 1);

namespace Application\Handler;

use Application\Command\Withdraw;
use Domain\Repository\CreditCardRepository;

class WithdrawHandler
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

    public function handle(Withdraw $command)
    {
        $creditCard = $this->creditCardRepository->getById($command->getCardId());

        $creditCard->withdraw($command->getAmount());
        $this->creditCardRepository->save($creditCard);
    }
}
