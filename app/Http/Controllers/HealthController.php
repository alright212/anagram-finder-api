<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthController extends Controller
{
    /**
     * Application health check endpoint for App Runner
     * 
     * This endpoint performs comprehensive health checks:
     * - Database connectivity
     * - Basic Laravel functionality
     * - File system permissions
     * 
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        $health = [
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'checks' => []
        ];

        try {
            // Check database connectivity
            DB::connection()->getPdo();
            $health['checks']['database'] = 'ok';
        } catch (\Exception $e) {
            $health['status'] = 'unhealthy';
            $health['checks']['database'] = 'failed';
            $health['errors']['database'] = $e->getMessage();
            Log::error('Health check failed - database connection', ['error' => $e->getMessage()]);
        }

        try {
            // Check if we can write to storage
            $testFile = storage_path('app/health-check-test.txt');
            file_put_contents($testFile, 'test');
            if (file_get_contents($testFile) === 'test') {
                $health['checks']['storage'] = 'ok';
                unlink($testFile);
            } else {
                throw new \Exception('Unable to read test file');
            }
        } catch (\Exception $e) {
            $health['status'] = 'unhealthy';
            $health['checks']['storage'] = 'failed';
            $health['errors']['storage'] = $e->getMessage();
            Log::error('Health check failed - storage access', ['error' => $e->getMessage()]);
        }

        try {
            // Check if Laravel can load configuration
            $appName = config('app.name');
            if ($appName) {
                $health['checks']['config'] = 'ok';
            } else {
                throw new \Exception('Unable to load app configuration');
            }
        } catch (\Exception $e) {
            $health['status'] = 'unhealthy';
            $health['checks']['config'] = 'failed';
            $health['errors']['config'] = $e->getMessage();
            Log::error('Health check failed - configuration', ['error' => $e->getMessage()]);
        }

        // Return appropriate HTTP status
        $httpStatus = $health['status'] === 'healthy' ? 200 : 503;
        
        return response()->json($health, $httpStatus);
    }

    /**
     * Simple readiness check for App Runner
     * Just returns 200 OK if Laravel is responding
     * 
     * @return JsonResponse
     */
    public function ready(): JsonResponse
    {
        return response()->json([
            'status' => 'ready',
            'timestamp' => now()->toISOString()
        ]);
    }
}
