<?php

namespace Config;

use App\Filters\ApiAuth;
use App\Filters\AuthFilter;
use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth'          => AuthFilter::class,
        'apiauth'       => ApiAuth::class,
    ];

    public array $required = [
        'before' => [
            'forcehttps',
        ],
        'after' => [
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            'invalidchars',
            'csrf' => ['except' => [
                'api/farms',
                'api/farms/*',
                'api/zones',
                'api/zones/*',
                'api/tbs',
                'api/tbs/*',
                'api/production',
                'api/production/*',
                'api/harvesting',
                'api/harvesting/*',
                'api/farm-settings',
                'api/farm-settings/*',
                'api/dashboard/*',
                'api/import/*',
                'api/export/*',
                'api/alerts/*',
                'api/status/system',
                'api/status/summary',
                'api/docs/*',
            ]],
        ],
        'after' => [
            'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'auth' => [
            'before' => [
                'dashboard',
                'dashboard/*',
                'palm-dashboard',
                'palm-dashboard/*',
            ],
        ],
        'apiauth' => [
            'before' => ['api/*'],
        ],
    ];
}
