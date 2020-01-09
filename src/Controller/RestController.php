<?php

namespace App\Controller;

use App\Domain\Airplane\Collections\AirplaneModelCollection;
use App\Domain\FlyServiceInterface;
use App\Domain\Model\Airplane;
use App\Domain\Model\Hangar;
use App\Domain\Repository\AirplaneRepositoryInterface;
use App\Domain\Repository\HangarRepositoryInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractFOSRestController
{
    /**
     * @var AirplaneModelCollection
     */
    private $airplaneModelCollection;

    /**
     * @var HangarRepositoryInterface
     */
    private $hangarRepository;

    /**
     * @var AirplaneRepositoryInterface
     */
    private $airplaneRepository;

    /**
     * @var FlyServiceInterface
     */
    private $flyService;

    public function __construct(
        AirplaneModelCollection $airplaneModelCollection,
        HangarRepositoryInterface $hangarRepository,
        AirplaneRepositoryInterface $airplaneRepository,
        FlyServiceInterface $flyService
    ) {
        $this->airplaneModelCollection = $airplaneModelCollection;
        $this->hangarRepository = $hangarRepository;
        $this->airplaneRepository = $airplaneRepository;
        $this->flyService = $flyService;
    }

    /**
     * @Route("/api/airplanes_models", methods={"GET"})
     * @View()
     * @SWG\Response(
     *     response=200,
     *     description="Get airplane models",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     * )
     */
    public function airplaneModels()
    {
        return $this->airplaneModelCollection->getModelNames();
    }

    /**
     * @Route("/api/airplane", methods={"GET"})
     * @View(serializerGroups={"airplane_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Get airplanes",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Airplane::class, groups={"airplane_view"}))
     *     )
     * )
     */
    public function airplanes()
    {
        return $this->airplaneRepository->findAll();
    }

    /**
     * @Route("/api/airplane/{id}", methods={"GET"})
     * @View(serializerGroups={"airplane_detail", "hangar_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Get airplane",
     *     @SWG\Schema(
     *         @SWG\Items(ref=@Model(type=Airplane::class, groups={"airplane_detail", "hangar_view"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Airplane id"
     * )
     */
    public function airplane($id)
    {
        // todo: here and bellow need to check that model is exist by id and throw 404 instead
        // todo: here and bellow need to catch all domain errors and convert to normal response

        return $this->airplaneRepository->find($id);
    }

    /**
     * @Route("/api/airplane/{id}/takeoff", methods={"POST"})
     * @View(serializerGroups={"airplane_detail", "hangar_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Takeoff airplane",
     *     @SWG\Schema(
     *         @SWG\Items(ref=@Model(type=Airplane::class, groups={"airplane_detail", "hangar_view"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Airplane id"
     * )
     */
    public function airplaneTakeoff($id)
    {
        $airplane = $this->airplaneRepository->find($id);
        $this->flyService->takeoff($airplane);

        return $airplane;
    }

    /**
     * @Route("/api/airplane/{id}/land", methods={"POST"})
     * @View(serializerGroups={"airplane_detail", "hangar_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Land airplane",
     *     @SWG\Schema(
     *         @SWG\Items(ref=@Model(type=Airplane::class, groups={"airplane_detail", "hangar_view"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Airplane id"
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @SWG\Schema(
     *       type="object",
     *       properties={
     *         @SWG\Property(property="hangar_id", type="integer"),
     *       }
     *     )
     * )
     */
    public function airplaneLand($id, Request $request)
    {
        $airplane = $this->airplaneRepository->find($id);
        $hangar = $this->hangarRepository->find($request->get('hangar_id'));

        $this->flyService->land($airplane, $hangar);

        return $airplane;
    }

    /**
     * @Route("/api/hangar", methods={"GET"})
     * @View(serializerGroups={"hangar_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Get hangars",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Hangar::class, groups={"hangar_view"}))
     *     )
     * )
     */
    public function hangars()
    {
        return $this->hangarRepository->findAll();
    }

    /**
     * @Route("/api/hangar/{id}", methods={"GET"})
     * @View(serializerGroups={"hangar_detail"})
     * @SWG\Response(
     *     response=200,
     *     description="Get hangar",
     *     @SWG\Schema(
     *         ref=@Model(type=Hangar::class, groups={"hangar_detail"})
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Hangar id"
     * )
     */
    public function hangar($id)
    {
        return $this->hangarRepository->find($id);
    }

    /**
     * @Route("/api/hangar/{id}/airplanes", methods={"GET"})
     * @View(serializerGroups={"airplane_view"})
     * @SWG\Response(
     *     response=200,
     *     description="Get hangar airplanes",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Airplane::class, groups={"airplane_view"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Hangar id"
     * )
     */
    public function hangarAirplanes($id)
    {
        $hangar = $this->hangarRepository->find($id);

        return $hangar->getAirplanes();
    }
}
