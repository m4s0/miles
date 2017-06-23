<?php

namespace AppBundle\Controller;

use AppBundle\DTO\WineDTO;
use AppBundle\Exception\ValidationException;
use AppBundle\ViewModel\Error;
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
        $wineDTO = WineDTO::create(json_decode($request->getContent(), true));

        try {
            $data = $this->get('app.use_case.create_wine')->execute($wineDTO);
        } catch (ValidationException $e) {
            $errorViewModel = Error::create($e->message(), $e->errors());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
