<?php

namespace AppBundle\Controller;

use AppBundle\DTO\WineryDTO;
use AppBundle\Exception\DomainException;
use AppBundle\Exception\ValidationException;
use AppBundle\ViewModel\Error;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WineryController
 *
 * @package AppBundle\Controller
 */
class WineryController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createWineryAction(Request $request)
    {
        $wineryDTO = WineryDTO::create(json_decode($request->getContent(), true));

        try {
            $data = $this->get('app.use_case.create_winery')->execute($wineryDTO);
        } catch (ValidationException $e) {
            $errorViewModel = Error::create($e->message(), $e->errors());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return JsonResponse
     */
    public function updateWineryAction(Request $request, $id)
    {
        $wineryDTO = WineryDTO::create(json_decode($request->getContent(), true));

        try {
            $data = $this->get('app.use_case.update_winery')->execute($id, $wineryDTO);
        } catch (DomainException $e) {
            $errorViewModel = Error::create($e->message());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            $errorViewModel = Error::create($e->message(), $e->errors());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return JsonResponse
     */
    public function getWineryAction(Request $request, $id)
    {
        try {
            $data = $this->get('app.use_case.get_winery')->execute($id);
        } catch (DomainException $e) {
            $errorViewModel = Error::create($e->message());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
