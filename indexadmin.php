<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Formulário de Login</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<body>
  <form action="validaadm.php" method="POST">
	<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Sistema de Login - Adminstrador</font></p>
		</div>
		
		<br>
		
		<table align="center">
			<tr>
				<td>Login:<input type=text id="usuario" name="usuario" required>
			</tr>
			
			<tr>
				<td>Senha:<input type=password id="senha" name="senha" required>
			</tr>
		</table>
		 <table align="center">
			<tr>
				<td><input type="submit" value="Continuar" id="continuar" class="btlogin">
				<td><input type="reset" value="Limpar" class="btlogin">
				<td><input type="button" value="Criar Conta" id="criaconta" onClick=location.href="cadastraadm.html" class="btlogin">
				<td><input type="button" value="Home" id="voltar" onClick=location.href="index.php" class="btlogin">
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