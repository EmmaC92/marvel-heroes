<?php

declare(strict_types=1);

namespace Emmanuelc\MarvelApi\Framework\Utils;

use GuzzleHttp\Client as MarvelClient;

class HttpMarvelClient
{

    private const MARVEL_API_BASE = "https://gateway.marvel.com/v1/public/";

    private const MARVEL_PUBLIC_KEY = "ec22c0fe40cb820063cbc0d47b09b2f9";

    private const MARVEL_PRIVATE_KEY = "4c97ac9eba1aa23bd3bcd870067a393e37ca1f82";

    public function __construct(
        private MarvelClient $client = new MarvelClient()
    ) {
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
        $publicApiKey = self::MARVEL_PUBLIC_KEY;

        return sprintf(
            "%s%s?ts=%s&apikey=%s&hash=%s",
            self::MARVEL_API_BASE,
            $topic,
            $ts,
            $publicApiKey,
            $hash
        );
    }

    private function getHashCode(string $timeStamp): string
    {
        return md5($timeStamp . self::MARVEL_PRIVATE_KEY . self::MARVEL_PUBLIC_KEY);
    }
}
