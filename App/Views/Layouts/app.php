<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="/">Home</a>
        <a href="/posts/index">Posts</a>
    </nav>
    <div class="container">

        {% block body %}
        {% endblock %}

    </div>
</body>

</html>