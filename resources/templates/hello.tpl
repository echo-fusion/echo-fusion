{% extends "layouts/app" %}

{% block title %}Hello {{ name }}{% endblock %}

{% block content %}
<h1>Hello, {{ name }}!</h1>
<p>The value comes from the <code>{name}</code> placeholder of the route <code>/hello/{name}</code>, and it is escaped automatically.</p>
<p><a href="/">Back</a></p>
{% endblock %}
