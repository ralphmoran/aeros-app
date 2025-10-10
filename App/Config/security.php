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
    'ssrf_protection' => env('SSRF_PROTECTION', true),

    // Block private IPs (set false for Docker/internal networks)
    'block_private_ips' => env('BLOCK_PRIVATE_IPS', false),

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
    'csrf_protection' => env('CSRF_PROTECTION', true),
    'csrf_exempt_routes' => [
        '/api/*',
        '/webhooks/*',
    ],
];
