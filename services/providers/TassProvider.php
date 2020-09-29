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

        $images = $document->find("#news .news-media img");

        foreach ($images as $image){
            $pq = pq($image);
            $src = $pq->attr('src');
            if(substr($src, 0, 2) == '//'){
                $src = substr_replace($src, null, 0, 2);
            }

            $dto->images[] = $src;
        }

        if(!$dto->title || !$dto->body){
            throw new NotFindDataException('Не удалось получить данные');
        }

        return $dto;
    }

}