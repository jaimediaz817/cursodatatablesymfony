<?php
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';
if (PHP_VERSION_ID < 70000) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

// TODO: refactor AMBIENTE
$kernel = new AppKernel('prod', false);

/*
Ok...por  eso era que no te mostraba nunca los assets de producciòn
por siempre estabas en desarrollo :)

jajaja carlos , entonces esta en true, y el otro fichero app_dev.php en false?
soo es retirarla
para usar el entorno de desarrollo lo haces de la siguiente manera
$kernel = new AppKernel('dev', true);
*/

if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}

// TODO: refactor-remote (agregando // DEBUG: )
Debug::enable();


//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
