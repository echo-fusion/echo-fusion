<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class ErrorsTest extends TestCase
{
    public function testAnUnknownPageIsA404UsingTheErrorTemplate(): void
    {
        $response = $this->get('/nowhere');

        $this->assertSame(404, $response->getStatusCode());
        $this->assertStringContainsString('<h1>404</h1>', (string) $response->getBody());
    }

    public function testApiClientsGetJsonErrors(): void
    {
        $response = $this->get('/nowhere', ['Accept' => 'application/json']);

        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame(404, json_decode((string) $response->getBody(), true)['status']);
    }

    public function testTheWrongMethodIsA405WithTheAllowedMethods(): void
    {
        $response = $this->request('POST', '/');

        $this->assertSame(405, $response->getStatusCode());
        $this->assertSame('GET, HEAD', $response->getHeaderLine('Allow'));
    }
}
