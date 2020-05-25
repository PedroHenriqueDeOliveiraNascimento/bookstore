<?php
require_once "includes/database.php";

$dbc = mysqli_connect(HOST, USER, PASSWORD, DB);
if(mysqli_connect_errno() != 0){
    exit("Falha na conexão: ".mysqli_connect_error());
}

if(isset($_POST["btn"])){
    session_start();
    var_dump($_POST);
    $id = mysqli_escape_string($dbc, $_POST["bookid"]);
    $name = mysqli_escape_string($dbc, $_POST["name"]);
    $publisher = mysqli_escape_string($dbc, $_POST["publisher"]);
    $price = mysqli_escape_string($dbc, $_POST["price"]);

    $query = "UPDATE `books` SET `name`= '$name', `publisher` = '$publisher', `price` = '$price' WHERE `id` = '$id'";
    $result = mysqli_query($dbc, $query);
    if(!$result){
        exit("Falha ao adicionar livro: ".mysqli_errno($dbc));
    }

    $_SESSION["updated"] = true;
    header("Location: index.php");
}else{
    if(!isset($_GET["id"])){
        header("Location: index.php");
        exit();
    }

    $id = mysqli_escape_string($dbc, $_GET["id"]);
    $query = "SELECT * FROM `books` WHERE `id` = $id";
    $result = mysqli_query($dbc, $query);
    if(mysqli_num_rows($result) != 1){
        header("Location: index.php");
        exit();
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
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
            <h1>Editar Livro</h1>
        </header>
        <main>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="bookid">Id</label>
                    <input disabled value="<?php echo $row["id"]; ?>" type="number" class="form-control" id="bookid" name="bookid"/>
                </div>

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input value="<?php echo $row["name"]; ?>" type="text" class="form-control" id="name" name="name" required/>
                </div>
                <div class="form-group">
                    <label for="publisher">Editora</label>
                    <input value="<?php echo $row["publisher"]; ?>" type="text" class="form-control" id="publisher" name="publisher" required/>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input value="<?php echo $row["price"]; ?>" type="number" step="0.01" min="0.01" class="form-control" id="price" name="price" placeholder="R$" required/>
                </div>
                <button class="btn btn-primary" name="btn">Editar</button>
            </form>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $("form").submit(function(e){
            $("form input#bookid").prop("disabled", false);
        })
    </script>
</body>
</html>
<?php
}
?>