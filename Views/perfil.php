<h1>Editar Perfil</h1>

<form action="" method="post">

<div class="form-group">
    <label for="nome">Nome:</label>
        
        <input type="text" name="nome" id="nome"  class="form-control" value="<?php echo $info['nome'];?>">
    
</div>




<div class="form-group">
    <label for="senha">Senha:</label>
        
    <input type="password" name="senha" id="senha" class="form-control">
    
</div>



<div class="form-group">
    <label for="bio">Biografia:</label>
        
        <textarea name="bio" id="bio" class="form-control"><?php echo $info['bio'];?></textarea>
    
</div>

<div class="radio">
    <strong>Sexo: </strong>
    <?php if($info['sexo'] == '1') {
        echo "Feminino";
    }
    else {
        echo "Masculino"; 
    }
    ?>
    
</div>

<div class="form-group">
    <label for="email">
        <strong>Email: </strong><br>
        <?php echo $info['email'];?>
    </label>
</div>

<button type="submit" class="btn btn-primary">Salvar</button>
</form>