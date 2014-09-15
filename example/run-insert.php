<?php

use Example\User;

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/bootstrap.php';

$user = new User();

$user->username = 'Ocramius';

$entityManager->persist($user);
$entityManager->flush();

var_dump('Inserted:', $user);
