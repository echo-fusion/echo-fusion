<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class HomeTest extends TestCase
{
    public function testTheHomePageIsRendered(): void
    {
        $response = $this->get('/');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('text/html', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('is running', (string) $response->getBody());
    }

    public function testARoutePlaceholderReachesTheTemplateAndIsEscaped(): void
    {
        $response = $this->get('/hello/' . rawurlencode('<b>Ann</b>'));

        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('Hello, &lt;b&gt;Ann&lt;/b&gt;!', (string) $response->getBody());
    }

    public function testPlaceholdersAreUrlDecoded(): void
    {
        $response = $this->get('/hello/' . rawurlencode('José'));

        $this->assertStringContainsString('Hello, José!', (string) $response->getBody());
    }

    public function testAnArrayBecomesJson(): void
    {
        $response = $this->get('/api/ping');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame('ok', json_decode((string) $response->getBody(), true)['status']);
    }
}
