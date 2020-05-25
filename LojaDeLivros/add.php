<?php
session_start();
require_once "includes/database.php";

if(isset($_POST["btn"])){
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB);

    if(mysqli_connect_errno() != 0){
        exit("Falha na conexão: ".mysqli_connect_error());
    }

    $name = mysqli_escape_string($dbc, $_POST["name"]);
    $publisher = mysqli_escape_string($dbc, $_POST["publisher"]);
    $price = mysqli_escape_string($dbc, $_POST["price"]);

    $query = "INSERT INTO `books` (`name`, `publisher`, `price`) VALUES ('$name', '$publisher', '$price')";
    $result = mysqli_query($dbc, $query);
    if(!$result){
        exit("Falha ao adicionar livro: ".mysqli_errno($dbc));
    }
    mysqli_close($dbc);
    $_SESSION["added"] = true;
    header("Location: index.php");
}else{

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .content {
            width: 100%;
            max-width: 768px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="content">
        <header>
            <h1>Adicionar Livro</h1>
        </header>

        <main>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required/>
                </div>
                <div class="form-group">
                    <label for="publisher">Editora</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" required/>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="number" step="0.01" min="0.01" class="form-control" id="price" name="price" placeholder="R$" required/>
                </div>
                <button class="btn btn-primary" name="btn">Adicionar</button>
            </form>
        </main>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        
    </script>
</body>
</html>
<?php
}
?>