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
		<div style="background-color:#B0E0E6;text-align:center">
		<?php
 
 session_start();
 
 	function jaestoumatriculado($cur,$user)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
			$query = $conexao->prepare("select count(*)  as num from tb_usuarios_cursando where fkusuario = '$user' and fkcurso ='$cur' ");
			$query->execute();
			$retorno =$query->fetch(PDO::FETCH_ASSOC);
 			
			if ($retorno['num'] >1)
				{
					//echo"retornou 111111";
					return 1;
				}
			else		 
			{
				//echo"retornou 0000000";
              return 0;
			}
		}

 if(isset($_SESSION['nomedouser']))
	{
		echo "Usuário Logado: ".$_SESSION['nomedouser'];

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
</div>
		<br>
		
		<table align="center">



<!DOCTYPE html>

<html>
	<head>
		<title> Cursos </title>
		<meta charset="utf-8">
	</head>
	<body>

		<form action="escolhecurso.php" method="POST">
		  <div style="background-color:#B0E0E6;text-align:center">
		      Escolha abaixo o curso desejado
 
			<p><select name="selectCursos" >
			<option>Cursos</option></p>
		</div>
			
		


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

			 
				if(isset($_POST['selectCursos']))$curso=$_POST['selectCursos'];
	  			$id=$_SESSION['iduser'];

 

				  if(isset($curso))	if ($curso>0)
					   {
						   jaestoumatriculado($curso,$id);
	  				if (jaestoumatriculado($curso,$id)==0)
					{						
					 echo "Matricula inserida com sucesso.";
					$query = $conexao->prepare("INSERT INTO tb_usuarios_cursando (fkcurso, fkusuario) values('$curso','$id')");
					$query->execute();
					}
					else {
					 echo "Você já está matriculado neste curso";	
					}
					}
			else{

				echo "<b>selecione um curso</b><p>";
			}
	jaestoumatriculado($curso,$id)
				?>
</table>
		 <table align="center">
			<tr>
				<td><input type="submit" name="btnCadUsuario" value="RealizarCadastro" class="botaoEnviar">
				<td><input type="button" value="Retornar" id="Retorna" onClick=location.href="valida.php" class="botaoEnviar">
			</tr>
			<p>
		</table>

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









