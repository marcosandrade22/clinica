   <script>
  
     function Cpf(){
         let inputCep = document.querySelector('input\[id=cpf\]'); 
         console.log(inputCep.value);
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>adm_pacientes/valida_cpf/'+inputCep.value,
            dataType:'json',
            success: function(resp) {
            console.log(resp); //debug
            if(resp.retorno_cpf=='true'){
                 $('#form-cpf').addClass('has-ok has-feedback');
               }
             else{
                  $('#form-cpf').addClass('has-error has-feedback');
            }
    }
  });
         
     }
  
  
    function Cep() {
    console.log('change');
    let inputCep = document.querySelector('input\[id=cep\]'); 
    let cep = inputCep.value.replace('-', '');
    let url = '<?php echo base_url(); ?>adm_pacientes/ajax_cep/'+cep; 
    let xhr = new XMLHttpRequest(); xhr.open('GET', url, true); 
    xhr.onreadystatechange = function() { 
    if (xhr.readyState == 4) { 
    if (xhr.status = 200) preencheCampos(JSON.parse(xhr.responseText)); } } 
    xhr.send();
    };
    
    function preencheCampos(json) { 
    document.querySelector('input[id=endereco]').value = json.logradouro;
    document.querySelector('input[id=bairro]').value = json.bairro; 
    document.querySelector('input[id=cidade]').value = json.localidade; 
    document.querySelector('input[id=estado]').value = json.uf; 
    }

</script>
<section class="pagina">
<div class="row">
    <div class="container">
        <div class="title-pagina">
            <?php echo $pagina; ?>
        </div>
        <hr>
       
        <form method="post" action="<?php echo base_url(); ?>adm_pacientes/store" />
        
        <div class="row">
          <input type='hidden' name="id_paciente" value="<?= set_value('id_paciente') ? : (isset($id_paciente) ? $id_paciente : ''); ?>">
         
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome do Paciente*</label>
                    <input required type="text" name="nome_paciente" value="<?= set_value('nome_paciente') ? : (isset($nome_paciente) ? $nome_paciente : ''); ?>" class="form-control" />
                </div>
                <div class="row">
                    <div class="col-md-4">
                          <label>Nascimento*</label>
                            <input required type="date" name="nasc_paciente" value="<?= set_value('nasc_paciente') ? : (isset($nasc_paciente) ? $nasc_paciente : ''); ?>" class="form-control" />
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Foto do Paciente</label>
                           <input id="fieldID" type="text"  name="foto_paciente" class="form-control" value="<?= set_value('foto_paciente') ? : (isset($foto_paciente) ? $foto_paciente : ''); ?>">
                            <a href="<?php echo base_url(); ?>assets/file/filemanager/dialog.php?field_id=fieldID" class="iframe-btn" type="button">Escolher Imagem</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                 <div class="col-md-6">
                    <div class="form-group" id="form-cpf">
                        <label>CPF*</label>
                        <input required id="cpf" onfocusout="Cpf()" onkeypress="Mascara(this, '###.###.###-##')" type="text" name="cpf_paciente" value="<?= set_value('cpf_paciente') ? : (isset($cpf_paciente) ? $cpf_paciente : ''); ?>" class="form-control" />
                    </div>
                 </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CNS*</label>
                            <input required type="text" name="cns_paciente" value="<?= set_value('cns_paciente') ? : (isset($cns_paciente) ? $cns_paciente : ''); ?>" class="form-control" />
                        </div>
                    </div>
                </div>
                    
            </div>   
            
          
        
         <div class="col-md-6">
                
             
             <div class="form-group">
                    <label>Nome da Mãe*</label>
                    <input required type="text" name="mae_paciente" value="<?= set_value('mae_paciente') ? : (isset($mae_paciente) ? $mae_paciente : ''); ?>" class="form-control" />
                </div>
             
             <div class="row">
              
                 <div class="col-md-3">
                <div class="form-group">
                    <label>CEP*</label>
                        <input required onfocusout="Cep()" onkeypress="Mascara(this, '#####-###')" type="text" id="cep" name="cep_paciente" value="<?= set_value('cep_paciente') ? : (isset($cep_paciente) ? $cep_paciente : ''); ?>" class="form-control" />
                 </div>
                </div>
                 
                 <div class="col-md-9">
                    <div class="form-group">
                       <label>Endereço*</label>
                       <input required type="text" id="endereco" name="end_paciente" value="<?= set_value('end_paciente') ? : (isset($end_paciente) ? $end_paciente : ''); ?>" class="form-control" />
                    </div>
                 </div>
                  
             </div>
             
             
             
              <div class="row">
                 
                 <div class="col-md-3">
                <div class="form-group">
                    <label>Número*</label>
                        <input required type="text"  name="num_paciente" value="<?= set_value('num_paciente') ? : (isset($num_paciente) ? $num_paciente : ''); ?>" class="form-control" />
                 </div>
                </div>
                 
                 <div class="col-md-9">
                    <div class="form-group">
                       <label>Bairro*</label>
                       <input required type="text" id="bairro" name="bairro_paciente" value="<?= set_value('bairro_paciente') ? : (isset($bairro_paciente) ? $bairro_paciente : ''); ?>" class="form-control" />
                    </div>
                 </div>
                  
             </div>
             
             
             <div class="row">
                 
                 <div class="col-md-6">
                <div class="form-group">
                    <label>Cidade/Município*</label>
                        <input required type="text" id="cidade" name="cidade_paciente" value="<?= set_value('cidade_paciente') ? : (isset($cidade_paciente) ? $cidade_paciente : ''); ?>" class="form-control" />
                 </div>
                </div>
                 
                 <div class="col-md-6">
                    <div class="form-group">
                       <label>Estado*</label>
                       <input required type="text" id="estado" name="estado_paciente" value="<?= set_value('estado_paciente') ? : (isset($estado_paciente) ? $estado_paciente : ''); ?>" class="form-control" />
                    </div>
                 </div>
                  
             </div>
         </div>
            
                  
        </div>
        
        <div class="row">
            <div class="col-md-12">
                 <div class="form-group">
                    <label>Informações Adicionais</label>
                    
                    <textarea id="artigo"  name="info_paciente" class="form-control">
                    <?= set_value('info_paciente') ? : (isset($info_paciente) ? $info_paciente : ''); ?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
            <input type="submit" value="SALVAR" class="btn btn-info" />
            </div>
        </div>
        </form>
        
    </div>
    
</div>
    

<script>
    $(function(){
	$('.iframe-btn').fancybox({
		  'width'	: 600,
		  'minHeight'	: 600,
		  'type'	: 'iframe',
		  'autoScale'   : true
     });
  });
 </script>

    <script>
    var editor = CKEDITOR.replace( 'artigo',{
	filebrowserBrowseUrl : '<?php echo base_url();?>assets/file/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : '<?php echo base_url();?>assets/file/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserImageBrowseUrl : '<?php echo base_url();?>assets/file/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
    });
    //CKFinder.setupCKEditor( editor );
    </script>