<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_VIATURA"] 	= "Viatura No";
$_Mascara["DATA"] 	= "Data";
$_Mascara["HORA"] 	= "Hora";
$_Mascara["ODOMETRO"] 	= "Odômetro";
$_Mascara["TP_COMBUSTIVEL"] 	= "Tipo de Combustível";
$_Mascara["QTD_COMBUSTIVEL"] 	= "Qnt. de Combustível";
$_Mascara["ID_LOCAL_ABASTEC"] 	= "Local do Abastecimento";
$_Mascara["RESPONSAVEL"] 	= "Responsável";
$_Mascara["NIP"] 	= "NIP";
$_Mascara["IDENTIDADE"] 	= "Identidade";
$_Mascara["VALOR_LITRO"] 	= "Valor por Litro";
$_Mascara["VALOR_TOTAL"] 	= "Valor Total";

$CodigoPagina = 'FrmCadastroAbastecimento';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroAbastecimento';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

?>

<script language=javascript type="text/javascript">

	function FormatNumber(expr, decplaces) {

		var str = "" + Math.round(eval(expr) * Math.pow(10,decplaces));

		while (str.length <= decplaces) {
			str = "0" + str;
		}

		var decpoint = str.length - decplaces;

		return str.substring(0,decpoint) + "." + str.substring(decpoint, str.length);
	} //End function FormatNumber

	function CalculaPrecoLitro(PRECO,TIPO,Quantidade,Valor){

<?php
	$strSQL = 'select * from Tipo_combustivel';
	$smsecurers = mysql_query($strSQL);
	$Contador = @mysql_affected_rows();
	for ($t = 1; $t <= $Contador; $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo "if(TIPO.value == " . $row['ID'] . "){";
		echo "PRECO.value = " . $row['VALOR'] . ";";
		echo "}";
	}
?>
	CalculaValor(PRECO,Quantidade,Valor);
	}
	function CalculaValor(Preco,Quantidade,Valor){
		if (Quantidade.value != "")
		{
			Quantidade.value = parseInt(Quantidade.value);
		}
		if (Quantidade.value < 0)
		{
			Quantidade.value = "0";
		}
		if (isNaN(Quantidade.value))
		{
			Total.value = "0.0000";
			alert("Não é numérico!");
		}
		else
		{
			Valor.value = FormatNumber(Quantidade.value * Preco.value, 3);
		}
	}
</script>

<?php
echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroAbastecimento.php?Pesquisa=S>Pesquisar</A>';
}
echo '</td>';
echo '<td class=Branco width=50 align=right>';
echo '<a href=default.php>Voltar</A></td>';
echo '</tr></table>';

if (isset($_POST['TxtTipoFormulario']))
	$TxtTipoFormulario = VerificaInsercoesMaliciosas($_POST['TxtTipoFormulario']);
else
	$TxtTipoFormulario = '';

if (isset($_GET['TxtOpcao']))
	$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
else
	$TxtOpcao = '';

if (!$TxtTipoFormulario == '')
{
	if ($TxtTipoFormulario == 'A')
		ProcessaAlteracao($_Mascara);
	if ($TxtTipoFormulario == 'D')
		ProcessaExclusao($_Mascara);
	if ($TxtTipoFormulario == 'I')
		ProcessaInclusao($_Mascara);
}
else
{
	if (!$TxtOpcao == '')
	{
		CriaFormulario($_Mascara);
		if ($TxtOpcao == 'A' or $TxtOpcao == 'V')
			EnviaAlteracao();
		if ($TxtOpcao == 'D')
			EnviaExclusao();
		if ($TxtOpcao == 'I')
			EnviaInclusao();
		sair();
	}
}

if (isset($_GET['TxtID_VIATURA']))
	$TxtID_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtID_VIATURA']);
else
	$TxtID_VIATURA = '';

if (isset($_GET['TxtDATA']))
	$TxtDATA = VerificaInsercoesMaliciosas($_GET['TxtDATA']);
else
	$TxtDATA = '';

if (isset($_GET['TxtHORA']))
	$TxtHORA = VerificaInsercoesMaliciosas($_GET['TxtHORA']);
else
	$TxtHORA = '';

if (isset($_GET['TxtODOMETRO']))
	$TxtODOMETRO = VerificaInsercoesMaliciosas($_GET['TxtODOMETRO']);
else
	$TxtODOMETRO = '';

if (isset($_GET['TxtTP_COMBUSTIVEL']))
	$TxtTP_COMBUSTIVEL = VerificaInsercoesMaliciosas($_GET['TxtTP_COMBUSTIVEL']);
else
	$TxtTP_COMBUSTIVEL = '';

if (isset($_GET['TxtQTD_COMBUSTIVEL']))
	$TxtQTD_COMBUSTIVEL = VerificaInsercoesMaliciosas($_GET['TxtQTD_COMBUSTIVEL']);
else
	$TxtQTD_COMBUSTIVEL = '';

if (isset($_GET['TxtID_LOCAL_ABASTEC']))
	$TxtID_LOCAL_ABASTEC = VerificaInsercoesMaliciosas($_GET['TxtID_LOCAL_ABASTEC']);
else
	$TxtID_LOCAL_ABASTEC = '';

if (isset($_GET['TxtLinhas']))
	$TxtLinhas = VerificaInsercoesMaliciosas($_GET['TxtLinhas']);
else
	$TxtLinhas = '';

if (isset($_GET['Limite']))
	$Limite = VerificaInsercoesMaliciosas($_GET['Limite']);
else
	$Limite = '';

if (isset($_GET['TotalGeral']))
	$TotalGeral = VerificaInsercoesMaliciosas($_GET['TotalGeral']);
else
	$TotalGeral = '';

if (isset($_GET['Totalizador']))
	$Totalizador = VerificaInsercoesMaliciosas($_GET['Totalizador']);
else
	$Totalizador = '';

$MsgTxtWhere = '';
$TxtWhere = '';
$Argumento = '';

if ($TxtID_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtDATA <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.DATA = '" . $TxtDATA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA"] . " = " . $TxtDATA;
	$Argumento = $Argumento . "TxtDATA=".$TxtDATA . "&";
}

if ($TxtHORA <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.HORA = '" . $TxtHORA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["HORA"] . " = " . $TxtHORA;
	$Argumento = $Argumento . "TxtHORA=".$TxtHORA . "&";
}

if ($TxtODOMETRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.ODOMETRO = '" . $TxtODOMETRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
}

if ($TxtTP_COMBUSTIVEL <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.TP_COMBUSTIVEL = '" . $TxtTP_COMBUSTIVEL . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["TP_COMBUSTIVEL"] . " = " . $TxtTP_COMBUSTIVEL;
	$Argumento = $Argumento . "TxtTP_COMBUSTIVEL=".$TxtTP_COMBUSTIVEL . "&";
}

if ($TxtQTD_COMBUSTIVEL <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.QTD_COMBUSTIVEL = '" . $TxtQTD_COMBUSTIVEL . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["QTD_COMBUSTIVEL"] . " = " . $TxtQTD_COMBUSTIVEL;
	$Argumento = $Argumento . "TxtQTD_COMBUSTIVEL=".$TxtQTD_COMBUSTIVEL . "&";
}

if ($TxtID_LOCAL_ABASTEC <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.ID_LOCAL_ABASTEC = '" . $TxtID_LOCAL_ABASTEC . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_LOCAL_ABASTEC"] . " = " . $TxtID_LOCAL_ABASTEC;
	$Argumento = $Argumento . "TxtID_LOCAL_ABASTEC=".$TxtID_LOCAL_ABASTEC . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Abastecimento.ID AS `ID`, Viatura.ID AS `" . $_Mascara['ID_VIATURA'] . "`, Abastecimento.DATA AS `" . $_Mascara['DATA'] . "`, Abastecimento.HORA AS `" . $_Mascara['HORA'] . "`, Abastecimento.ODOMETRO AS `" . $_Mascara['ODOMETRO'] . "`, Tipo_combustivel.DESCRICAO AS `" . $_Mascara['TP_COMBUSTIVEL'] . "`, Abastecimento.QTD_COMBUSTIVEL AS `" . $_Mascara['QTD_COMBUSTIVEL'] . "`, Local_Abastc.DESCRICAO AS `" . $_Mascara['ID_LOCAL_ABASTEC'] . "`  from  Abastecimento,Viatura,Local_Abastc, Tipo_combustivel where Tipo_combustivel.ID = Abastecimento.TP_COMBUSTIVEL AND Abastecimento.ID_VIATURA = Viatura.ID AND Abastecimento.ID_LOCAL_ABASTEC = Local_Abastc.ID " . $TxtWhere ;

if ($_ENV['Relatorio'] == 0)
{
	$Linhas =$_SESSION['LinhasImpressora'];
	$Pagina = 1;
}
else
{
	$Linhas =0;
	$Pagina = 0;
}

if ($_GET['Pesquisa'] == 'S')
{
	FormularioPesquisa($_Mascara);
}

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroAbastecimento"," Abastecimento ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_VIATURA,DATA,HORA,ODOMETRO,TP_COMBUSTIVEL,QTD_COMBUSTIVEL,ID_LOCAL_ABASTEC,RESPONSAVEL,NIP,IDENTIDADE,VALOR_LITRO,VALOR_TOTAL  from  Abastecimento";
	$NomeForm = "FrmCadastroAbastecimento";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 					= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 			= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDATA 				= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtHORA 				= VerificaInsercoesMaliciosas($_POST['TxtHORA']);
		$TxtODOMETRO 			= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtTP_COMBUSTIVEL 		= VerificaInsercoesMaliciosas($_POST['TxtTP_COMBUSTIVEL']);
		$TxtQTD_COMBUSTIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtQTD_COMBUSTIVEL']);
		$TxtID_LOCAL_ABASTEC 	= VerificaInsercoesMaliciosas($_POST['TxtID_LOCAL_ABASTEC']);
		$TxtRESPONSAVEL 		= VerificaInsercoesMaliciosas($_POST['TxtRESPONSAVEL']);
		$TxtNIP 				= VerificaInsercoesMaliciosas($_POST['TxtNIP']);
		$TxtIDENTIDADE 			= VerificaInsercoesMaliciosas($_POST['TxtIDENTIDADE']);
		$TxtVALOR_LITRO 		= VerificaInsercoesMaliciosas($_POST['TxtVALOR_LITRO']);
		$TxtVALOR_TOTAL 		= VerificaInsercoesMaliciosas($_POST['TxtVALOR_TOTAL']);

		$smsecurequery = "Select * from Abastecimento where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Abastecimento(ID_VIATURA,DATA,HORA,ODOMETRO,TP_COMBUSTIVEL,QTD_COMBUSTIVEL,ID_LOCAL_ABASTEC,RESPONSAVEL,NIP,IDENTIDADE,VALOR_LITRO,VALOR_TOTAL)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) ."','" . $TxtHORA ."','" . $TxtODOMETRO ."','" . $TxtTP_COMBUSTIVEL ."','" . $TxtQTD_COMBUSTIVEL ."','" . $TxtID_LOCAL_ABASTEC ."','" . $TxtRESPONSAVEL ."','" . $TxtNIP ."','" . $TxtIDENTIDADE ."','" . $TxtVALOR_LITRO . "','" . $TxtVALOR_TOTAL . "')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 					= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 			= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDATA 				= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtHORA 				= VerificaInsercoesMaliciosas($_POST['TxtHORA']);
		$TxtODOMETRO 			= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtTP_COMBUSTIVEL 		= VerificaInsercoesMaliciosas($_POST['TxtTP_COMBUSTIVEL']);
		$TxtQTD_COMBUSTIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtQTD_COMBUSTIVEL']);
		$TxtID_LOCAL_ABASTEC 	= VerificaInsercoesMaliciosas($_POST['TxtID_LOCAL_ABASTEC']);
		$TxtRESPONSAVEL		 	= VerificaInsercoesMaliciosas($_POST['TxtRESPONSAVEL']);
		$TxtNIP 				= VerificaInsercoesMaliciosas($_POST['TxtNIP']);
		$TxtIDENTIDADE 			= VerificaInsercoesMaliciosas($_POST['TxtIDENTIDADE']);
		$TxtVALOR_LITRO 		= VerificaInsercoesMaliciosas($_POST['TxtVALOR_LITRO']);
		$TxtVALOR_TOTAL 		= VerificaInsercoesMaliciosas($_POST['TxtVALOR_TOTAL']);

		$strSQL = "Update  Abastecimento set
			ID_VIATURA				='" . $TxtID_VIATURA .
			"',DATA					='" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) .
			"',HORA					='" . $TxtHORA .
			"',ODOMETRO				='" . $TxtODOMETRO .
			"',TP_COMBUSTIVEL		='" . $TxtTP_COMBUSTIVEL .
			"',QTD_COMBUSTIVEL		='" . $TxtQTD_COMBUSTIVEL .
			"',ID_LOCAL_ABASTEC		='" . $TxtID_LOCAL_ABASTEC .
			"',RESPONSAVEL			='" . $TxtRESPONSAVEL .
			"',VALOR_LITRO			='" . $TxtVALOR_LITRO .
			"',VALOR_TOTAL			='" . $TxtVALOR_TOTAL .
			"',NIP					='" . $TxtNIP .
			"',IDENTIDADE			='" . $TxtIDENTIDADE ."'  where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());
	}
	else
	{
		echo '<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>';
	}
}

function ProcessaExclusao($_Mascara)
{

	$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
	$strSQL = "delete from  Abastecimento    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroAbastecimento.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroAbastecimento.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroAbastecimento.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,DATA,HORA,ODOMETRO,TP_COMBUSTIVEL,QTD_COMBUSTIVEL,ID_LOCAL_ABASTEC,RESPONSAVEL,NIP,IDENTIDADE,VALOR_LITRO,VALOR_TOTAL  from  Abastecimento  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroAbastecimento') ;

	echo '<script>document.FrmCadastroAbastecimento.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroAbastecimento.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroAbastecimento.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroAbastecimento method=post action=FrmCadastroAbastecimento.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Abastecimento';

	if ($TxtOpcao == 'A')
		$Titulo = $Titulo . ' - Alteração';
	if ($TxtOpcao == 'D')
		$Titulo = $Titulo . ' - Exclusão';
	if ($TxtOpcao == 'I')
		$Titulo = $Titulo . ' - Inclusão';
	echo '</td></tr>';
	ExibeTitulo($Titulo);	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["HORA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	if($TxtOpcao=="I")
	{
		echo "<td class=white><input type=text name=TxtDATA value='" . date(d) ."/" . date(m) . "/" . date(Y) . "' maxlength=10 size=10></td>";
		echo "<td class=white><input type=text name=TxtHORA value='" . date(H) .":" . date(i) . ":" . date(s) . "' maxlength=8 size=8></td>";
	}
	else
	{
		echo "<td class=white><input type=text name=TxtDATA value='' maxlength=10 size=10></td>";
		echo "<td class=white><input type=text name=TxtHORA value='' maxlength=8 size=8></td>";
	}
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["TP_COMBUSTIVEL"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["QTD_COMBUSTIVEL"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["VALOR_LITRO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["VALOR_TOTAL"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_LOCAL_ABASTEC"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtTP_COMBUSTIVEL onChange="CalculaPrecoLitro(TxtVALOR_LITRO,TxtTP_COMBUSTIVEL,TxtQTD_COMBUSTIVEL,TxtVALOR_TOTAL)">';
	$strSQL = 'select * from Tipo_combustivel';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
		if($t==1)
			$PrecoPrimeiraTela = $row["VALOR"];
	}
	echo '</select></td>';

	echo '<td class=white><input type=text name=TxtQTD_COMBUSTIVEL value="" maxlength=5 size=5 onChange="CalculaValor(TxtVALOR_LITRO,TxtQTD_COMBUSTIVEL,TxtVALOR_TOTAL)"></td>';
	echo '<td class=white><input type=text name=TxtVALOR_LITRO value="' . $PrecoPrimeiraTela . '" maxlength=6 size=6 onBlur="CalculaPrecoLitro(TxtVALOR_LITRO,TxtTP_COMBUSTIVEL,TxtQTD_COMBUSTIVEL,TxtVALOR_TOTAL)"></td>';
	echo '<td class=white><input type=text name=TxtVALOR_TOTAL value="" maxlength=6 size=6 onBlur="CalculaPrecoLitro(TxtVALOR_LITRO,TxtTP_COMBUSTIVEL,TxtQTD_COMBUSTIVEL,TxtVALOR_TOTAL)"></td>';
	echo '<td class=white><select name=TxtID_LOCAL_ABASTEC>';
	$strSQL = 'select * from Local_Abastc';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];
	echo $_SESSION['AbreMoldura'];
		echo '<tr>';
		echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["RESPONSAVEL"] . '</b></font></td>';
		echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NIP"] . '</b></font></td>';
		echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["IDENTIDADE"] . '</b></font></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class=white><input type=text name=TxtRESPONSAVEL value="" maxlength=50 size=50></td>';
		echo '<td class=white><input type=text name=TxtNIP value="" maxlength=9 size=9></td>';
		echo '<td class=white><input type=text name=TxtIDENTIDADE value="" maxlength=9 size=9></td>';
		echo '</tr>';
		echo $_SESSION['FechaMoldura'];


	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white>';
	if ($_GET['TxtOpcao'] == 'V')
	{
		echo '<input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()>';
	}
	else
	{
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroAbastecimento)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()>';
	}
	echo '</td></tr>';
	echo $_SESSION['FechaMoldura'];

	echo '</form>';
}
function FormataNumero($Texto, $Quantidade)
{
	if ($Quantidade == strlen(trim($Texto)))
		return $Texto;
	for ($i=0; $i<=($Quantidade - strlen(trim($Texto))); $i++)
	{
		$Texto = '0' . $Texto;
	}
	return $Texto;
}
function FormularioPesquisa($_Mascara)
{
	echo '<form name=FrmCadastroAbastecimento method=GET action=FrmCadastroAbastecimento.php>';
	ExibeTitulo('Pesquisa ->Abastecimento');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["HORA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ODOMETRO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtDATA maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtHORA maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO maxlength=8 size=8></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["QTD_COMBUSTIVEL"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_LOCAL_ABASTEC"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtQTD_COMBUSTIVEL maxlength=22 size=22></td>';
	echo '<td class=white><select name=TxtID_LOCAL_ABASTEC>';
	$strSQL = 'select * from Local_Abastc';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white align=center>Linhas Por Página:<input type=text name=TxtLinhas maxlength=4 size=4 value=' . $_ENV['TotalMaximoPorTela'] . '></td>';
	echo '<td class=white align=center>';
	echo '<input type=Submit name=Submit value=Pesquisar>';
	echo '</td></tr>';
	echo $_SESSION['FechaMoldura'];

	echo '</form>';
}
mysql_close($link) ;
?>
</body>
</HTML>
