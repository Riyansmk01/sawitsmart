<?php

namespace App\Filters;

use App\Models\ApiKeyModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiAuth implements FilterInterface
{
    private array $publicPaths = [
        'api/status/health',
        'api/subscribe',
        'api/contact',
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $path = $this->resolveApiPath($request);

        foreach ($this->publicPaths as $publicPath) {
            if ($path === $publicPath || str_starts_with($path, $publicPath . '/')) {
                return;
            }
        }

        if (session()->has('user_id')) {
            return;
        }

        $apiKey = $request->getHeaderLine('X-API-Key');
        if ($apiKey !== '') {
            $model = new ApiKeyModel();
            if ($model->validateKey($apiKey)) {
                return;
            }
        }

        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Unauthorized — login atau gunakan API key yang valid',
            ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    private function resolveApiPath(RequestInterface $request): string
    {
        $path = trim($request->getUri()->getPath(), '/');

        if (preg_match('#(api(?:/.*)?)$#', $path, $matches)) {
            return $matches[1];
        }

        return $path;
    }
}
