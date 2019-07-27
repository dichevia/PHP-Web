<?php

namespace TopCarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TopCarBundle\Entity\Car;
use TopCarBundle\Entity\User;
use TopCarBundle\Form\CarType;
use TopCarBundle\Service\Cars\BodyServiceInterface;
use TopCarBundle\Service\Cars\BrandServiceInterface;
use TopCarBundle\Service\Cars\CarServiceInterface;
use TopCarBundle\Service\Cars\FuelServiceInterface;
use TopCarBundle\Service\ImageUploader\ImageUploadInterface;
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

    private $imageUploader;

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
                                FuelServiceInterface $fuelService,
                                ImageUploadInterface $imageUpload)
    {
        $this->carService = $carService;
        $this->userService = $userService;
        $this->brandService = $brandService;
        $this->bodyService = $bodyService;
        $this->fuelService = $fuelService;
        $this->imageUploader = $imageUpload;
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
     * @throws \Exception
     */
    public function createProcess(Request $request)
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
        /** @var UploadedFile $imageFile */

        $imageFile = $form['image']->getData();
        if ($imageFile) {
            $imageName = $this->imageUploader->upload($imageFile);
            $car->setImage($imageName);
        }

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
        /*** @var Car $car */
        $car = $this->carService->findOneById($id);

        if ($car === null) {
            return $this->redirectToRoute("homepage");
        }

        $car->setViewCount($car->getViewCount() + 1);
        $this->carService->save($car);

        return $this->render('car/car.html.twig', ['car' => $car]);
    }

    /**
     * @param Request $request
     *
     * @param $id
     * @return Response
     * @Route("/car/edit/{id}",name="car_edit", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     */
    public function edit(Request $request, $id)
    {
        $car = $this->carService->findOneById($id);
        $brands = $this->brandService->findAll();
        $bodies = $this->bodyService->findAll();
        $fuels = $this->fuelService->findAll();

        if (null == $car) {
            return $this->redirectToRoute('homepage');
        }

        /** @var User $currentUser */
        $currentUser = $this->userService->currentUser();
        if (!$currentUser->isAdmin() && !$currentUser->isOwner($car)) {
            return $this->redirectToRoute('homepage');
        }


        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        return $this->render('car/edit.html.twig',
            [
                'form' => $form->createView(),
                'car' => $car,
                'brands' => $brands,
                'bodies' => $bodies,
                'fuels' => $fuels
            ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Response
     * @Route("/car/edit/{id}", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     */
    public function editProcess(Request $request, $id)
    {
        /** @var Car $car */
        $car = $this->carService->findOneById($id);

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        /** @var UploadedFile $imageFile */

        $imageFile = $form->getExtraData()['new_image'];

        if ($imageFile) {
            $imageName = $this->imageUploader->upload($imageFile);
            $car->setImage($imageName);
        }
        $car->setOwner($car->getOwner());
        $car->setViewCount($car->getViewCount());
        $this->carService->edit($car);

        return $this->redirectToRoute('car_view', ['id' => $car->getId()]);
    }

    /**
     * @Route("/car/my-cars", name="my_cars")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function getAllArticlesByUser()
    {
        $car = $this->carService->findAllByOwnerId();

        return $this->render('car/my-cars.html.twig',
            ['cars' => $car]
        );
    }


    /**
     * @param Request $request
     * @param $id
     *
     * @return Response
     * @Route("/car/delete/{id}", name="car_delete", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     */

    public function deleteProcess(Request $request, $id)
    {
        /*** @var Car $car */
        $car = $this->carService->findOneById($id);

        if (null == $car) {
            return $this->redirectToRoute('homepage');
        }

        /** @var User $currentUser */
        $currentUser = $this->userService->currentUser();
        if (!$currentUser->isAdmin() && !$currentUser->isOwner($car)) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        $car->setOwner($car->getOwner());
        $car->setViewCount($car->getViewCount());
        $this->carService->remove($car);

        return $this->redirectToRoute('my_cars');
    }

}
