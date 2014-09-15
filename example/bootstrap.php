<?php

use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\SchemaTool;

require_once __DIR__ . '/vendor/autoload.php';

$configuration = new Configuration();

$configuration->setMetadataDriverImpl(new XmlDriver([__DIR__ . '/mappings']));
$configuration->setProxyDir(sys_get_temp_dir() . '/example' . uniqid());
$configuration->setProxyNamespace('ProxyExample');
$configuration->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_EVAL);
$configuration->setSQLLogger(new EchoSQLLogger());

$entityManager = EntityManager::create(
    [
        'driverClass' => \Doctrine\DBAL\Driver\PDOSqlite\Driver::class,
        'path'        => __DIR__ . '/test-db.sqlite',
    ],
    $configuration
);

$schemaTool = new SchemaTool($entityManager);

$schemaTool->updateSchema(
    $entityManager->getMetadataFactory()->getAllMetadata()
);

return $entityManager;

