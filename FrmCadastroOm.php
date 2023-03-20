<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - S�BADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["CODIGO"] 	= "C�digo";
$_Mascara["SIGLA"] 	= "Sigla";
$_Mascara["DESCRICAO"] 	= "Descri��o";

$CodigoPagina = 'FrmCadastroOm';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroOm';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroOm.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtCODIGO']))
	$TxtCODIGO = VerificaInsercoesMaliciosas($_GET['TxtCODIGO']);
else
	$TxtCODIGO = '';

if (isset($_GET['TxtSIGLA']))
	$TxtSIGLA = VerificaInsercoesMaliciosas($_GET['TxtSIGLA']);
else
	$TxtSIGLA = '';

if (isset($_GET['TxtDESCRICAO']))
	$TxtDESCRICAO = VerificaInsercoesMaliciosas($_GET['TxtDESCRICAO']);
else
	$TxtDESCRICAO = '';

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

if ($TxtCODIGO <> '')
{
	$TxtWhere = $TxtWhere . " AND Om.CODIGO = '" . $TxtCODIGO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["CODIGO"] . " = " . $TxtCODIGO;
	$Argumento = $Argumento . "TxtCODIGO=".$TxtCODIGO . "&";
}

if ($TxtSIGLA <> '')
{
	$TxtWhere = $TxtWhere . " AND Om.SIGLA LIKE '%" . $TxtSIGLA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["SIGLA"] . " = " . $TxtSIGLA;
	$Argumento = $Argumento . "TxtSIGLA=".$TxtSIGLA . "&";
}

if ($TxtDESCRICAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Om.DESCRICAO LIKE '%" . $TxtDESCRICAO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESCRICAO"] . " = " . $TxtDESCRICAO;
	$Argumento = $Argumento . "TxtDESCRICAO=".$TxtDESCRICAO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Om.ID AS `ID`, Om.CODIGO AS `" . $_Mascara['CODIGO'] . "`, Om.SIGLA AS `" . $_Mascara['SIGLA'] . "`, Om.DESCRICAO AS `" . $_Mascara['DESCRICAO'] . "`  from  Om where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroOm"," OM ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT CODIGO,SIGLA,DESCRICAO  from  Om";
	$NomeForm = "FrmCadastroOm";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtCODIGO 	= VerificaInsercoesMaliciosas($_POST['TxtCODIGO']);
		$TxtSIGLA 	= VerificaInsercoesMaliciosas($_POST['TxtSIGLA']);
		$TxtDESCRICAO 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO']);

		$smsecurequery = "Select * from Om where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>J� existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Om(CODIGO,SIGLA,DESCRICAO)
		 VALUES
		 ('" . $TxtCODIGO ."','" . $TxtSIGLA ."','" . $TxtDESCRICAO ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtCODIGO 	= VerificaInsercoesMaliciosas($_POST['TxtCODIGO']);
		$TxtSIGLA 	= VerificaInsercoesMaliciosas($_POST['TxtSIGLA']);
		$TxtDESCRICAO 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO']);

		$strSQL = "Update  Om set 
			CODIGO			='" . $TxtCODIGO .
			"',SIGLA			='" . $TxtSIGLA .
			"',DESCRICAO			='" . $TxtDESCRICAO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Om    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroOm.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroOm.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroOm.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,CODIGO,SIGLA,DESCRICAO  from  Om  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroOm') ;

	echo '<script>document.FrmCadastroOm.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroOm.TxtCODIGO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroOm.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroOm method=post action=FrmCadastroOm.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'OM';
	
	if ($TxtOpcao == 'A')
		$Titulo = $Titulo . ' - Altera��o';
	if ($TxtOpcao == 'D')
		$Titulo = $Titulo . ' - Exclus�o';
	if ($TxtOpcao == 'I')
		$Titulo = $Titulo . ' - Inclus�o';
	echo '</td></tr>';
	ExibeTitulo($Titulo);	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["CODIGO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["SIGLA"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCODIGO value="" maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtSIGLA value="" maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DESCRICAO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtDESCRICAO value="" maxlength=50 size=50></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroOm)>';
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
	echo '<form name=FrmCadastroOm method=GET action=FrmCadastroOm.php>';
	ExibeTitulo('Pesquisa ->OM');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["CODIGO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["SIGLA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCODIGO maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtSIGLA maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DESCRICAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtDESCRICAO maxlength=50 size=50></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white align=center>Linhas Por P�gina:<input type=text name=TxtLinhas maxlength=4 size=4 value=' . $_ENV['TotalMaximoPorTela'] . '></td>';
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
