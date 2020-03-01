<?php
declare(strict_types=1);

namespace App\Controller;

use mp091689\AnalyticsBundle\Service\AnalyticsServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MykytaController extends AbstractController
{
    /**
     * @Route("/hello")
     * @param AnalyticsServiceInterface $analyticsService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function hello(AnalyticsServiceInterface $analyticsService)
    {
        $analyticsService->log(1, 'testLabel', new \DateTime(), '127.0.0.1');

        return $this->json('hello');
    }
}