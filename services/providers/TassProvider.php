<?php

namespace app\services\providers;


use app\services\ParserResponseDto;
use GuzzleHttp\Client;

class TassProvider implements ProviderInterface
{
    public function parse($url): ParserResponseDto
    {
        $dto = new ParserResponseDto();
        $dto->parse_url = $url;

        $client = new Client();

        $res = $client->request('GET', $url);

        $body = $res->getBody();

        $document = \phpQuery::newDocumentHTML($body);

        $dto->title = $document->find("#news h1")->text();
        $dto->body = $document->find("#news .text-content")->html();

        if(!$dto->title || !$dto->body){
            throw new NotFindDataException('Не удалось получить данные');
        }

        return $dto;
    }

}