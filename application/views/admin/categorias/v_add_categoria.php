
<section class="pagina">
<div class="row">
    <div class="container">
        <div class="title-pagina">
            <?php echo $pagina; ?>
        </div>
        <hr>
        <form method="post" action="<?php echo base_url(); ?>adm_categorias/store" />
         <input type='hidden' name="id_categoria" value="<?= set_value('id_categoria') ? : (isset($id_categoria) ? $id_categoria : ''); ?>">
        <div class="row">
            
        
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome Categoria</label>
                    <input required type="text" name="nome_categoria" value="<?= set_value('nome_categoria') ? : (isset($nome_categoria) ? $nome_categoria : ''); ?>" class="form-control" />
                </div>
            
            <div class="form-group">
            <input type="submit" value="SALVAR" class="btn btn-info" />
            </div>
            </div>
            
        </div>
    </form>
    </div> 
</div>
</section>