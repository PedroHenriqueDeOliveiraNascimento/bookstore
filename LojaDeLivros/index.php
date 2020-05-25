<?php
session_start();
require_once "includes/database.php";

$dbc = mysqli_connect(HOST, USER, PASSWORD, DB);

if(mysqli_connect_errno() != 0){
    exit("Falha na conexão: ".mysqli_connect_error());
}

$query = "SELECT * FROM `books` ORDER BY id DESC";
$result = mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Livros</title>
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
            <h1>Loja de Livros</h1>
            <a href="add.php" class="btn btn-success">Adicionar Livro</a>
            <?php
            if(isset($_SESSION["added"]) && $_SESSION["added"]){
                $_SESSION["added"] = false;
                ?>
                <div style="margin: 10px auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                    Livro adicionado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }

            if(isset($_SESSION["updated"]) && $_SESSION["updated"]){
                $_SESSION["updated"] = false;
                ?>
                <div style="margin: 10px auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                    Livro atualizado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }

            if(isset($_SESSION["deleted"]) && $_SESSION["deleted"]){
                $_SESSION["deleted"] = false;
                ?>
                <div style="margin: 10px auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                    Livro excluido com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
        </header>
        <main>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th scolpe="col">Id</th>
                        <th scolpe="col">Nome</th>
                        <th scolpe="col">Editora</th>
                        <th scolpe="col">Preço</th>
                        <th scolpe="col">Ações</th>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>1</td>
                            <td>Livro 1</td>
                            <td>Editora 1</td>
                            <td>R$50,00</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr> -->

                        <?php
                            while(($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != null){
                                ?>
                                <tr>
                                    <td><?php echo $row["id"] ?></td>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><?php echo $row["publisher"] ?></td>
                                    <td><?php echo $row["price"] ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row["id"] ?>" class="btn btn-warning">Editar</a>
                                        <a href="delete.php?id=<?php echo $row["id"] ?>" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
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
mysqli_close($dbc);
?>