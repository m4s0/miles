<?php

namespace AppBundle\Controller;

use AppBundle\DTO\WineryDTO;
use AppBundle\Exception\ValidationException;
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
        $wineryDTO = WineryDTO::create($request->request->all());

        try {
            $data = $this->get('app.use_case.create_winery')->execute($wineryDTO);
        } catch (ValidationException $e) {
            return new JsonResponse($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
