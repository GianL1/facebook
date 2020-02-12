<h1><?php echo $info['titulo']; ?>(<?php echo $qt_membros; ?>) Membro<?php echo ($qt_membros == '1')?'':'s'?></h1>
<?php if($is_membro): ?>
    <h3>Você é membro, parabens !</h3>

    <div class="post_area">
            <form action="" method="post" enctype="multipart/form-data">
                <h4>O que você está pensando ?</h4>
                <textarea name="post" class="form-control"></textarea>
                <input type="file" name="foto"><br>
                <button type="submit" class="btn btn-primary">Enviar</button>
                
            </form>
    </div>
    <div class="feed">
        <?php 
            foreach($feed as $postitem ) {
                $this->loadView('postitem', $postitem); 
            }
                ?>
    </div>
<?php else: ?>
    <h3>Você não é membro deste grupo</h3>
    <a href="<?php echo BASE_URL; ?>grupos/entrar/<?php echo $id_grupo?>" class="btn btn-primary">Entrar</a>
<?php endif; ?>