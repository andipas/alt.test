<?php

namespace app\services\providers;

use app\services\ParserResponseDto;
use GuzzleHttp\Client;

class RbkProvider implements ProviderInterface
{
    public function parse($url) : ParserResponseDto
    {
        $dto = new ParserResponseDto();
        $dto->parse_url = $url;

        $client = new Client();

        $res = $client->request('GET', $url);

        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);

        $dto->title = $document->find("div.article h1")->text();
        $dto->body = $document->find("div.article .article__text")->html();

        if(!$dto->title || !$dto->body){
            throw new NotFindDataException('Не удалось получить данные');
        }

        return $dto;
    }
}