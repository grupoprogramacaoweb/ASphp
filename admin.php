<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Formulário de Login</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<body>
  <form action="valida.php" method="POST">
	<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Sistema de login</font></p>
		</div>
		
		<br>
		
		<table align="center">
			<tr>
				<td>Nome Curso:<input type=text id="nomecurso" name="nomecurso" required>
			</tr>
			
			<tr>
				<td>Carga Horaria:<input type=password id="cargahoraria" name="cargahoraria" required>
			</tr>
		</table>

		 <table align="center">
			<tr>
				<td><input type="submit" value="Cadastrar" id="cadastrar" class="btcadastrar">
				<td><input type="reset" value="Limpar" class="btlimpar">
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