<?php

declare(strict_types=1);

namespace Tests\Functional;

use Peru\Http\Async\ClientInterface;
use React\Promise\PromiseInterface;

class HttpClientStub implements ClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * HttpClientStub constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Make GET Request.
     *
     * @param string $url
     * @param array $headers
     *
     * @return PromiseInterface
     */
    public function getAsync(string $url, array $headers = []): PromiseInterface
    {
        return $this->client->getAsync(ClientStubDecorator::getNewUrl($url), $headers);
    }
}