<?php

namespace TopCarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\Car;
use TopCarBundle\Form\CarType;
use TopCarBundle\Service\Cars\BodyServiceInterface;
use TopCarBundle\Service\Cars\BrandServiceInterface;
use TopCarBundle\Service\Cars\CarServiceInterface;
use TopCarBundle\Service\Cars\FuelServiceInterface;
use TopCarBundle\Service\Users\UserServiceInterface;

class CarController extends Controller
{
    /**
     * @var CarServiceInterface
     */
    private $carService;
    /**
     * @var UserServiceInterface
     */
    private $userService;
    /**
     * @var BrandServiceInterface
     */
    private $brandService;
    /**
     * @var BodyServiceInterface
     */
    private $bodyService;
    /**
     * @var FuelServiceInterface
     */
    private $fuelService;

    /**
     * CarController constructor.
     * @param CarServiceInterface $carService
     * @param UserServiceInterface $userService
     * @param BrandServiceInterface $brandService
     * @param BodyServiceInterface $bodyService
     * @param FuelServiceInterface $fuelService
     */
    public function __construct(CarServiceInterface $carService,
                                UserServiceInterface $userService,
                                BrandServiceInterface $brandService,
                                BodyServiceInterface $bodyService,
                                FuelServiceInterface $fuelService)
    {
        $this->carService = $carService;
        $this->userService = $userService;
        $this->brandService = $brandService;
        $this->bodyService = $bodyService;
        $this->fuelService = $fuelService;
    }

    /**
     * @param Request $request
     *
     * @Route("/car/create", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $car = new Car();
        $brands = $this->brandService->findAll();
        $bodies = $this->bodyService->findAll();
        $fuels = $this->fuelService->findAll();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        return $this->render('car/create.html.twig',
            [
                'form' => $form->createView(),
                'brands' => $brands,
                'bodies' => $bodies,
                'fuels' => $fuels
            ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/car/create", name="car_create", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return RedirectResponse|Response
     */
    public function createProcess(Request $request)
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        $car->setOwner($this->getUser());
        $car->setViewCount(0);
        $this->carService->save($car);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param $id
     *
     * @Route("/car/view/{id}", name="car_view")
     * @return Response
     */
    public function view($id)
    {

        $car =$this->carService->findOneById($id);

        if ($car === null) {
            return $this->redirectToRoute("homepage");
        }
        $car->setViewCount($car->getViewCount()+1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return $this->render('car/car.html.twig', ['car' => $car]);
    }

}
