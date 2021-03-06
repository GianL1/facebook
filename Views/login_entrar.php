<html>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div id="navbar">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="<?php echo BASE_URL ?>">Rede Social</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo BASE_URL ?>login/entrar">Login</a></li>
                        <li><a href="<?php echo BASE_URL ?>login/cadastrar">Cadastrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1>Entrar</h1>

            <?php if(!empty($erro)): ?>
                <div class="alert alert-danger">
                    <?php echo $erro;?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="email">
                        Email: <br>
                        <input type="email" name="email" id="email">
                    </label>
                </div>

                <div class="form-group">
                    <label for="senha">
                        Senha: <br>
                        <input type="password" name="senha" id="senha">
                    </label>
                </div>

                <button type="submit" class="btn btn-default">Entrar</button>
            </form>
        </div>
    </body>

</html>