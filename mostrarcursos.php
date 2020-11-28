<?php
 session_start();
//echo "hello word";

 $id=$_SESSION['iduser'];
 
try {
    //$conexao = new PDO("mysql:host=localhost;dbname=crudsimples", "root", "123456");
	$conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Agenda de contatos</title>
        </head>
        <body>
            <table border="1" width="100%">
                <tr>
                    <th>Nome</th>
                    <th>Carga Horaria</th>
                    <th>Ações</th>
                </tr>
                <?php
 
                // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                try {
                    $stmt = $conexao->prepare("select c.nomecurso, c.cargahorariacurso,uc.fkusuario from tb_cursos c inner join tb_usuarios_cursando uc on uc.fkcurso=c.idcurso inner join tb_usuarios u on u.idusuario = uc.fkusuario where idusuario=$id");
                    //$stmt->bindParam(1, 1);
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>".$rs->nomecurso."</td><td>".$rs->cargahorariacurso."</td><td><center><a href=\"?act=upd&id=".$rs->fkusuario."\">[Alterar]</a>"
                                       ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                       ."<a href=\"?act=del&id=".$rs->fkusuario."\">[Excluir]</a></center></td>";
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
        </body>
    </html>