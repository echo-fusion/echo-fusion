{% extends "layouts/app" %}

{% block content %}
<h1>{{ appName }} is running</h1>
<p>You are looking at <code>resources/templates/home.tpl</code>, rendered by <code>App\Http\Controllers\HomeController</code> for the route <code>home</code> in <code>config/routes.php</code>.</p>
<ul>
    <li>Try a route with a placeholder: <a href="/hello/world">/hello/world</a></li>
    <li>Try a JSON route: <a href="/api/ping">/api/ping</a></li>
    <li>Try a page that does not exist: <a href="/nowhere">/nowhere</a></li>
</ul>
<p>Next: add a route, a controller and a template, or read the <a href="https://github.com/echo-fusion/framework">framework guide</a>.</p>
{% endblock %}
