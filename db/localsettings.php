<?php

    // =========================================================================
    // Insert the real values for the dev/test/deployment environment
    // If deployment == HEROKU ignore the putenv stmts as
    // the env var are set in Settings -> Config Vars 
    // =========================================================================

    // localsettings.php file is no longer required because it is  replaced by the .env file
    // mechanism,  based on the vlucas/phpdotenv library
    // The local env variables are stored in '.env' file, which must NOT be exported 
    // to gitHub, as it contains secret data such as DB_HOST, DB_NAME, DB_USER, DB_PASSWORD
    //
    // Within conn.php file the following statement:
    // require 'vendor/autoload.php';
    // replaces the old stmnt: require_once 'localsettings.php';
?>