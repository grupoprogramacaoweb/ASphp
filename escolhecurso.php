<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Portal do Aluno-> Escolha de cursos</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<body>
  <form action="escolhecurso.php" method="POST">
	<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Escolha de cursos</font></p>
		</div>
		
		<br>
		
		<table align="center">

<?php
 
 session_start();

 if(isset($_SESSION['iduser']))
	{
		echo "Usuário Logado: ".$_SESSION['iduser'];
		echo "<p>";
		echo "<a href=\"logout.php\">Logout</a>";
	}
  else
	{
	 echo "Nenhum usuário logado";
	}
//session_destroy();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
//include_once ("pdo.php");
//$_SESSION['nomedouser']=1;
//var_dump($_SESSION);

?>

<!DOCTYPE html>

<html>
	<head>
		<title> Cursos </title>
		<meta charset="utf-8">
	</head>
	<body>

		<form action="escolhecurso.php" method="POST">

			
		<select name="selectCursos">
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


	while ($registros = $result->fetch(PDO::FETCH_ASSOC)){
		session_start();

		
			?>

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

				$conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");

				$result = $conexao->query("select * from tb_usuarios");

				$registros = $result->fetch(PDO::FETCH_ASSOC);

			; 
				$curso=$_POST['selectCursos'];
	  			$id=$_SESSION['iduser'];

	  	if ($curso>0) {
	  					  			
	  			 echo "Registro inserido com sucesso.";
				$query = $conexao->prepare("INSERT INTO tb_usuarios_cursando (fkcurso, fkusuario) values('$curso','$id')");
				$query->execute();
			}else{

				echo "<b>selecione um curso</b><p>";
			}
	
				?>

			<input type="submit" name="btnCadUsuario" value="RealizarCadastro" class="botaoEnviar">

		</form>
	</body>

</html>


		</table>
		 <table align="center">
			<tr>
			
			</tr>
			<p>
		</table>
		<br>
	</fieldset>
 </form>
 
	<div style="background-color:#B0E0E6;text-align:center">
		<p><font size="3">Todos direitos reservados a Alex Kubiaki - Mauricio Godoy - Pedro Henrique Schmidt</font></p>
	</div>
	</body>
</html>









