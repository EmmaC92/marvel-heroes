<?php

namespace Emmanuelc\MarvelApi\Framework\Controller;

use Emmanuelc\MarvelApi\Framework\EngineTemplate;
class HomeController
{
    public function __construct(private EngineTemplate $engineTemplate)
    {
    }
    public function hello()
    {
        echo $this->engineTemplate->render("home.php", [
            'title' => 'Marvel | Home'
        ]);
    }
}
