<?php

use Example\Car;

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/bootstrap.php';

$car = $entityManager->find(Car::class, 1);

var_dump('Car found:', $car);

if (! $car) {
    return;
}

var_dump('Users in Car:', $car->users->toArray());

require __DIR__ . '/show-cache-log.php';
