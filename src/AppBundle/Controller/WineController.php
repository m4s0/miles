<?php

namespace AppBundle\Controller;

use AppBundle\DTO\WineDTO;
use AppBundle\Exception\DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WineController
 *
 * @package AppBundle\Controller
 */
class WineController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createWineAction(Request $request)
    {
        $wineDTO = WineDTO::create($request->request->all());

        try {
            $data = $this->get('app.use_case.create_wine')->execute($wineDTO);
        } catch (DomainException $e) {
            return new JsonResponse($e->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
