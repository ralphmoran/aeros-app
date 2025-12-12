<?php

/*
|----------------------------------------------
| Set up your security here.
|
| This config file is to determine how your app will behave
| against potential attacks.
|----------------------------------------------
|
*/

return [
    // Enable SSRF protection (recommended for production)
    'ssrf_protection' => env('SSRF_PROTECTION'),

    // Block private IPs (set false for Docker/internal networks)
    'block_private_ips' => env('BLOCK_PRIVATE_IPS'),

    // Always blocked hosts (metadata endpoints)
    'blocked_hosts' => [
        '169.254.169.254',
        'metadata.google.internal',
        '100.100.100.200',
    ],

    // Always blocked hosts (metadata endpoints)
    'whitelisted_hosts' => [
        // Add any authorized host here: IP or URL
    ],

    // Request Limits
    'max_url_length' => 2048,
    'max_header_count' => 50,
    'max_cookie_size' => 4096, // bytes
    'max_payload_size' => 10485760, // 10MB in bytes
    'max_input_stream_size' => 10485760, // 10MB in bytes

    // CSRF Protection
    'csrf_protection' => env('CSRF_PROTECTION'),
    'csrf_exempt_routes' => [
        '/api/*',
        '/webhooks/*',
    ],

    // Rate Limiting
    'rate_limit' => [
        'enabled' => env('RATE_LIMIT_ENABLED'),
        'max_attempts' => env('RATE_LIMIT_MAX_ATTEMPTS'), // requests
        'decay_minutes' => env('RATE_LIMIT_DECAY_MINUTES'), // time window
    ],

    // Per-route rate limits (override defaults)
    'rate_limit_routes' => [
        '/api/*' => ['max_attempts' => 100, 'decay_minutes' => 1],
        '/login' => ['max_attempts' => 5, 'decay_minutes' => 15],
        '/register' => ['max_attempts' => 3, 'decay_minutes' => 60],
    ],

    'dangerous_extensions' => [
        'php',
        'phtml',
        'php3',
        'php4',
        'php5',
        'phps',
        'phar',
        'sh',
        'bash',
        'exe',
        'com',
        'bat',
        'cmd',
        'js',
        'asp',
        'aspx',
        'jsp',
        'cgi',
        'pl'
    ]
];
