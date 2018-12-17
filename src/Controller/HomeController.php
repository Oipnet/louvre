<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 06/12/18
 * Time: 12:37
 */

namespace App\Controller;


use App\Repository\PriceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var PriceRepository
     */
    private $priceRepository;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(Environment $twig, PriceRepository $priceRepository, TranslatorInterface $translator)
    {
        $this->twig = $twig;
        $this->priceRepository = $priceRepository;
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function __invoke()
    {
        $prices = $this->priceRepository->findAll();
        //dd($this->translator);
        return new Response($this->twig->render('homepage.html.twig', compact('prices')), 200);
    }
}