<?php

require __DIR__ . "/../../vendor/autoload.php";

use Emmanuelc\MarvelApi\Framework\App;
use Emmanuelc\MarvelApi\App\Configs\{
    Paths,
    Routes
};

$app = new App(Paths::SOURCE_PATH . "src/App/container-definitions.php");
Routes::registerRoutes($app);

return $app;
