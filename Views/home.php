<div class="row">
    <div class="col-sm-8">...</div>
    <div class="col-sm-4">
        <div class="widget">
            <h4>Requisições de amizade</h4>
        </div>
        <div class="widget">
            <h4>Sugestões de amigo</h4>
           <?php foreach($sugestoes as $pessoa): ?>
           <div class="sugestao_item">
                <strong><?php echo $pessoa['nome']; ?></strong> <button type="submit" class="btn btn-default pull-right">+</button><br>
            </div>
           <?php endforeach; ?>
        </div>
    </div>
</div>