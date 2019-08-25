<?php

declare(strict_types = 1);

namespace spec\Domain\Model;

use Common\Id;
use Domain\Exception\LimitAlreadyAssignedException;
use Domain\Exception\LimitExceededException;
use Domain\Exception\LimitNotAssignedException;
use Domain\Model\Client;
use PhpSpec\ObjectBehavior;

class CreditCardSpec extends ObjectBehavior
{
    function let(Id $id, Client $client)
    {
        $id->__toString()->willReturn('1234');

        $this->beConstructedWith($id, $client);
    }

    public function it_throws_exception_when_assigning_limit_already_assigned()
    {
        $this->assignLimit(10000);

        $this->shouldThrow(LimitAlreadyAssignedException::class)->during('assignLimit', [5000]);
    }

    public function it_returns_available_amount()
    {
        $this->assignLimit(10000);

        $this->getAvailableAmount()->shouldReturn(10000);
    }

    public function it_throws_exception_when_limit_was_not_assigned()
    {
        $this->shouldThrow(LimitNotAssignedException::class)->during('getAvailableAmount');
    }

    public function it_allows_to_withdraw_money()
    {
        $this->assignLimit(10000);

        $this->withdraw(3000);

        $this->getAvailableAmount()->shouldReturn(7000);
    }

    public function it_throws_exception_when_withdraw_amount_too_big()
    {
        $this->assignLimit(10000);

        $this->shouldThrow(LimitExceededException::class)->during('withdraw', [12000]);
    }

    public function it_allows_to_repay_limit()
    {
        $this->assignLimit(10000);
        $this->withdraw(3000);
        $this->repay(1000);

        $this->getAvailableAmount()->shouldReturn(8000);
    }
}
