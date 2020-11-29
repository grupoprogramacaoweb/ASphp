<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Portal do Aluno</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<body>

	<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Portal do Aluno</font></p>
		</div>
		
		<br>
		
		  <?php  
/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/



 

session_start();
 

if(isset($_POST['usuario'])) $login = $_POST['usuario'];
if(isset($_POST['senha']))   $senha = $_POST['senha'];


if(isset($_SESSION['verificador']))	if ($_SESSION['verificador']==1)
		{
		
		echo " <div align='center'><p><b><font size='10'>Bem vindo aluno*:".$_SESSION['nomedouser']."</font></b></p> </div>";
		}

if(empty($_SESSION['verificador']))
{
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
		
	function encontrou($log,$pass)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
			$query = $conexao->prepare("select count(*)  as num from tb_usuarios where loginusuario = '$log' and senhausuario ='$pass' ");
			$query->execute();
			$retorno =$query->fetch(PDO::FETCH_ASSOC);
 			
			if ($retorno['num'] ==1)
				{
					return 1;
				}
			else		 
			{
              return 0;
			}
		}	
		
		
		
	 	$linhas=encontrou($login,$senha);	
	
	    $result = $conexao->query("select * from tb_usuarios where loginusuario='$login' and senhausuario='$senha'");
	
	if($linhas==1)
		{ 

			$data = array();
			while ($registros = $result->fetch(PDO::FETCH_ASSOC))

				{
					
					$_SESSION['nomedouser'] = $registros["nomeusuario"];
					$_SESSION['iduser']     = $registros["idusuario"];
					$_SESSION['verificador']=1;
					echo " <div align='center'><p><b><font size='10'>Bem vindo aluno:".$_SESSION['nomedouser']."</font></b></p> </div>";
				}
		}       
		else
		{
		 echo"<script language='javascript' type='text/javascript'>alert('Nome de usuário ou senha Inválida');
			window.location.href='index.php';</script>";
		}
echo "<p>";
}
	
?>

		<table align="center">
			<tr>


		</table>
		 <table align="center">
			<tr>
				<td><input type="button" value="Matricule-se" id="Escolhe Cursos" onClick=location.href="escolhecurso.php" class="btlogin">
				<td><input type="button" value="Minhas matriculas" id="Logout" onClick=location.href="mostrarcursos.php" class="btlogin">
				<td><input type="button" value="Cursos concluidos" id="Logout" onClick=location.href="concluidos.php" class="btlogin">
				<td><input type="button" value="Logout" id="Logout" onClick=location.href="logout.php" class="btlogin">
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