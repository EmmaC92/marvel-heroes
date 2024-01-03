<?php

namespace Emmanuelc\MarvelApi\Framework\Controller;

use Emmanuelc\MarvelApi\Framework\EngineTemplate;
use Emmanuelc\MarvelApi\Framework\Utils\HttpMarvelClient;

class HeroController
{
    public function __construct(
        private HttpMarvelClient $client,
        private EngineTemplate $view
    ) {
    }
    public function heroes()
    {
        $heroes = $this->client->getAllHeroes();

        echo $this->view->render(
            "heroes.php",
            [
                "heroes" => $heroes
            ]
        );
    }
}
