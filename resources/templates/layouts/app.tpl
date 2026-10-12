<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{% block title %}{{ appName }}{% endblock %}</title>
    <style>
        :root { color-scheme: light dark; --fg: #1b1f24; --bg: #ffffff; --muted: #5b6672; --accent: #3b5bdb; --line: #e3e6ea; }
        @media (prefers-color-scheme: dark) { :root { --fg: #e8eaed; --bg: #16181d; --muted: #9aa3ad; --accent: #8da2fb; --line: #2a2e36; } }
        body { margin: 0; font: 16px/1.6 system-ui, sans-serif; color: var(--fg); background: var(--bg); }
        main { max-width: 42rem; margin: 0 auto; padding: 4rem 1.25rem; }
        h1 { margin: 0 0 .5rem; font-size: 2rem; }
        p, li { color: var(--muted); }
        a { color: var(--accent); }
        code { padding: .1rem .3rem; border: 1px solid var(--line); border-radius: 4px; }
    </style>
</head>
<body>
<main>
{% block content %}{% endblock %}
</main>
</body>
</html>
