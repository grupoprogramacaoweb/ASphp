

<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Gerencia de cursos</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Gerência de cursos</font></p>
		</div>
		
		<br>
 <body>
 <?php

 
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cargahorariacurso = (isset($_POST["cargahorariacurso"]) && $_POST["cargahorariacurso"] != null) ? $_POST["cargahorariacurso"] : "";
    //$cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : NULL;
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $cargahorariacurso = NULL;
    $cpf = NULL;
}
 
// Cria a conexão com o banco de dados
try {
    //$conexao = new PDO("mysql:host=localhost;dbname=crudsimples", "root", "123456");
	$conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
 
// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE tb_cursos SET nomecurso=?, cargahorariacurso=? WHERE idcurso = ?");
            $stmt->bindParam(4, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO tb_cursos (nomecurso, cargahorariacurso) VALUES (?, ?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $cargahorariacurso);
        //$stmt->bindParam(3, $cpf);
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
                $cargahorariacurso = null;
                //$cpf = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM tb_cursos WHERE idcurso = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->idcurso;
            $nome = $rs->nomecurso;
            $cargahorariacurso = $rs->cargahorariacurso;
            //$cpf = $rs->cpfusuario;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM tb_cursos WHERE idcurso = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Curso excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
    	echo"<script language='javascript' type='text/javascript'>alert('Existem alunos matriculados no curso selecionado.');
			window.location.href='gerenciacurso.php';</script>";

        //echo "Existem alunos matriculados no curso selecionado.".$erro->getMessage();
    }
}
?>


       
            <form action="?act=save" method="POST" name="form1" >
                <h1></h1>
                <hr>
                <input type="hidden" name="id" <?php
                 
                // Preenche o id no campo id com um valor "value"
                if (isset($id) && $id != null || $id != "") {
                    echo "value=\"{$id}\"";
                }
                ?> />
                Nome do curso:
               <input type="text" name="nome" <?php
 
               // Preenche o nome no campo nome com um valor "value"
               if (isset($nome) && $nome != null || $nome != "") {
                   echo "value=\"{$nome}\"";
               }
               ?> />
               Carga Horaria:
               <input type="text" name="cargahorariacurso" <?php
 
               // Preenche o email no campo email com um valor "value"
               if (isset($cargahorariacurso) && $cargahorariacurso != null || $cargahorariacurso != "") {
                   echo "value=\"{$cargahorariacurso}\"";
               }
               ?> />
                          

               <input type="submit" value="Salvar"/>
               
               <hr>
            </form>

            <table border="1" width="100%">
                <tr>
                    <th>Nome do curso</th>
                    <th>Carga Horaria</th>
                   
                </tr>

                <?php
 
                // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                try {
                    $stmt = $conexao->prepare("SELECT * FROM tb_cursos");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td><center>".$rs->nomecurso."<center></td><td><center>".$rs->cargahorariacurso."<center></td>
                            <td><center><a href=\"?act=del&id=".$rs->idcurso."\">[Excluir]</a></center></td>"
                                       ;
                            echo "</tr>";
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
                ?>
            </table>
			
            <table align="center">
			<tr>
				
				<td><input type="button" value="Voltar" id="Logout" onClick=location.href="validaadm.php" class="btlogin">
			</tr>
			<p>
		</table>
		</fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
		<p><font size="3">Todos direitos reservados a Alex Kubiaki - Mauricio Godoy - Pedro Henrique Schmidt</font></p>
		</div>
		
    </body>
</html>