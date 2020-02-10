<div class="row">
    <div class="col-sm-8">
        <div class="post_area">
            <form action="" method="post" enctype="multipart/form-data">
                <h4>O que você está pensando ?</h4>
                <textarea name="post" class="form-control"></textarea>
                <input type="file" name="foto"><br>
                <button type="submit" class="btn btn-primary">Enviar</button>
                
            </form>
            <br>

            <div class="feed">
                <?php 
                    foreach($feed as $postitem ) {
                        $this->loadView('postitem', $postitem); 
                    }
                ?>
            </div>
        </div>

        
    </div>
    
    
    
    <div class="col-sm-4">
        <?php if(count($requisicoes) >0): ?>
            <div class="widget">
                <h4>Requisições de amizade</h4>
                <?php foreach($requisicoes as $pessoa): ?>
                    <div class="requisicaoitem">
                        <strong><?php echo $pessoa['nome']; ?></strong> <button type="submit" class="btn btn-default pull-right" 
                        onclick="aceitarFriend(<?php echo $pessoa['id']; ?>, this)">Aceitar</button><br>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="widget">
                <h4>Total de Amigos</h4>
                <?php echo $totalamigos; ?> amigo <?php echo ($totalamigos == '1')?'':'s' ?>
        </div>

        <?php if(count($sugestoes)> 0): ?>
            <div class="widget">
                <h4>Sugestões de amigo</h4>
            <?php foreach($sugestoes as $pessoa): ?>
            <div class="sugestaoitem">
                    <strong><?php echo $pessoa['nome']; ?></strong> <button type="submit" class="btn btn-default pull-right" 
                    onclick="addFriend(<?php echo $pessoa['id']; ?>, this)">+</button><br>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="widget">
                <h4>Grupos</h4>
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="grupo" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </span>
                    </div>
                </form>
                <?php foreach($grupos as $grupo) : ?>
                    <a href="<?php echo BASE_URL;?>grupos/abrir/<?php $grupo['id']; ?>"><?php echo $grupo['titulo']; ?></a>
                <?php endforeach; ?>
        </div>
    </div>
</div>