<?php

declare(strict_types=1);

namespace Emmanuelc\MarvelApi\App\Configs;

use Emmanuelc\MarvelApi\Framework\App;

use Emmanuelc\MarvelApi\Framework\Controller\{
    HeroController,
    HomeController
};

class Routes
{
    public static function registerRoutes(App $app): void
    {
        $app->get("/", [HomeController::class, 'hello']);
        $app->get("/heroes", [HeroController::class, 'heroes']);
    }
}
