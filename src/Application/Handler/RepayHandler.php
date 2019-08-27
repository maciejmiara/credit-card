<?php

declare(strict_types = 1);

namespace Application\Handler;
use Application\Command\Repay;
use Domain\Repository\CreditCardRepository;

class RepayHandler
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

    public function handle(Repay $command)
    {
        $creditCard = $this->creditCardRepository->getById($command->getCardId());

        $creditCard->repay($command->getAmount());
        $this->creditCardRepository->save($creditCard);
    }
}
