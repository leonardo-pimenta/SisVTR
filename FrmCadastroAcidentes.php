<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_TIPO_ACIDENTE"] 	= "Tipo de Acidente";
$_Mascara["NR_FICHA"] 	= "No da Ficha";
$_Mascara["DATA"] 	= "Data";
$_Mascara["LOCAL_RUA"] 	= "Rua";
$_Mascara["LOCAL_NUMERO"] 	= "Número";
$_Mascara["LOCAL_BAIRRO"] 	= "Bairro";
$_Mascara["LOCAL_CIDADE"] 	= "Cidade";
$_Mascara["LOCAL_ESTADO"] 	= "Estado";
$_Mascara["ID_VIATURA"] 	= "Viatura No";
$_Mascara["ID_PEDIDO"] 	= "Pedido No";
$_Mascara["AVARIAS"] 	= "Avarias";
$_Mascara["ODOMETRO"] 	= "Odômetro";

$CodigoPagina = 'FrmCadastroAcidentes';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroAcidentes';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroAcidentes.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_TIPO_ACIDENTE']))
	$TxtID_TIPO_ACIDENTE = VerificaInsercoesMaliciosas($_GET['TxtID_TIPO_ACIDENTE']);
else
	$TxtID_TIPO_ACIDENTE = '';

if (isset($_GET['TxtNR_FICHA']))
	$TxtNR_FICHA = VerificaInsercoesMaliciosas($_GET['TxtNR_FICHA']);
else
	$TxtNR_FICHA = '';

if (isset($_GET['TxtDATA']))
	$TxtDATA = VerificaInsercoesMaliciosas($_GET['TxtDATA']);
else
	$TxtDATA = '';

if (isset($_GET['TxtLOCAL_RUA']))
	$TxtLOCAL_RUA = VerificaInsercoesMaliciosas($_GET['TxtLOCAL_RUA']);
else
	$TxtLOCAL_RUA = '';

if (isset($_GET['TxtLOCAL_NUMERO']))
	$TxtLOCAL_NUMERO = VerificaInsercoesMaliciosas($_GET['TxtLOCAL_NUMERO']);
else
	$TxtLOCAL_NUMERO = '';

if (isset($_GET['TxtLOCAL_BAIRRO']))
	$TxtLOCAL_BAIRRO = VerificaInsercoesMaliciosas($_GET['TxtLOCAL_BAIRRO']);
else
	$TxtLOCAL_BAIRRO = '';

if (isset($_GET['TxtLOCAL_CIDADE']))
	$TxtLOCAL_CIDADE = VerificaInsercoesMaliciosas($_GET['TxtLOCAL_CIDADE']);
else
	$TxtLOCAL_CIDADE = '';

if (isset($_GET['TxtLOCAL_ESTADO']))
	$TxtLOCAL_ESTADO = VerificaInsercoesMaliciosas($_GET['TxtLOCAL_ESTADO']);
else
	$TxtLOCAL_ESTADO = '';

if (isset($_GET['TxtID_VIATURA']))
	$TxtID_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtID_VIATURA']);
else
	$TxtID_VIATURA = '';

if (isset($_GET['TxtODOMETRO']))
	$TxtODOMETRO = VerificaInsercoesMaliciosas($_GET['TxtODOMETRO']);
else
	$TxtODOMETRO = '';

if (isset($_GET['TxtID_PEDIDO']))
	$TxtID_PEDIDO = VerificaInsercoesMaliciosas($_GET['TxtID_PEDIDO']);
else
	$TxtID_PEDIDO = '';

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

if ($TxtID_TIPO_ACIDENTE <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.ID_TIPO_ACIDENTE = '" . $TxtID_TIPO_ACIDENTE . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_TIPO_ACIDENTE"] . " = " . $TxtID_TIPO_ACIDENTE;
	$Argumento = $Argumento . "TxtID_TIPO_ACIDENTE=".$TxtID_TIPO_ACIDENTE . "&";
}

if ($TxtNR_FICHA <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.NR_FICHA = '" . $TxtNR_FICHA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NR_FICHA"] . " = " . $TxtNR_FICHA;
	$Argumento = $Argumento . "TxtNR_FICHA=".$TxtNR_FICHA . "&";
}

if ($TxtDATA <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.DATA = '" . $TxtDATA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA"] . " = " . $TxtDATA;
	$Argumento = $Argumento . "TxtDATA=".$TxtDATA . "&";
}

if ($TxtLOCAL_RUA <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.LOCAL_RUA = '" . $TxtLOCAL_RUA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["LOCAL_RUA"] . " = " . $TxtLOCAL_RUA;
	$Argumento = $Argumento . "TxtLOCAL_RUA=".$TxtLOCAL_RUA . "&";
}

if ($TxtLOCAL_NUMERO <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.LOCAL_NUMERO = '" . $TxtLOCAL_NUMERO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["LOCAL_NUMERO"] . " = " . $TxtLOCAL_NUMERO;
	$Argumento = $Argumento . "TxtLOCAL_NUMERO=".$TxtLOCAL_NUMERO . "&";
}

if ($TxtLOCAL_BAIRRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.LOCAL_BAIRRO = '" . $TxtLOCAL_BAIRRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["LOCAL_BAIRRO"] . " = " . $TxtLOCAL_BAIRRO;
	$Argumento = $Argumento . "TxtLOCAL_BAIRRO=".$TxtLOCAL_BAIRRO . "&";
}

if ($TxtLOCAL_CIDADE <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.LOCAL_CIDADE = '" . $TxtLOCAL_CIDADE . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["LOCAL_CIDADE"] . " = " . $TxtLOCAL_CIDADE;
	$Argumento = $Argumento . "TxtLOCAL_CIDADE=".$TxtLOCAL_CIDADE . "&";
}

if ($TxtLOCAL_ESTADO <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.LOCAL_ESTADO = '" . $TxtLOCAL_ESTADO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["LOCAL_ESTADO"] . " = " . $TxtLOCAL_ESTADO;
	$Argumento = $Argumento . "TxtLOCAL_ESTADO=".$TxtLOCAL_ESTADO . "&";
}

if ($TxtID_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtODOMETRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.ODOMETRO = '" . $TxtODOMETRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
}

if ($TxtID_PEDIDO <> '')
{
	$TxtWhere = $TxtWhere . " AND Acidentes.ID_PEDIDO = '" . $TxtID_PEDIDO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_PEDIDO"] . " = " . $TxtID_PEDIDO;
	$Argumento = $Argumento . "TxtID_PEDIDO=".$TxtID_PEDIDO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Acidentes.ID AS `ID`, Tipo_Acidente.DESCRICAO AS `" . $_Mascara['ID_TIPO_ACIDENTE'] . "`, Acidentes.NR_FICHA AS `" . $_Mascara['NR_FICHA'] . "`, Acidentes.DATA AS `" . $_Mascara['DATA'] . "`  from  Acidentes,Tipo_Acidente where 1=1 AND Acidentes.ID_TIPO_ACIDENTE = Tipo_Acidente.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroAcidentes"," Acidentes ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT ID_TIPO_ACIDENTE,NR_FICHA,DATA,LOCAL_RUA,LOCAL_NUMERO,LOCAL_BAIRRO,LOCAL_CIDADE,LOCAL_ESTADO,ID_VIATURA,ODOMETRO,ID_PEDIDO,AVARIAS  from  Acidentes";
	$NomeForm = "FrmCadastroAcidentes";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_TIPO_ACIDENTE 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO_ACIDENTE']);
		$TxtNR_FICHA 	= VerificaInsercoesMaliciosas($_POST['TxtNR_FICHA']);
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtLOCAL_RUA 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_RUA']);
		$TxtLOCAL_NUMERO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_NUMERO']);
		$TxtLOCAL_BAIRRO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_BAIRRO']);
		$TxtLOCAL_CIDADE 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_CIDADE']);
		$TxtLOCAL_ESTADO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_ESTADO']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtID_PEDIDO 	= VerificaInsercoesMaliciosas($_POST['TxtID_PEDIDO']);
		$TxtAVARIAS 	= VerificaInsercoesMaliciosas($_POST['TxtAVARIAS']);

		$smsecurequery = "Select * from Acidentes where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Acidentes(ID_TIPO_ACIDENTE,NR_FICHA,DATA,LOCAL_RUA,LOCAL_NUMERO,LOCAL_BAIRRO,LOCAL_CIDADE,LOCAL_ESTADO,ID_VIATURA,ODOMETRO,ID_PEDIDO,AVARIAS)
		 VALUES
		 ('" . $TxtID_TIPO_ACIDENTE ."','" . $TxtNR_FICHA ."','" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) ."','" . $TxtLOCAL_RUA ."','" . $TxtLOCAL_NUMERO ."','" . $TxtLOCAL_BAIRRO ."','" . $TxtLOCAL_CIDADE ."','" . $TxtLOCAL_ESTADO ."','" . $TxtID_VIATURA ."','" . $TxtODOMETRO ."','" . $TxtID_PEDIDO ."','" . $TxtAVARIAS ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_TIPO_ACIDENTE 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO_ACIDENTE']);
		$TxtNR_FICHA 	= VerificaInsercoesMaliciosas($_POST['TxtNR_FICHA']);
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtLOCAL_RUA 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_RUA']);
		$TxtLOCAL_NUMERO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_NUMERO']);
		$TxtLOCAL_BAIRRO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_BAIRRO']);
		$TxtLOCAL_CIDADE 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_CIDADE']);
		$TxtLOCAL_ESTADO 	= VerificaInsercoesMaliciosas($_POST['TxtLOCAL_ESTADO']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtID_PEDIDO 	= VerificaInsercoesMaliciosas($_POST['TxtID_PEDIDO']);
		$TxtAVARIAS 	= VerificaInsercoesMaliciosas($_POST['TxtAVARIAS']);

		$strSQL = "Update  Acidentes set 
			ID_TIPO_ACIDENTE			='" . $TxtID_TIPO_ACIDENTE .
			"',NR_FICHA			='" . $TxtNR_FICHA .
			"',DATA			='" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) .
			"',LOCAL_RUA			='" . $TxtLOCAL_RUA .
			"',LOCAL_NUMERO			='" . $TxtLOCAL_NUMERO .
			"',LOCAL_BAIRRO			='" . $TxtLOCAL_BAIRRO .
			"',LOCAL_CIDADE			='" . $TxtLOCAL_CIDADE .
			"',LOCAL_ESTADO			='" . $TxtLOCAL_ESTADO .
			"',ID_VIATURA			='" . $TxtID_VIATURA .
			"',ODOMETRO			='" . $TxtODOMETRO .
			"',ID_PEDIDO			='" . $TxtID_PEDIDO .
			"',AVARIAS			='" . $TxtAVARIAS ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Acidentes    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroAcidentes.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroAcidentes.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroAcidentes.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_TIPO_ACIDENTE,NR_FICHA,DATA,LOCAL_RUA,LOCAL_NUMERO,LOCAL_BAIRRO,LOCAL_CIDADE,LOCAL_ESTADO,ID_VIATURA,ODOMETRO,ID_PEDIDO,AVARIAS  from  Acidentes  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroAcidentes') ;

	echo '<script>document.FrmCadastroAcidentes.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroAcidentes.TxtID_TIPO_ACIDENTE.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroAcidentes.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroAcidentes method=post action=FrmCadastroAcidentes.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Acidentes';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_TIPO_ACIDENTE"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NR_FICHA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_TIPO_ACIDENTE>';
	$strSQL = 'select * from Tipo_Acidente';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtNR_FICHA value="" maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtDATA value="" maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LOCAL_RUA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LOCAL_NUMERO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LOCAL_BAIRRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtLOCAL_RUA value="" maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_NUMERO value="" maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_BAIRRO value="" maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LOCAL_CIDADE"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LOCAL_ESTADO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PEDIDO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtLOCAL_CIDADE value="" maxlength=30 size=30></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_ESTADO value="" maxlength=2 size=2></td>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
	echo '<td class=white><select name=TxtID_PEDIDO>';
	$strSQL = 'select * from Pedido';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["AVARIAS"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><textarea name=TxtAVARIAS rows=10 cols=80></textarea></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroAcidentes)>';
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
	echo '<form name=FrmCadastroAcidentes method=GET action=FrmCadastroAcidentes.php>';
	ExibeTitulo('Pesquisa ->Acidentes');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_TIPO_ACIDENTE"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NR_FICHA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_TIPO_ACIDENTE>';
	$strSQL = 'select * from Tipo_Acidente';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtNR_FICHA maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtDATA maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOCAL_RUA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOCAL_NUMERO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOCAL_BAIRRO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtLOCAL_RUA maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_NUMERO maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_BAIRRO maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOCAL_CIDADE"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOCAL_ESTADO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ODOMETRO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_PEDIDO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtLOCAL_CIDADE maxlength=30 size=30></td>';
	echo '<td class=white><input type=text name=TxtLOCAL_ESTADO maxlength=2 size=2></td>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO maxlength=8 size=8></td>';
	echo '<td class=white><select name=TxtID_PEDIDO>';
	$strSQL = 'select * from Pedido';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
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
