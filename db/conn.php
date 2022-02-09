<?php
    //require_once 'localsettings.php';

    require 'vendor/autoload.php';

    //echo "***** FROM conn.php before loading dotenv ***** <br/>";
    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //**** Use Dotenv in development environment ONLY ****
    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $app_env = getenv('APP_ENV');
    if($app_env != 'production') {
        $dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
    
    //in next line load $dbname with its value from GLOBAL ENV VARIABLE $_ENV['DB_NAME'] 
    //$dbname = $_ENV['DB_NAME'];

    //echo "FROM conn.php just after loading dotenv:  " . "<br/>";

    //echo 'local dbname=' . getenv('DB_NAME') . '<br/>';

    $host = getenv('DB_HOST');
    $db = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASSWORD');
    $charset = getenv('DB_CHARSET');

    //$host =  $_ENV['DB_HOST'];
    //$db = $_ENV['DB_NAME'];
    //$user = $_ENV['DB_USER'];
    //$pass = $_ENV['DB_PASSWORD'];
    //$charset = $_ENV['DB_CHARSET'];

    // *******  START DEBUGGING   **********
    //echo "APP_ENV=$app_env <br/>";
    //echo "DB_HOST=$host <br/>";
    //echo "DB_NAME=$db <br/>";
    //echo "DB_USER=$user <br/>";
    //echo "DB_PASSWORD=$pass <br/>";
    //echo "DB_CHARSET=$charset <br/>";  
    // *******  END DEBUGGING   **********


    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn,$user,$pass,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
        //echo "<h1 class='text-danger'>No database found</h1>";        
    }

    require_once 'crud.php';
    require_once 'user.php';
    $crud = new crud($pdo);
    $user = new user($pdo);


?>