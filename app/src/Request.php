<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Request
{
    /**
     * @param string $method
     * @param string $url
     * @param string $command
     * @param array $headers
     * @return mixed|string
     */
    public static function send(string $method, string $url, string $command, array $headers = []): ?array
    {
        $guzzle = new Client();

        try {
            $res = $guzzle->request(
                $method,
                $url . $command,
                $headers
            );

            return json_decode($res->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

	/**
	 * @param array $params
	 * @return string
	 */
    public static function buildGetQuery(array $params): string
    {
	    return http_build_query($params);
    }
}