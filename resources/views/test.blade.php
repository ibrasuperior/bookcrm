<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/sender" method="post">
        @csrf
        <input type="text" name="text" />
        <button type="submit">Enviar</button>
    </form>
</body>

</html>