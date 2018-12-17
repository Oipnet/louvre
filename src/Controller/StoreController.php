<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 07/12/18
 * Time: 07:36
 */

namespace App\Controller;


use App\Entity\Command;
use App\Form\CommandType;
use App\Repository\CommandRepository;
use App\Repository\StateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class StoreController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var CommandRepository
     */
    private $commandRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var StateRepository
     */
    private $stateRepository;

    public function __construct(
        Environment $twig, FormFactoryInterface $formFactory, CommandRepository $commandRepository, EntityManagerInterface $entityManager,
        RouterInterface $router, StateRepository $stateRepository
    )
    {

        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->commandRepository = $commandRepository;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->stateRepository = $stateRepository;
    }

    /**
     * @Route("/store", name="store")
     */
    public function __invoke(Request $request)
    {
        $command = new Command();

        $form = $this->formFactory->createBuilder(CommandType::class, $command)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $defaultState = $this->stateRepository->findDefault();

            $command->setState($defaultState);
            $this->entityManager->persist($command);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return new Response($this->twig->render('store.html.twig', ['form' => $form->createView()]));
    }
}