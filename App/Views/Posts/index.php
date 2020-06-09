{% extends "Layouts/app.php" %}

{% block body %}

<h1>POSTS</h1>

{% for post in posts %}
<div>
    <h3>{{ post.title }}</h3>
    <p>{{ post.content }}</p>
    <hr>
</div>
{% endfor %}


{% endblock %}