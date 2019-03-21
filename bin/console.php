<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative to the application root now.
 */
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

use Zend\Console\Console;
use Zend\Stdlib\Glob;
use Zend\Stdlib\ArrayUtils;
use Zend\ServiceManager\ServiceManager;
use ZF\Console\Application;
use ZF\Console\Dispatcher;

$config = [];
foreach (Glob::glob('config/autoload/{{*}}{{,*.local}}.php', Glob::GLOB_BRACE) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}

$serviceManager = new ServiceManager($config['service_manager']);
$serviceManager->setService('config', $config);

$application = new Application(
    $config['app'],
    $config['version'],
    $config['routes'],
    Console::getInstance(),
    new Dispatcher($serviceManager)
);
$application->setBannerDisabledForUserCommands(true);

$exit = $application->run();
exit($exit);
