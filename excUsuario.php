<?php
session_start();
include_once "Connections/configpdo.php";
include_once 'funcoes/acesso.php';

	$cIdGet = $_GET['id'];
        
        /// buscar dados do produto
    $select = $pdo->query("SELECT ativo FROM tb_usuarios WHERE id='$cIdGet' order by id DESC");
    $result = $select->fetch(PDO::FETCH_OBJ);
    $ativo = $result->ativo;
       
             if($ativo != 0){
                $mostra = 0;
            echo "<html><script> $(document).ready(function(){ $('#myModal').modal(); }); </script></html>";
				
                
             }else{

             	$sqlDelete = 'DELETE FROM tb_usuarios WHERE id = :id';

				try {
					$delete = $pdo->prepare($sqlDelete);
         			$delete->bindValue(':id',$cIdGet, PDO::PARAM_INT);
					if($delete->execute()){
                                           $mostra = 1;
                                    echo "<html><script> $(document).ready(function(){ $('#myModal').modal(); }); </script></html>";
				
					}
				} catch (PDOException $e) {
                                          $mostra = 2;
                                    echo "<html><script> $(document).ready(function(){ $('#myModal').modal(); }); </script></html>";
				
				}
			}
                        ?>
<div class="container">
   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
           <div class="modal-header">
               <h2><?php if($mostra ==0){echo 'Usuário Ativo';} elseif($mostra == 1){echo 'Registro deletado';}elseif($mostra == 2){echo 'Erro SQL';}?></h2>
               <button type="button" class="close" onclick="javascript: location.href='inicio.php?btn=listUsuario'" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <p><?php if($mostra ==0){$erro[] = "<div class='alerta'>Usuário aivo! Para deletar desative o usuário primeiro.</div>";}elseif ($mostra ==1){$erro[] = "<div class='sucesso'>Paciente deletado com sucesso!</div>";}elseif ($mostra ==2){$erro[] = "<div class='erro'>Contactar o administrador do sistema!<br>===============================><br>".$e->getMessage()."</div>";}
       echo "<html><meta http-equiv=refresh content=5;URL=inicio.php?btn=listUsuario></html>";
       include("funcoes/msgerro.php");?>
        </div>
        <div class="modal-footer">
        <button type="button" onclick="javascript: location.href='inicio.php?btn=listUsuario'" class="btn btn-default" data-dismiss="modal">OK</button></a>
          
        </div>
     </div>
    </div>
  </div>
</div>