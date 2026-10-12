<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use EchoFusion\Contracts\TemplateManager\TemplateManagerInterface;

/**
 * A controller is built by the container, so ask for what you need in the constructor.
 * Each action's arguments come from its signature: route placeholders (`$name`), the request, or any service.
 * What it returns becomes the response: text is HTML, an array is JSON, null is an empty 204.
 */
final class HomeController
{
    public function __construct(private readonly TemplateManagerInterface $templates)
    {
    }

    public function index(): string
    {
        return $this->templates->render('home');
    }

    public function hello(string $name): string
    {
        return $this->templates->render('hello', ['name' => $name]);
    }

    /**
     * @return array<string, mixed>
     */
    public function ping(): array
    {
        return ['status' => 'ok', 'time' => gmdate('c')];
    }
}
