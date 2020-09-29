<?php

namespace app\helpers;


class RequestHelper
{
    public static function getDataByUrl($url, $timeOut = 8)
    {
        if (function_exists('curl_version')) {
            $ch = curl_init();

            if (strtolower(substr($url, 0, 5)) == "https") {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            if (isset($_SERVER) && isset($_SERVER["HTTP_USER_AGENT"])) {
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
            }
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeOut);

            $rawData = curl_exec($ch);
            //$info = curl_getinfo($ch, false);
            curl_close($ch);
        } else {
            $ctx = stream_context_create(array('http' =>
                array(
                    'timeout' => $timeOut, // 8 Seconds
                )
            ));
            $rawData = @file_get_contents($url, false, $ctx);
        }

        return $rawData;
    }
}