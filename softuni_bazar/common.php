<?php

use App\Http\ItemHttpHandler;

session_start();
spl_autoload_register();

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repository\Users\UserRepository($db, $dataBinder);
$categoryRepository = new \App\Repository\Categories\CategoryRepository($db, $dataBinder);
$itemsRepository = new \App\Repository\Items\ItemRepository($db, $dataBinder);
$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\Users\UserService($userRepository, $encryptionService);
$categoryService = new \App\Service\Categories\CategoryService($categoryRepository);
$itemService = new \App\Service\Items\ItemService($itemsRepository, $userService);
$userHttpHandler = new \App\Http\userHttpHandler($template, $dataBinder, $userService);
$itemHttpHandler = new ItemHttpHandler($template, $dataBinder, $itemService, $userService, $categoryService);