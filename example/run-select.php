<?php

use Example\User;

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/bootstrap.php';

$user = $entityManager->find(User::class, 1);

var_dump('User found:', $user);
