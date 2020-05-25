
<?php
require_once "includes/database.php";

$dbc = mysqli_connect(HOST, USER, PASSWORD, DB);
if(mysqli_connect_errno() != 0){
    exit("Falha na conexão: ".mysqli_connect_error());
}

if(isset($_POST["btn"])){
    if(!isset($_POST["choose"])){
        header("Location: index.php");
        exit();
    }

    $id = mysqli_escape_string($dbc, $_POST["bookid"]);

    $query = "DELETE FROM `books` WHERE `id` = '$id'";
    $result = mysqli_query($dbc, $query);
    
    header("Location: index.php");

    if($result){
        session_start();
        $_SESSION["deleted"] = true;
    }

    exit();
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
    <title>Excluir livro</title>
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
    <div id="mymodal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Livro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <p>Você tem certeza que deseja apagar o livro "<?php echo $row["name"]; ?>" ?</p>
                        <input type="hidden" name="bookid" value="<?php echo $row["id"]; ?>"/>
                        <div class="form-group">
                            <input type="checkbox" id="choose" name="choose" value="sim">
                            <label for="choose">Sim</label>
                        </div>

                        <a href="index.php" class="btn btn-secondary">Voltar</a>
                        <button name="btn" class="btn btn-danger">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        window.addEventListener("load", function(){
            $("#mymodal").modal("show")
        })
    </script>
</body>
</html>
<?php
}
?>