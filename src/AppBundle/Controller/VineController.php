<?php

namespace AppBundle\Controller;

use AppBundle\DTO\VineDTO;
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
        $vineDTO = VineDTO::create($request->request->all());

        try {
            $data = $this->get('app.use_case.create_vine')->execute($vineDTO);
        } catch (ValidationException $e) {
            $errorViewModel = Error::create($e->message(), $e->errors());

            return new JsonResponse($errorViewModel->serialize(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
