<?php
session_start();
include_once "Connections/configpdo.php";
include_once 'funcoes/acesso.php';
?>
<!-- page content -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de Funcionários</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <p><a class="btn btn-outline-primary" href="inicio.php?btn=cadUsuario">NOVO USUÁRIO</a></p>
           <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
               <thead>
          <tr>
      <th><b>NOME</b></th>
      <th><b>CONTATO</b></th>
      <th><b>CARGO</b></th>
      <th><b>ATIVO</b></th>
      <th><b>EDITAR</b></th>
      <th><b>EXCLUIR</b></th>
           </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                                           
$sqlRead = "SELECT `id`, `nome`, `email`, `contato`, `login`, `senha`, `acesso_nivel`, `ativo` FROM tb_usuarios WHERE acesso_nivel !=4";
try {
$read = $pdo->prepare($sqlRead);
$read->execute();
} catch (PDOException $e) {
echo $e->getMessage();
}

while( $rs = $read->fetch(PDO::FETCH_OBJ) ){
    $acessonivel = $rs->acesso_nivel;
    $nAtivo = $rs->ativo;
    $idUser = $rs->id;
    
?>
              <tr class="odd gradeX">
           
      
      <td><?php echo $rs->nome;?></td>
      <td><?php echo $rs->contato;?></td>
      <td><?php if($acessonivel == 1){echo'Admin';}if($acessonivel == 2){echo'Recepção';}if($acessonivel == 3){echo'Bioimpedância';}if($acessonivel == 4){echo'Nutricionista';}if($acessonivel == 5){echo'Caixa';}if($acessonivel == 6){echo'Mobile';}?></td>
      <td>
      <?php       
      if($nAtivo != 0){
          $Ativo = $rs->ativo;
          ?>
          <span <?php echo $Ativo;?><div class="fa fa-check" style="color:green;"></div></span>
      <?php }else{
          $Desativado = $rs->ativo;
          ?>
          <span <?php echo $Desativado;?><div class="fa fa-ban" style="color:red;"></div></span>
          <?php }?>    
      
              
      </td>
        <td><a href="inicio.php?btn=altUsuario&id=<?php echo $idUser;?>"<span class="fa fa-edit" style="color:blue;"></span></a></td>
        <td><a href="inicio.php?btn=excUsuario&id=<?php echo $idUser;?>"<span class="fa fa-trash" style="color:red;"></span></a></td>
           <?php }?>
                                    </tbody>
                                </table>
                            </div>                                        
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
                responsive: true
        });
    });
    </script> 
        <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        <!-- /page content -->

         
 
