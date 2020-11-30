<?php 
//Carregando fontes TrueType

//imagecreatefromjpeg(filename)

/////////// Verificar se foi enviando dados via POST//////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id2 = (isset($_POST["id2"]) && $_POST["id2"] != null) ? $_POST["id2"] : "";
	$id1 = (isset($_POST["id1"]) && $_POST["id1"] != null) ? $_POST["id1"] : "";
} else if (!isset($id2)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id2 = (isset($_GET["id2"]) && $_GET["id2"] != null) ? $_GET["id2"] : "";
	$id1= (isset($_GET["id1"]) && $_GET["id1"] != null) ? $_GET["id1"] : "";

}
//////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////

	if ($id2 != "") {
     try {
 if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "gera" && $id2 != ""&& $id1 != "") {
        		//header('Location: /index.php');
				
				
				//abaixo

		    $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
			$query = $conexao->prepare("select c.nomecurso as nomedocurso,u.nomeusuario, c.cargahorariacurso as cargahoraria,uc.fkusuario,uc.fkcurso, DATE_FORMAT(uc.data_conclusao,'%d/%m/%Y') as dataconclusao from tb_cursos c inner join tb_usuarios_cursando uc on uc.fkcurso=c.idcurso inner join tb_usuarios u on u.idusuario = uc.fkusuario  where idusuario='$id1' and uc.fkcurso='$id2' and concluido=1");
			$query->execute();
			$retorno =$query->fetch(PDO::FETCH_ASSOC);
 			
			 $nomecurso=$retorno['nomedocurso'] ;
			 $nomeusuario=$retorno['nomeusuario'] ;
		 	 $cargahoraria=$retorno['cargahoraria'] ;
			 $dataconclusao=$retorno['dataconclusao'] ;	
			 
			
//////////////////////////////////////////////////////////////////				
				$image = imagecreatefromjpeg("certificado.jpg");

$titleColor = imagecolorallocate($image, 21, 0, 0);
$gray = imagecolorallocate($image, 100, 100, 100);

$font1= realpath('BevanRegular.ttf');
$font2= realpath('PlayballRegular.ttf');
$LINHA1=$nomeusuario;
$LINHA2=$nomecurso;
$LINHA3=$cargahoraria;
$LINHA4="DE ACORDO COM AS DIRETRIZES DO MEC";
$LINHA5=$dataconclusao;
$TITULO="ESCOLA POLITECNICA GUSMAN";
//imagettftext(image, size, angle, x, y, color, fontfile, text)

imagettftext($image, 22, 0, 140, 250, $titleColor,$font1,"CERTIFICADO DE CONCLUSÃO DE CURSO");
imagettftext($image, 14, 0, 390, 280, $titleColor,$font2,"CERTIFICAMOS QUE");
imagettftext($image, 11, 0, 80, 320, $titleColor,$font1, $LINHA1."   CONCLUIU O CURSO DE   ".$LINHA2."   COM DURAÇÃO DE  ".$LINHA3."  HORAS");
imagettftext($image, 11, 0, 80, 340, $titleColor,$font1,"TORNANDO ASSIM APTO A EXERCER TODA E QUALQUER ATIVIDADE RELACIONADA AO CURSO.");
imagettftext($image, 11, 0, 130, 420, $titleColor,$font1,"CURSO PROFISSIONALIZANTE ".$LINHA4);
imagettftext($image, 30, 0, 190, 150, $titleColor,$font2,$TITULO);
imagettftext($image, 11, 0, 160, 560, $titleColor,$font1,"Assinatura do Diretor da instituição______________________ " );

imagestring($image, 20, 480, 440, utf8_decode("Concluído em: ").$LINHA5,$titleColor);
imagestring($image, 20, 480, 480, utf8_decode("  Emitido em: ").date("d-m-Y"),$titleColor);
 

 header("Content-Type: image/jpeg");

 imagejpeg($image);
 imagejpeg($image, "certificado-".$LINHA1.date("d-m-Y").".jpg");

 imagedestroy($image);
         } 

  

     } catch (PDOException $erro) {
         echo "Erro: ".$erro->getMessage();
   }
 }





?>