<?php

use Example\User;

$entityManager = require __DIR__ . '/bootstrap.php';

$user = new User();

$user->username = 'Ocramius';

$entityManager->persist($user);
$entityManager->flush($user);

var_dump(sprintf('Inserted entity of type %s with ID %s', get_class($user), $user->id));
