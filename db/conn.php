<?php
    //require_once 'localsettings.php';

    require 'vendor/autoload.php';

    //echo "***** FROM conn.php before defining DB_NAME *****<br/>";
    $dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    //in next line load $dbname with its value from GLOBAL ENV VARIABLE $_ENV['DB_NAME'] 
    //$dbname = $_ENV['DB_NAME'];
    //echo "HERE YOU GO WITH YOUR DB_NAME=$dbname" . "<br/>";

    //echo 'local dbname=' . getenv('DB_NAME') . '<br/>';

    $host = getenv('DB_HOST');
    $db = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASSWORD');
    $charset = getenv('DB_CHARSET');

    //echo "DB_HOST=$host\r\n";
    //echo "DB_NAME=$db\r\n";
    //echo "DB_USER=$user\r\n";
    //echo "DB_PASSWORD=$pass\r\n";


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