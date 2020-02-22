<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserApiController
 */
class UserApiController extends AbstractController
{
    /**
     * @Route("register")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        return $this->json(['that\'s fine'], 200);
    }
}
