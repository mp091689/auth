<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Controller;

use mp091689\UserBundle\Service\UserServiceInterface;
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
     * @Route("/register")
     *
     * @param Request              $request
     *
     * @param UserServiceInterface $userService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \mp091689\UserBundle\Exception\UserInvalidException
     */
    public function register(Request $request, UserServiceInterface $userService): JsonResponse
    {
        $user = $userService->register('john', 'doe', 'john.doe', 30, 'secret');

        return $this->json((array)$user, 201);
    }

    /**
     * @Route("/login", methods={"POST"})
     *
     * @param Request              $request
     *
     * @param UserServiceInterface $userService
     *
     * @return JsonResponse
     */
    public function login(Request $request, UserServiceInterface $userService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if ($userService->login($data['nickname'], $data['password'])) {
            return $this->json('User ' . $data['nickname'] . ' is logged in', 200);
        }

        return $this->json('Access denied', 401);
    }
}
