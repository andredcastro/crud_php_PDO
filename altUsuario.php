<?php
session_start();
include_once "Connections/configpdo.php";
include_once 'funcoes/acesso.php';
$idUser = $_GET['id'];

   /// buscar dados de usuario
    $select = $pdo->query("SELECT * FROM tb_usuarios WHERE id='$idUser'");
    $result = $select->fetch(PDO::FETCH_OBJ);
    $senha_atual = $result->senha;
 if(isset($_POST['alterar'])){

$nome = strip_tags(trim($_POST['nome']));
$email = strip_tags(trim($_POST['email']));
$contato = strip_tags(trim($_POST['contato']));
$login = strip_tags(trim($_POST['login']));
$senha = strip_tags(trim($_POST['senha']));
$acesso_nivel = strip_tags(trim($_POST['acesso_nivel'])); 
$ativo = strip_tags(trim($_POST['ativo']));
if($senha == $senha_atual){}else{$senha = md5($_POST['senha']);};  

    $sql_upd = "UPDATE tb_usuarios SET nome=:nome, email=:email, contato=:contato, login=:login, senha=:senha, acesso_nivel=:acesso_nivel, ativo=:ativo
 WHERE id='$idUser'";      
              
	try{
            $upd = $pdo->prepare($sql_upd);
       
        $upd->bindParam(':nome',$nome,PDO::PARAM_STR);
        $upd->bindParam(':email',$email,PDO::PARAM_STR);
        $upd->bindParam(':contato',$contato,PDO::PARAM_STR);
        $upd->bindParam(':login',$login,PDO::PARAM_STR);
        $upd->bindParam(':senha',$senha,PDO::PARAM_STR);
        $upd->bindParam(':acesso_nivel',$acesso_nivel,PDO::PARAM_STR);
        $upd->bindParam(':ativo',$ativo,PDO::PARAM_STR);
        
  		$upd->execute();                
        $msg[] = "<div class='sucesso'>Usuario atualizado com sucesso!</div>";
        echo "<html><meta http-equiv=refresh content=1;URL=inicio.php?btn=listUsuario></html>";

    }catch(PDOException $erro_cadastrar){
 		$erro[] = "<div class='erro'><b>Erro ao tentar salvar os dados.</b></div>".$erro_cadastrar->getMessage;
                		
	}  
          }
 
?>
<!-- page content -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Alterar dados do Funcionários</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <p><a class="btn btn-outline-primary" href="inicio.php?btn=cadUsuario">NOVO USUÁRIOS</a> <a class="btn btn-outline-warning" href="inicio.php?btn=listUsuario">LISTAR USUÁRIOS</a></p>
                      <form action="inicio.php?btn=altUsuario&id=<?php echo $idUser;?>" method="post" enctype="multipart/form-data">
                <?php include("funcoes/msgerro.php");?>
<div class="input-group">
         <span class="input-group-addon "><font color="#FF0000">*</font>Nome:</span>
         <input type="text" name="nome" class="form-control" required value="<?php echo $result->nome;?>">
   </div><p></p>
<div class="input-group">
         <span class="input-group-addon ">E-mail:</span>
         <input type="text" name="email" class="form-control" value="<?php echo $result->email;?>">
   </div><p></p>
<div class="input-group">
         <span class="input-group-addon ">Contato:</span>
         <input type="text" name="contato" class="form-control" value="<?php echo $result->contato;?>">
   </div><p></p>
   <div class="input-group">
         <span class="input-group-addon "><font color="#FF0000">*</font>Login:</span>
         <input type="text" name="login" class="form-control" readonly value="<?php echo $result->login;?>">
   </div><p></p> 
   <div class="input-group">
         <span class="input-group-addon "><font color="#FF0000">*</font>Senha:</span>
         <input type="password" name="senha" class="form-control" value="<?php echo $result->senha;?>">
   </div><p></p>
   <div class="row">
    <div class="col-xs-6">
    <label><b>Nivel de acesso?</b></label><br></br>
    <label class="custom-control custom-radio">
  <input id="radio1" name="acesso_nivel" type="radio" class="custom-control-input" value="1" <?php echo ($result->acesso_nivel == "1") ? "checked" : TRUE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Admin</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="5" <?php echo ($result->acesso_nivel == "5") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Caixa</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="2" <?php echo ($result->acesso_nivel == "2") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Recepção</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="3" <?php echo ($result->acesso_nivel == "3") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Bioimpedância</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="6" <?php echo ($result->acesso_nivel == "6") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Mobile</span>
</label>
    </div>
    <div class="col-xs-6">
    <label><b>Ativo?</b></label><br></br>
    <label class="custom-control custom-radio">
  <input id="radio1" name="ativo" type="radio" class="custom-control-input" value="1" <?php echo ($result->ativo == "1") ? "checked" : TRUE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Sim</span>
</label>
    <label class="custom-control custom-radio">
  <input id="radio1" name="ativo" type="radio" class="custom-control-input" value="0" <?php echo ($result->ativo == "0") ? "checked" : TRUE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Não</span>
</label>
    </div>
   </div>
<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" name="alterar" class="btn btn-success">Alterar</button> <a href="inicio.php?btn=listUsuario"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button></a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        <!-- /page content -->   
