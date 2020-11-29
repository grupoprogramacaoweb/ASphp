<?php

session_start();
$id=$_SESSION['iduser'];

try {
    //$conexao = new PDO("mysql:host=localhost;dbname=crudsimples", "root", "123456");
	$conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id2 = (isset($_POST["id2"]) && $_POST["id2"] != null) ? $_POST["id2"] : "";
} else if (!isset($id2)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id2 = (isset($_GET["id2"]) && $_GET["id2"] != null) ? $_GET["id2"] : "";

}

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Cursos Concluidos</title>
            	  	 <link rel="stylesheet" href="css.css">
        </head>
        <body>
        	<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Cursos Concluidos</font></p>
		</div>
            <table border="1" width="100%">
                <tr>
                    <th>Nome</th>
                    <th>Carga Horaria</th>
                    <th>Ações</th>
                </tr>
                <?php

//xxxXXXxX				
	//			if ($id2 != "") {
  //  try {
//if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "updt" && $id2 != "") {
//       		$query = $conexao->prepare("UPDATE tb_usuarios_cursando SET concluido=1 WHERE fkusuario ='$id' and fkcurso='$id2'");
  //          $query->execute();
  //      } 

  

 //   } catch (PDOException $erro) {
 //       echo "Erro: ".$erro->getMessage();
 //   }
//}





				/////XxX///////////////////////////////
								 
                // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                try {
                    $stmt = $conexao->prepare("select c.nomecurso, c.cargahorariacurso,uc.fkusuario,uc.fkcurso from tb_cursos c inner join tb_usuarios_cursando uc on uc.fkcurso=c.idcurso inner join tb_usuarios u on u.idusuario = uc.fkusuario where idusuario=? and concluido=1");
                    $stmt->bindParam(1, $id);
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>".$rs->nomecurso."</td><td>".$rs->cargahorariacurso."</td><td><center>"
							    ."<a href=\"?act=updt&id2=".$rs->fkcurso."\">[Imprimir certificado]</a></center></td>";
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

            <br><br>
            <center><input type="button" value="Voltar" id="voltar" onClick=location.href="valida.php" class="btlogin">
            	</center>
				<div style="background-color:#B0E0E6;text-align:center">
		<p><font size="3">Todos direitos reservados a Alex Kubiaki - Mauricio Godoy - Pedro Henrique Schmidt</font></p>
		</div>
        </body>
    </html>