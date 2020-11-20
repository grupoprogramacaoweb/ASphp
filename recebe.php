<body>
  <?php
		/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/
		date_default_timezone_set('America/Sao_Paulo');
		$date = date('Y-m-d H:i');
try {
 		//conexao
			//$conexao =new mysqli("localhost","root","","banco");	 ///*mysql usa essa conexão*///
			  $conexao = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root"); 
	    //conexao
  
	} 
	catch (PDOException $e)
	{
		echo 'Falha na conexão: ' . $conexao->getMessage();
	}
	   
	  $dados =$_POST;   
	  $usuario=$dados['usuario'];
	  $senha=$dados['senha'];
	  
		function jaexiste($valor)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root");
			//$query = "select * from tbusuarios where usuario = '".$valor."' ";
			
			$query = $conexao->prepare("select * from tb_usuarios where login = '".$valor."' ");
			$query->execute();
			$retorno = $query->rowCount();

			if ($retorno != 0)
			  {
				return $resultado=0;
			  }
			else
			{
			 return $resultado=1;
			}
		}
		
		 $retornado=jaexiste($usuario);
		 
		  if ($retornado==1)
		  {
			echo "Registro inserido com sucesso.";
			$query = $conexao->prepare("INSERT INTO tb_usuarios (login,senha) values('$usuario','$senha')");
			$query->execute();
			echo "<a href=\"index.php\">Retornar a página de login</a>";    
		   }
			else
			{
			  echo "<b>Este nome de usuário já está em uso, retorne e refaça seu cadastro com outro nome de usuário</b><p>";
			  echo "<a href=\"cadastra.html\">Retornar a página de Cadastro</a>";  
			}		
			unset($retornado);
    ?>
</body>