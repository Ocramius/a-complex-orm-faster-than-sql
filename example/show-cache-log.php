<?php

/* @var $entityManager \Doctrine\ORM\EntityManager */
/* @var $logger \Doctrine\ORM\Cache\Logging\StatisticsCacheLogger */
$logger = $entityManager
    ->getConfiguration()
    ->getSecondLevelCacheConfiguration()
    ->getCacheLogger();


var_dump(
    'Cache statistics',
    [
        'hitCount'  => $logger->getHitCount(),
        'missCount' => $logger->getMissCount(),
        'putCount'  => $logger->getPutCount(),
    ]
);
