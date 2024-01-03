<?php

namespace Emmanuelc\MarvelApi\Framework;

class EngineTemplate
{

    private array $globalParameters = [];

    public function __construct(private string $basePath)
    {
    }

    public function render(string $template, array $parameters = []): string
    {
        extract($parameters, EXTR_SKIP);
        extract($this->globalParameters, EXTR_SKIP);

        ob_start();

        include $this->resolvePath($template);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    public function resolvePath(string $path): string
    {
        return "{$this->basePath}/$path";
    }
}
