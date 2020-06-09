{% extends "Layouts/app.php" %}

{% block body %}

<h1>Hello {{ name }}</h1>
<p>From Home controller, index method</p>
<ul>
    {% for color in colors %}
    <li>{{ color }}</li>
    {% endfor %}
</ul>

{% endblock %}