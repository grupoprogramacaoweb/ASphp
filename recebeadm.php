<body>
  <?php
		/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/
		date_default_timezone_set('America/Sao_Paulo');
		$date = date('Y-m-d H:i');
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
	   
	  $dadosadm   =$_POST; 
	  $nomeadm    =$dados['nomeadm'];	  
	  $usuarioadm =$dados['usuarioadm'];
	  $senhaadm   =$dados['senhaadm'];
	  $cpfadm     =$dados['cpfadm'];
	  $emailadm   =$dados['emailadm'];
	  $enderecoadm=$dados['enderecoadm'];
	  $cidadeadm  =$dados['cidadeadm'];
	  
	  	  
		function jaexiste($valor)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
					
			$query = $conexao->prepare("select * from tb_usuarios_adm where loginusuario = '".$valor."' ");
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
		
			function validacpf($cepefe)   // usei para testar se o cpf ja existe
		{   $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
					
			$query = $conexao->prepare("select * from tb_usuarios_adm where cpfusuario = '".$cepefe."' ");
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
		
		
		
		
		
		
		 $verificacpf=validacpf($cpfadm);
		 $retornado=jaexiste($usuarioadm);
		 
		  if ($retornado==1)
		  {
			  if ($verificacpf==1)
	      	  {
				echo "Registro inserido com sucesso.";
				$query = $conexao->prepare("INSERT INTO tb_usuarios_adm (cpfusuario,nomeusuario,senhausuario,loginusuario,emailusuario,enderecousuario,cidadeusuario) values('$cpfadm','$nomeadm','$senhaadm','$usuarioadm','$emailadm','$enderecoadm','$cidadeadm')");
				$query->execute();
				echo "<a href=\"indexadmin.php\">Retornar a página de login Administrador</a>";    
				//echo "<a href=\"index.php\">Retornar a página de login Usuario</a>";
		      }
			  else
			{
			 echo "<b>Este cpf já está em uso, retorne e refaça seu cadastro com outro número de cpf </b><p>";
			  echo "<a href=\"cadastraadm.html\">Retornar a página de Cadastro</a>";  	
			}
		  }
			else
			{
			  echo "<b>Este nome de usuário já está em uso, retorne e refaça seu cadastro com outro nome de usuário</b><p>";
			  echo "<a href=\"cadastraadm.html\">Retornar a página de Cadastro</a>";  
			}		
			unset($retornado);
    ?>
</body>