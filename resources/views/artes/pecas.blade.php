<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Peças</title>
</head>

<body>
    <?php
        $img = $_GET['img'];
    ?>
    <div class="container">

        <div class="row">
            <div class="mt-5 col-md-6 offset-md-3 p-4 shadow-lg">
                <h2>Crie sua peça personalizada!</h2>
                <hr />

                <form method="post" action="/artes/peca" class="form">
                    @csrf
                    <input type="hidden" name="img" value="<?=$img?>">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input required name="nome" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Telefone Comercial:</label>
                        <input required name="telefone" type="text" class="form-control" />
                    </div>
                    <button class="btn btn-block btn-primary">Criar Peça</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>