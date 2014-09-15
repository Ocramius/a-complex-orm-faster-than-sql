<?php

use Example\User;

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/bootstrap.php';

$users = $entityManager->getRepository(User::class)->findAll();

var_dump('Users found:', $users);

require __DIR__ . '/show-cache-log.php';
