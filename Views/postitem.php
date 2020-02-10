
<div class="postitem">
    
    <div class="postitem_info">
        <strong>Post de: </strong> <?php echo $nome; ?>
    </div>
    <div class="postitem_texto">
        <?php echo $texto; ?>
    </div>
    <?php if ($tipo === 'foto'): ?>
        <img src="<?php echo BASE_URL?>Assets/images/posts/<?php echo $url; ?>" border="0" width="100%">
    <?php endif; ?>

    
    <div class="postitem_botoes">
        <button class="btn btn-primary" onclick="curtir(this)" 
        data-id="<?php echo $id; ?>" 
        data-likes="<?php echo $likes; ?>" 
        data-liked="<?php echo $liked; ?>">
            (<?php echo $likes ?>) <?php echo ($liked == '0')?'Curtir':'Descurtir'; ?>
        </button>

        <button class="btn btn-primary"  onclick="displayComentario(this)">Comentario</button><br><br>
        
        <div class="postitem_comentario">
            <input type="text" class="postitem_txt form-control"><br>
            <button type="submit" class="btn btn-primary" data-id="<?php echo $id; ?>" onclick="comentar(this)">Comentar</button>
        </div><br>
       
    </div>
</div>