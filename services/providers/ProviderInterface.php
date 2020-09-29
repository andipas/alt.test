<?php

namespace app\services\providers;


use app\services\ParserResponseDto;

interface ProviderInterface
{
    public function parse($url) : ParserResponseDto;
}