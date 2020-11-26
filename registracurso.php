<?php
		/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/
		date_default_timezone_set('America/Sao_Paulo');
		$date = date('Y-m-d H:i');

		session_start();
		session_destroy();

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
	   

	  $dados   =$_POST; 
	  $curso 	=$dados['idcurso'];
	  $nome    =1;	
	
	  var_dump($curso);
	  var_dump($nome);

		echo "Registro inserido com sucesso.";
			$query = $conexao->prepare("INSERT INTO tb_usuarios_cursando (fkcurso, fkusuario) values('$curso','$nome')");
			$query->execute();	
   	?>

