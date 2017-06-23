<?php

namespace AppBundle\Controller;

use AppBundle\DTO\VineDTO;
use AppBundle\Exception\DomainException;
use AppBundle\Exception\ValidationException;
use AppBundle\ViewModel\Error;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VineController
 *
 * @package AppBundle\Controller
 */
class VineController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createVineAction(Request $request)
    {
        $vineDTO = VineDTO::create(json_decode($request->getContent(), true));

        try {
            $data = $this->get('app.use_case.create_vine')->execute($vineDTO);
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
    public function updateVineAction(Request $request, $id)
    {
        $vineDTO = VineDTO::create(json_decode($request->getContent(), true));

        try {
            $data = $this->get('app.use_case.update_vine')->execute($id, $vineDTO);
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
     * @param $id
     *
     * @return JsonResponse
     */
    public function getVineAction($id)
    {
        try {
            $data = $this->get('app.use_case.get_vine')->execute($id);
        } catch (DomainException $e) {
            $errorViewModel = Error::create($e->message());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
