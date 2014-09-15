<?php

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Proxy\ProxyFactory;

require_once __DIR__ . '/vendor/autoload.php';

$configuration = new Configuration();

$configuration->setMetadataDriverImpl(new XmlDriver([__DIR__ . '/mappings']));
$configuration->setProxyDir(sys_get_temp_dir() . '/example' . uniqid());
$configuration->setProxyNamespace('ProxyExample');
$configuration->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_EVAL);

return EntityManager::create(
    [
        'driverClass' => \Doctrine\DBAL\Driver\PDOSqlite\Driver::class,
        'database'    => __DIR__ . '/test-db.sqlite',
    ],
    $configuration
);

