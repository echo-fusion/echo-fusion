# EchoFusion

[![CI](https://github.com/echo-fusion/echo-fusion/actions/workflows/ci.yml/badge.svg)](https://github.com/echo-fusion/echo-fusion/actions/workflows/ci.yml) [![Packagist](https://img.shields.io/packagist/v/echo-fusion/echo-fusion.svg)](https://packagist.org/packages/echo-fusion/echo-fusion) [![PHP](https://img.shields.io/badge/php-8.1%20%7C%208.2%20%7C%208.3-777bb4.svg)](https://www.php.net) [![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

The application skeleton for the [EchoFusion framework](https://github.com/echo-fusion/framework): a ready folder structure, configuration, a front controller and example tests. Create a project and start writing your application.

> Part of [EchoFusion](https://github.com/echo-fusion), a modular PHP framework built from small packages.

## Installation

```bash
composer create-project echo-fusion/echo-fusion my-app
cd my-app
composer serve
```

Open <http://localhost:8000>. `composer create-project` also copies `.env.example` to `.env`.

## Requirements

* PHP 8.1, 8.2 or 8.3
* ext-mbstring, ext-pdo (and the PDO driver of your database)

## What you get

```
app/
  Http/Controllers/       controllers: built by the container, so ask for services in the constructor
  Providers/              your service providers (AppServiceProvider is listed in config/app.php)
config/
  app.php                 name, debug, timezone, modules, providers, plugins
  routes.php              the routes
  middleware.php          global middleware and the names usable in a route
  events.php              listeners
  services.php            container definitions
  templates.php  database.php  auth.php  session.php  console.php
  environments/           partial config merged on top for one environment (APP_ENV)
bin/console               the command line: php bin/console
database/migrations/      migration files (php bin/console migrate)
public/index.php          the front controller: Application::create(...)->run()
resources/templates/      templates (.tpl is the built-in language, .php is plain PHP)
storage/                  cache, sessions, logs (writable)
tests/                    feature tests that send requests through the application, no web server needed
.env                      settings that change between machines (never commit it)
```

## The command line

```bash
php bin/console                  # list the commands
php bin/console route:list       # every route
php bin/console make:controller Post
php bin/console make:migration create_posts_table --create=posts
php bin/console migrate          # run the migrations in database/migrations
php bin/console serve            # development server
```

Forms need the CSRF token: add `<input type="hidden" name="_token" value="{{ csrf }}">` and pass `['csrf' => $request->csrfToken()]` to the template. Paths under `/api/` are exempt (`config/app.php`).

## Your first page

1. A route in `config/routes.php`:

   ```php
   'about' => ['method' => 'GET', 'path' => '/about', 'action' => [PageController::class, 'about']],
   ```

2. A controller in `app/Http/Controllers/PageController.php`:

   ```php
   final class PageController
   {
       public function __construct(private readonly TemplateManagerInterface $templates) {}

       public function about(): string
       {
           return $this->templates->render('about');
       }
   }
   ```

3. A template in `resources/templates/about.tpl`:

   ```twig
   {% extends "layouts/app" %}
   {% block content %}<h1>About {{ appName }}</h1>{% endblock %}
   ```

An action can return text (HTML), an array or an object (JSON), `null` (an empty 204) or a PSR-7 response. Its arguments come from the signature: a parameter named like a placeholder in the path (`/posts/{id}` with `int $id`), the request, or any service.

## Tests

```bash
composer test         # PHPUnit
composer cs-check     # code style
composer cs-fix
```

`tests/TestCase.php` boots the application in the `testing` environment and gives you `$this->get('/path')`. Add a test for every page you add.

## Going to production

* Point the web server's document root at `public/` (never at the project root).
* Set `APP_ENV=production` and `APP_DEBUG=false` (debug output shows file paths and code), and `SESSION_SECURE=true` behind HTTPS.
* Make `storage/` writable by the web server.
* Install with `composer install --no-dev --optimize-autoloader`.

nginx:

```nginx
server {
    root /var/www/my-app/public;
    index index.php;

    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php-fpm.sock;
    }
}
```

Apache works out of the box with `public/.htaccess` (needs `mod_rewrite`).

## Learn more

* [How the framework boots and handles a request](https://github.com/echo-fusion/framework#how-it-boots)
* The packages it is built from: [routemanager](https://github.com/echo-fusion/routemanager), [templatemanager](https://github.com/echo-fusion/templatemanager), [databasemanager](https://github.com/echo-fusion/databasemanager), [authmanager](https://github.com/echo-fusion/authmanager), [eventmanager](https://github.com/echo-fusion/eventmanager) and more, listed in the [organization profile](https://github.com/echo-fusion)

## Credits

- [Amir Shadanfar](https://github.com/amir-shadanfar)

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
