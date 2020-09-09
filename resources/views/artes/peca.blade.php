<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <title>Peças</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"
        type="text/javascript"></script>

</head>


<body style="zoom: 0.8; background-color: #f6f6f6; font-family: 'Montserrat', sans-serif;">
    <div class="container col-md-4 offset-md-4" style="display: flex; aling-items: bottom;">
        <div class="row mt-2 p-4 shadow-sm ">
            <div>
                <div id="capture" class="img-capture">
                    <div id="pai">
                        <div class="text">
                            <h5>Contato:</h5>
                            <h6><i class="fas fa-user"></i> <?php echo $_POST['nome'] ?> </h6>
                            <h6><i class="fab fa-whatsapp"></i> <?php echo $_POST['telefone'] ?></h6>
                        </div>
                    </div>
                </div>
                <button class="mt-2 btn btn-info" id="save_image_locally">Baixar</button>
            </div>
        </div>
        <script>
        $('#save_image_locally').click(function() {
            html2canvas($('#capture'), {
                onrendered: function(canvas) {
                    var a = document.createElement('a');
                    // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                    a.href = canvas.toDataURL(
                        "image/jpeg"
                    ).replace("image/jpeg",
                        "image/octet-stream");
                    a.download = 'signature.jpg';
                    a.click();
                }
            });
        });
        </script>

        <style type="text/css">
        #pai {
            width: 182px;
            position: absolute;
            height: 63px;
            margin-left: 24px;
            margin-top: 425px;

        }

        .img-capture {
            background-image: url('/storage/artes/<?=$_POST['img']?>');
            background-repeat: no-repeat;
            background-size: 600px 600px;
            width: 600px;
            height: 600px;
        }

        .text {
            padding-left: 10px;
            padding-top: 10px;
        }

        buttom h4 {
            font-weight: bold;
        }

        h5 {
            font-weight: bold;
            font-size: 12px;
            position: relative;
            top: -8px;
        }

        h6 {
            font-weight: bold;
            font-size: 14px;
            position: relative;
            top: -8px;
        }
        </style>
</body>
<script src="https://kit.fontawesome.com/dc83f2b96b.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>

</html>
