<?php

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Driver\PDOSqlite\Driver;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\Cache\DefaultCacheFactory;
use Doctrine\ORM\Cache\Logging\StatisticsCacheLogger;
use Doctrine\ORM\Cache\RegionsConfiguration;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\SchemaTool;

require_once __DIR__ . '/vendor/autoload.php';

$userCache     = new FilesystemCache(__DIR__ . '/data/cache');
$configuration = new Configuration();

$configuration->setMetadataDriverImpl(new XmlDriver([__DIR__ . '/mappings']));
$configuration->setProxyDir(sys_get_temp_dir() . '/example' . uniqid());
$configuration->setProxyNamespace('ProxyExample');
$configuration->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_EVAL);

$configuration->setSecondLevelCacheEnabled();

$configuration
    ->getSecondLevelCacheConfiguration()
    ->setCacheFactory(new DefaultCacheFactory(
        new RegionsConfiguration(),
        $userCache
    ));

$configuration
    ->getSecondLevelCacheConfiguration()
    ->setCacheLogger(new StatisticsCacheLogger());

$entityManager = EntityManager::create(
    [
        'driverClass' => Driver::class,
        'path'        => __DIR__ . '/data/test-db.sqlite',
    ],
    $configuration
);

$schemaTool = new SchemaTool($entityManager);

$schemaTool->updateSchema(
    $entityManager->getMetadataFactory()->getAllMetadata()
);

$configuration->setSQLLogger(new EchoSQLLogger());

return $entityManager;
