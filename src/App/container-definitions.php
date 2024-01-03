<?php

declare(strict_types=1);

use Emmanuelc\MarvelApi\Framework\Utils\HttpMarvelClient;
use Emmanuelc\MarvelApi\Framework\EngineTemplate;
use Emmanuelc\MarvelApi\App\Configs\Paths;

return [
    HttpMarvelClient::class => fn () => new HttpMarvelClient(),
    EngineTemplate::class => fn () => new EngineTemplate(Paths::VIEWS_PATH),
];