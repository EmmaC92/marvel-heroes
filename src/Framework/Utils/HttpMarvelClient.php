<?php

declare(strict_types=1);

namespace Emmanuelc\MarvelApi\Framework\Utils;

use GuzzleHttp\Client as MarvelClient;

class HttpMarvelClient
{

    private $baseApiPath;
    private $publicApiKey;
    private $privateApiKey;

    public function __construct(
        private MarvelClient $client = new MarvelClient()
    ) {
        $this->baseApiPath = getenv("BASE_API_PATH");
        $this->publicApiKey = getenv("PUBLIC_API_KEY");
        $this->privateApiKey = getenv("PRIVATE_API_KEY");
    }

    public function getAllHeroes(): array
    {
        $fullPath = $this->getFullPathByTopic('characters');
        $response = $this->client->get($fullPath);

        $contentReponse = json_decode($response->getBody()->getContents());

        return (array)$contentReponse?->data?->results;
    }

    private function getFullPathByTopic(string $topic): string
    {
        $ts = strval(time());
        $hash = $this->getHashCode($ts);
        $publicApiKey = $this->publicApiKey;

        return sprintf(
            "%s%s?ts=%s&apikey=%s&hash=%s",
            $this->baseApiPath,
            $topic,
            $ts,
            $publicApiKey,
            $hash
        );
    }

    private function getHashCode(string $timeStamp): string
    {
        return md5($timeStamp . $this->privateApiKey . $this->publicApiKey);
    }
}
