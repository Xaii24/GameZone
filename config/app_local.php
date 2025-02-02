<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    'debug' => true,
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' =>
            '1e6cf883c88a70a108b3a7b18ee3ae17f324f99fcd240bf237dd84b1548a1a26', // Directly set your salt value here
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost', // Database host, assuming it's local
            'username' => 'root', // Database username
            'password' => 'Oakhill15!', // Password for 'root' (leave blank if none)
            'database' => 'cake_1000', // Name of your database
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => true,
            'url' => null, // No URL needed, assuming you're not using JawsDB
        ],

        // 'Datasources' => [
        //     'default' => [
        //         'className' => 'Cake\Database\Connection',
        //         'driver' => 'Cake\Database\Driver\Mysql',
        //         'persistent' => false,
        //         'host' => getenv('DB_HOST'),
        //         'username' => getenv('DB_USERNAME'),
        //         'password' => getenv('DB_PASSWORD'),
        //         'database' => getenv('DB_DATABASE'),
        //         'encoding' => 'utf8mb4',
        //         'timezone' => 'UTC',
        //         'cacheMetadata' => true,
        //         'quoteIdentifiers' => false,
        //         'log' => false, // Disable logging in production
        //     ],
        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            'url' => 'sqlite://127.0.0.1/tmp/tests.sqlite', // Keep default test DB URL if needed
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost', // Email server host
            'port' => 25, // Default port for SMTP
            'username' => null, // No username required if not using SMTP credentials
            'password' => null, // No password if not using SMTP credentials
            'client' => null,
            'url' => null, // If no URL for email transport is needed
        ],
    ],
];
