<?php

namespace App;

class TelegramService
{
    private string $apiUrl;
    private array  $config;
    private string $token;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->apiUrl = $this->config['telegram']['apiUrl'];
        $this->token  = $this->config['telegram']['token'];
    }

    /**
    * @return string
    */
    public function getApiUrl(): string
    {
        return $this->apiUrl . $this->getToken();
    }

    /**
     * @return string
     */
    private function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return array|string
     */
    public function getUpdates(): ?array
    {
        return Request::send(
            'GET',
            $this->getApiUrl(),
            '/getUpdates'
        );
    }

    /**
     * @param array $output
     * @return int|null
     */
    public function getChatID(array $output): ?int
    {
        return $output['result'][0]['message']['chat']['id'] ?? null;
    }
}