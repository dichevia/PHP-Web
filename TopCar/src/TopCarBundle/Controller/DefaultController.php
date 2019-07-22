<?php

namespace TopCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Service\Cars\CarServiceInterface;

class DefaultController extends Controller
{
    /**
     * @var CarServiceInterface
     */
    private $carService;

    /**
     * DefaultController constructor.
     * @param CarServiceInterface $carService
     */
    public function __construct(CarServiceInterface $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        $mostViewedCars = $this->carService->findFirstMostViewed();
        return $this->render('default/index.html.twig',
            [
                'cars' => $mostViewedCars
        ]);
    }
}
