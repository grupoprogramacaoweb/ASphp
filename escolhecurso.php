<?php
 
include_once ("pdo.php")
?>

<!DOCTYPE html>

<html>
	<head>
		<title> Cursos </title>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="registracurso.php" method="POST">
		<select name="select Cursos">
			<option>Cursos</option>
		<?php

		try {
 		//conexao
			//$conexao =new mysqli("localhost","root","","banco");	 ///*mysql usa essa conexão*///
			  $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
	    //conexao
  
		} 
		catch (PDOException $e)
		{
		echo 'Falha na conexão: ' . $conexao->getMessage();
		}

		/*$result_cursos = "select * from tb_cursos";*/
		session_start();
		$data = array();
		$result = $conexao->query("select * from tb_cursos");

		while ($registros = $result->fetch(PDO::FETCH_ASSOC)){?>

			<option value="<?php echo $registros['idcurso']; ?>">

				<?php 

					echo $registros['nomecurso'],"  ";
					echo $registros['cargahorariacurso'],"h";

				?>
				
			</option> <?php
		}
		?>

				</select><br><br><br>

				<?php

				//$conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");

				//$dados=$_POST; 
	  			//$curso=$dados['idcurso'];
	  			//$usuario=1;
	  			//$dados['nome']	


	  			//var_dump($curso);
	  			//var_dump($usuario);

	  			//echo "Registro inserido com sucesso.";
				//$query = $conexao->prepare("INSERT INTO tb_usuarios_cursando (fkcurso, fkusuario) values('$curso','$usuario')");
				//$query->execute();
	
				?>

			<input type="submit" name="botao" value="Realizar Cadastro" class="botaoEnviar">

		</form>
	</body>

</html>
