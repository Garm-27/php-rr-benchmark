<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BenchmarkController extends AbstractController
{

    #[Route('/health', name: 'health_check', methods: ['GET'])]
    public function healthCheck(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'message' => 'We Gucci',
            'code' => '200', 
        ]);
    }

    #[Route('/', name: 'php_benchmark', methods: ['GET'])]
    public function benchmark(): JsonResponse
    {
        // Simulate some work
        $this->simulateWork();
        
        return new JsonResponse([
            'status' => 'success',
            'message' => 'Hello there !',
            'timestamp' => time()
        ]);
    }
    
    private function simulateWork(): void
    {
        // Simulate CPU work
        $start = microtime(true);
        $result = 0;
        for ($i = 0; $i < 1000000; $i++) {
            $result += sqrt($i);
        }
        
        // Simulate I/O work
        usleep(10000); // 10ms sleep
        
        // Simulate memory work
        $array = range(1, 1000);
        shuffle($array);
        sort($array);
    }
} 