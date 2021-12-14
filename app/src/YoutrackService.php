<?php

namespace App;

class YoutrackService
{
    private string $apiUrl;
    private array  $routes;
    private array  $config;
    private string $token;

    public function __construct(array $config, array $routes)
    {
        $this->routes = $routes;
        $this->config = $config;

        $this->apiUrl = $this->config['youtrack']['apiUrl'];
        $this->token  = $this->config['youtrack']['token'];
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @return string
     */
    private function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Cache-Control' => 'no-cache',
                'Cache-Type'    => 'application/json',
            ]
        ];
    }

    /**
     * @return array|string
     */
    public function getCurrentUserData(): ?array
    {
        return Request::send(
            'GET',
            $this->getApiUrl(),
            $this->routes['api']['users']['get.current.userdata'],
            $this->getHeaders()
        );
    }

	public function getIssues($youtrackUser): ?array
	{
		return Request::send(
			'GET',
			$this->getApiUrl(),
			$this->routes['api']['issues']['get.for'].$youtrackUser['login'],
			$this->getHeaders()
		);
	}


    /**
     * @return string|null
     */
    public function getCurrentUserID(): ?string
    {
        return $this->getCurrentUserData()['id'] ?? null;
    }
}