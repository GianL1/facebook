<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/style.css"/>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script.js"></script>
    
    
    <title>Refazendo o Facebook</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL; ?>">Rede Social <span class="sr-only">(current)</span></a>
      </li>
      <form method="GET" action="<?php echo BASE_URL;?>busca" class="navbar-form navbar-left navbar-input-group">
          <div class="form-group">
              <input type="text" name="q" class="form-control" placeholder="Buscar">
          </div>
          <button type="submit" class="btn btn-primary">Buscar</button>
          
      </form>
      
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $data['usuario_nome']?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo BASE_URL; ?>perfil">Editar Perfil</a>
            <a class="dropdown-item" href="<?php echo BASE_URL; ?>login/sair">Sair</a>
        </div>
        </li>
    </ul>
  </div>
</nav>
    <?php $this->loadViewInTemplate($view, $data); ?>
</body>
</html>