<?php
session_start();
include_once "Connections/configpdo.php";
include_once 'funcoes/acesso.php';

if(isset($_POST['cadastrar'])){

$nome = strip_tags(trim($_POST['nome']));
$email = strip_tags(trim($_POST['email']));
$contato = strip_tags(trim($_POST['contato']));
$login = strip_tags(trim($_POST['login']));
$senha = md5($_POST['senha']);
$acesso_nivel = strip_tags(trim($_POST['acesso_nivel']));       
        
        //verificar se ja existe
        $select = $pdo->query("SELECT id FROM tb_usuarios WHERE login= '$login'");
            $result = $select->fetch(PDO::FETCH_OBJ);
            if($result->id != 0){
                $erro[] = "<div class='alerta'> Nome de login já existe. Tente outro.</div>";
            }else{
              $sql_inserir = 'INSERT INTO tb_usuarios (nome, email, contato, login, senha, acesso_nivel)
	VALUES (:nome, :email, :contato, :login, :senha, :acesso_nivel)';

	try{
		$query_inserir = $pdo->prepare($sql_inserir);
                
        $query_inserir->bindValue(':nome',$nome,PDO::PARAM_STR);
        $query_inserir->bindValue(':email',$email,PDO::PARAM_STR);
        $query_inserir->bindValue(':contato',$contato,PDO::PARAM_STR);
        $query_inserir->bindValue(':login',$login,PDO::PARAM_STR);
        $query_inserir->bindValue(':senha',$senha,PDO::PARAM_STR);
        $query_inserir->bindValue(':acesso_nivel',$acesso_nivel,PDO::PARAM_STR);
        
  		$query_inserir->execute();

        $msg[] = "<div class='sucesso'>Usuario cadastrado com sucesso!</div>";
        echo "<html><meta http-equiv=refresh content=1;URL=inicio.php?btn=cadUsuario></html>";

    }catch(PDOException $erro_cadastrar){
 		$erro[] = "<div class='erro'><b>Erro ao tentar salvar os dados.</b></div>".$erro_cadastrar->getMessage;
                		
	}  
          }
 }
?>
<!-- page content -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cadastro de Funcionários</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <p><a class="btn btn-outline-warning" href="inicio.php?btn=listUsuario"> LISTAR USUÁRIOS</a></p>
                      <form action="inicio.php?btn=cadUsuario" method="post" enctype="multipart/form-data">
                      <?php include("funcoes/msgerro.php");?> 
<div class="input-group input-group">
         <span class="input-group-addon "><font color="#FF0000">*</font>Nome:</span>
         <input type="text" name="nome" class="form-control" required value="<?php echo $nome;?>">
   </div><p></p>
<div class="input-group input-group">
         <span class="input-group-addon ">E-mail:</span>
         <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
   </div><p></p>
<div class="input-group input-group">
         <span class="input-group-addon ">Contato:</span>
         <input type="text" name="contato" class="form-control" value="<?php echo $contato;?>">
   </div><p></p>
   <div class="input-group input-group">
         <span class="input-group-addon ">Login:</span>
         <input type="text" name="login" class="form-control" required value="<?php echo $login;?>">
   </div><p></p> 
   <div class="input-group input-group">
         <span class="input-group-addon ">Senha:</span>
         <input type="password" name="senha" class="form-control" required value="<?php echo $senha;?>">
   </div><p></p> 
   <div class="row">
    <div class="col-xs-12">
    <label><b>Nivel de acesso?</b></label><br></br> 	
    <label class="custom-control custom-radio">
  <input id="radio1" name="acesso_nivel" type="radio" class="custom-control-input" value="1" <?php echo ($acesso_nivel == "1") ? "checked" : TRUE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Admin</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="5" <?php echo ($acesso_nivel == "5") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Caixa</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="2" <?php echo ($acesso_nivel == "2") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Recepção</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="3" <?php echo ($acesso_nivel == "3") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Bioimpedância</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="4" <?php echo ($acesso_nivel == "4") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Nutricionista</span>
</label>
<label class="custom-control custom-radio">
  <input id="radio2" name="acesso_nivel" type="radio" class="custom-control-input" value="6" <?php echo ($acesso_nivel == "6") ? "checked" : FALSE; ?>>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Mobile</span>
</label>
    </div></div> <p></p>

<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                <button type="submit" name="cadastrar" class="btn btn-success">Salvar</button> <a href="inicio.php?btn=listCategoria"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button></a>            
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        <!-- /page content --> 
