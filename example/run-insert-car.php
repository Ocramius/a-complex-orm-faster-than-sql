<?php

use Doctrine\Common\Collections\ArrayCollection;
use Example\Car;
use Example\User;

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/bootstrap.php';

$car = new Car();

$car->users = new ArrayCollection(
    $entityManager->getRepository(User::class)->findAll()
);

$entityManager->persist($car);
$entityManager->flush();

var_dump('Inserted car:', $car);
