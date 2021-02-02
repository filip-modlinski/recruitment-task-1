<?php

namespace App\Controller;

use App\Movies\Entity\Actor;
use App\Movies\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MoviesController
 * @package App\Controller
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("/movies1", methods="GET", name="movies1")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies1Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Film::class)
            ->getPolishComedies();

        return new JsonResponse($actors);
    }

    /**
     * @Route("/movies2", methods="GET", name="movies2")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies2Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->getActorsPlayedIn2019();

        return new JsonResponse($actors);
    }

    /**
     * @Route("/movies3", methods="GET", name="movies3")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies3Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->getActorsNotPlayedIn2019();

        return new JsonResponse($actors);
    }

    /**
     * @Route("/movies4", methods="GET", name="movies4")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies4Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->getActorsPlayedInAtLeast5ComediesOrDramas();

        return new JsonResponse($actors);
    }

    /**
     * @Route("/movies5", methods="GET", name="movies5")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies5Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Film::class)
            ->getPolishFilmsFrom2019GroupedByCategory();

        return new JsonResponse($actors);
    }

    /**
     * @Route("/movies6", methods="GET", name="movies6")
     * @param Request $request
     * @return JsonResponse
     */
    public function movies6Action(Request $request): JsonResponse
    {
        $actors = $this->getDoctrine()
            ->getRepository(Film::class)
            ->getBestFilmsGroupedByYear();

        return new JsonResponse($actors);
    }
}
