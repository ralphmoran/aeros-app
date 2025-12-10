<?php

/*
|----------------------------------------------
| Set up your storage system here.
|
| This config file defines where your physical 
| files are going to be stored: 'local', 's3'
|----------------------------------------------
|
*/

return [
    /*
     * By default, this is the driver to be used
     */
    'default' => [
        'local'
    ],

    'spaces' => [
        /*
         * Local storage: it requires the path on the server 
         * where files are going to be stored
         */
        'local' => [
            'path' => app()->basedir . '/docs',
        ],

        /*
         * Amazon S3 storage: This is the connection to Amazon S3 
         * where your files are going to be stored
         */
        's3' => [
            'server'   => env("DB_HOST"),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'database' => env("DB_DATABASE"),
            'port'     => env("DB_PORT"),
            'driver'   => 'aws',
        ],
    ],

    /*
     * File upload configuration
     */
    'files' => [

        /*
         * Default upload directory (must be writable)
         */
        'upload_path' => app()->basedir . '/storage/uploads',

        /*
         * Public directory for web-accessible files (optional)
         */
        'public_path' => app()->basedir . '/public/uploads',

        /*
         * Maximum file size in bytes (default: 50MB)
         */
        'max_size' => 50 * 1024 * 1024, // 50MB
        'max_validation_size' => 10 * 1024 * 1024, // Max size for GD/security validation: 10MB

        /*
         * Whitelist: MIME types with their valid extensions
         * Empty = allow all types (except blocked_types)
         */
        'allowed_types' => [
            // Images
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/gif' => ['gif'],
            'image/webp' => ['webp'],
            'image/avif' => ['avif'],

            // Documents
            'application/pdf' => ['pdf'],
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['docx'],
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => ['xlsx'],
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => ['pptx'],

            // Archives
            'application/zip' => ['zip'],
            'application/x-7z-compressed' => ['7z'],

            // Text
            'text/plain' => ['txt'],
            'text/csv' => ['csv'],
        ],

        /*
         * Blacklist: Always blocked MIME types (security)
         */
        'blocked_types' => [
            'application/x-php',
            'application/x-httpd-php',
            'text/x-php',
            'text/x-shellscript',
            'application/x-executable',
            'application/x-mach-binary',
        ],

        /*
         * File naming strategy:
         * - 'hash': Cryptographically secure random hash (recommended)
         * - 'timestamp': Timestamp + random suffix
         * - 'original': Keep original filename (numbered if exists)
         */
        'naming_strategy' => 'hash',
    ],

    /*
     * You can set up different storage drivers here
     * for data replication or propagation.
     */
    'cluster' => [

    ],
];
