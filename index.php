<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <?php
  error_reporting(0);

  #pegando dados dos inputs
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  #validando email 
  $validate_email = filter_var($email, FILTER_VALIDATE_EMAIL);
  $senha = $_POST['senha'];

  define("HOST", "localhost");
  define("USERNAME", "root");
  define("PASSWORD", "root");
  define("DB", "nome do banco");

  #abrindo o banco de dados 
  try{

    $database_connection = new mysqli(HOST, USERNAME,PASSWORD, DB,"port_string");
    if (mysqli_connect_errno()){
      echo "Error no banco, localizado no: ".$database_connection->connect_error;
    }
  

  #capturando dados do mysql
  $select_dados = "select count(*) from dadosphp.users where email = '$validate_email';";
  #mensagem inserir dados
  $insert_into = "INSERT INTO dadosphp.users(nome, email, senha) values ('$nome', '$validate_email', '$senha');";
 

  $select_enviar = $database_connection->query($select_dados);

  $dados_apresentavel= $select_enviar->fetch_row();

  $nome_mysql = $dados_apresentavel['nome'];
  $email_mysql = $dados_apresentavel['email'];
  $senha_mysql = $dados_apresentavel['senha'];

  

  }catch (Exception $error){

      echo "erro no:  $error";

    };
  ?>

  <body>

  <div class="center">
  <form action="" method="post" id="logs">
  <div class="mb-3">
    <label for="exampleInputNome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="exampleInputNome" aria-describedby="nameHelp" name="nome" required>
    </div>

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
  </div>
  <?php
  if ($dados_apresentavel[0] > 0){
    echo "<p id='mensagem-error-email'>Esse email já existe!</p>";
  }else{

    $database_connection->query($insert_into);
  };

  $database_connection->close();

  ?>

    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Senha</label>
    <input type="password" class="form-control" id="exampleInputPasswprd1" aria-describedby="passwordHelp" name="senha" required>
    </div>

    <center>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </center>
    <br>

    
  </div>
  </form>

  </div>
    
      </body>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
