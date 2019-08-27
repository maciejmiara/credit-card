<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Controller;

use Application\Command\AssignLimit;
use Common\Id;
use Domain\Exception\CreditCardNotFoundException;
use Domain\Exception\DomainException;
use Domain\Repository\CreditCardRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Infrastructure\Framework\Model\AssignDataModel;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CreditCardController extends AbstractFOSRestController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var CreditCardRepository */
    private $creditCardRepository;

    /**
     * @param CommandBus $commandBus
     * @param CreditCardRepository $creditCardRepository
     */
    public function __construct(
        CommandBus $commandBus,
        CreditCardRepository $creditCardRepository
    ) {
        $this->commandBus = $commandBus;
        $this->creditCardRepository = $creditCardRepository;
    }

    /**
     * @Rest\Get("/api/cards")
     */
    public function listAction()
    {
        $cards = $this->creditCardRepository->findAll();

        return $this->view($cards);
    }

    /**
     * @Rest\Patch("/api/cards/{cardId}/assign")
     * @ParamConverter("model", converter="fos_rest.request_body")
     */
    public function assignLimitAction($cardId, ConstraintViolationListInterface $validationErrors, AssignDataModel $model)
    {
        $command = new AssignLimit(Id::create($cardId), 500);

        if (count($validationErrors) > 0) {
            return $this->view($validationErrors, Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->commandBus->handle($command);
        } catch(CreditCardNotFoundException $e) {
            return $this->view(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (DomainException $e) {
            return $this->view(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $this->view(['cardId' => $cardId]);
    }
}
