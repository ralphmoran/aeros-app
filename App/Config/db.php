<?php

/*
|----------------------------------------------
| Set up your DB connections here.
|
| This config file is to store persistent data.
|----------------------------------------------
|
*/

return [

    'default' => [
        'mysql'
    ],

    'connections' => [

        /*
         * MySQL connection.
         * 
         * Note: Make sure you have installed MySQL driver.
         */
        'mysql' => [
            'server'   => env("DB_HOST"),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'database' => env("DB_DATABASE"),
            'port'     => env("DB_PORT"),
            'driver'   => env("DB_DRIVER")
        ],

        /*
         * MSSQL connection.
         * 
         * Note: Make sure you have installed MSSQL driver.
         */
        'mssql-001' => [
            'server'   => 'host',
            'username' => 'username',
            'password' => 'password',
            'database' => 'database',
            'port'     => '1433',
            'driver'   => 'sqlsrv'
        ],

        /*
         * PostgreSQL connection.
         * 
         * Note: Make sure you have installed PostgreSQL driver.
         */
        'postgres-001' => [
            'server'   => 'host',
            'username' => 'username',
            'password' => 'password',
            'database' => 'database',
            'port'     => '5432',
            'driver'   => 'pgsql'
        ],

        /*
         * SQLite connection.
         */
        'sqlite-001' => [
            'server'   => app()->basedir . '/db',
            'username' => null,
            'password' => null,
            'database' => 'new-database.sql',
            'port'     => null,
            'driver'   => 'sqlite'
        ],

        /*
         * Neutral DB connection: Just to test or ping the database server.
         */
        'none' => [
            'server'   => env("DB_HOST"),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'database' => env("DB_DATABASE"),
            'port'     => env("DB_PORT"),
            'driver'   => env("DB_DRIVER")
        ],
    ],

    /*
     * Build your own cluster setup.
     * 
     * List all the required drivers you want to use for your cluster.
     */
    'clusters' => [
        'west-001' => [
            'server-n001' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-w002' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-w003' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
        ],

        'north-001' => [
            'server-n001' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-n002' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-n003' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-n004' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
        ],

        'east-001' => [
            'server-e001' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
            'server-e002' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
        ],

        'south-001' => [
            'server-s001' => [
                'server'   => 'server',
                'username' => 'username',
                'password' => 'password',
                'database' => 'database',
                'port'     => 'port'
            ],
        ],
    ],

    /*
     |----------------------------------------------
     | Model Configuration
     |----------------------------------------------
     |
     | Configure how Aeros Model behaves globally.
     | Individual models can override these settings.
     |
     */
    'model' => [

        /*
         * Throw exceptions on errors.
         *
         * When true, Model will throw exceptions on errors.
         * When false, Model will log errors and return null/false.
         *
         * Recommended: false in production, true in development
         */
        'throw_exceptions' => ! isEnv('production'),

        /*
         * Cache table schemas for performance.
         *
         * Caches column names and structure to avoid repeated database queries.
         * Uses both runtime (per-request) and persistent (file) caching.
         */
        'cache_schema' => true,

        /*
         * Schema cache TTL (Time To Live) in seconds.
         *
         * How long to cache table schema information.
         * Default: 3600 seconds (1 hour)
         */
        'cache_ttl' => 3600,

        /*
         * Validate column/table names against database schema.
         *
         * SECURITY: Prevents SQL injection via column names.
         * When enabled, all column names are validated against the actual
         * database schema before queries are executed.
         *
         * Recommended: Always true
         */
        'validate_identifiers' => true,

        /*
         * Automatically validate data before insert/update.
         *
         * When true, Model will automatically call validate() method
         * if a rules() method exists in the model.
         *
         * Models can define validation rules like:
         *
         * protected function rules(string $action = 'create'): array {
         *     return [
         *         'email' => 'required|email|unique:users',
         *         'password' => 'required|min:8'
         *     ];
         * }
         */
        'auto_validate' => false,

        /*
         * Log query errors.
         *
         * When true, all database errors are logged via logger() function.
         */
        'log_errors' => true,

        /*
         * Log all queries (debugging).
         *
         * WARNING: This can generate large log files in production.
         * Only enable in development/staging for debugging.
         */
        'log_queries' => isEnv(['local', 'development']),

        /*
         * Transform query results to Model instances.
         *
         * When true, get() and find() return Model instances.
         * When false, they return arrays.
         *
         * Note: find() by ID always returns a Model instance regardless.
         */
        'transform_results' => false,

        /*
         * Enable query builder features.
         *
         * Enables modern fluent query builder:
         * User::query()->where('status', 'active')->orderBy('created_at')->get()
         */
        'query_builder_enabled' => true,

        /*
         * Enable model observers/hooks.
         *
         * Fires before/after events for CRUD operations:
         * - beforeCreate, afterCreate
         * - beforeUpdate, afterUpdate
         * - beforeDelete, afterDelete
         * - beforeSave, afterSave
         */
        'observers_enabled' => true,

        /*
         * Enable eager loading for relationships.
         *
         * Prevents N+1 query problems:
         * User::with('posts')->get()
         */
        'eager_loading_enabled' => true,
    ],
];
