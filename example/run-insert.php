<?php

$entityManager = require __DIR__ . '/bootstrap.php';

$user = new \Example\User();

$user->username = 'Ocramius';

$entityManager->persist($user);
$entityManager->flush($user);

var_dump(sprintf('Inserted entity of type %s with ID %s', get_class($user), $user->id));
