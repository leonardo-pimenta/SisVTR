<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["POSTO"] 	= "Posto";
$_Mascara["NOME"] 	= "Nome";
$_Mascara["NOME_GUERRA"] 	= "Nome de Guerra";
$_Mascara["FUNCAO"] 	= "Função";

$CodigoPagina = 'FrmCadastroEncarregado';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroEncarregado';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroEncarregado.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtNOME_GUERRA']))
	$TxtNOME_GUERRA = VerificaInsercoesMaliciosas($_GET['TxtNOME_GUERRA']);
else
	$TxtNOME_GUERRA = '';

if (isset($_GET['TxtPOSTO']))
	$TxtPOSTO = VerificaInsercoesMaliciosas($_GET['TxtPOSTO']);
else
	$TxtPOSTO = '';

if (isset($_GET['TxtFUNCAO']))
	$TxtFUNCAO = VerificaInsercoesMaliciosas($_GET['TxtFUNCAO']);
else
	$TxtFUNCAO = '';

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

if ($TxtNOME_GUERRA <> '')
{
	$TxtWhere = $TxtWhere . " AND Encarregado.NOME_GUERRA LIKE '%" . $TxtNOME_GUERRA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NOME_GUERRA"] . " = " . $TxtNOME_GUERRA;
	$Argumento = $Argumento . "TxtNOME_GUERRA=".$TxtNOME_GUERRA . "&";
}

if ($TxtPOSTO <> '')
{
	$TxtWhere = $TxtWhere . " AND Encarregado.POSTO LIKE '%" . $TxtPOSTO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["POSTO"] . " = " . $TxtPOSTO;
	$Argumento = $Argumento . "TxtPOSTO=".$TxtPOSTO . "&";
}

if ($TxtFUNCAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Encarregado.FUNCAO LIKE '%" . $TxtFUNCAO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["FUNCAO"] . " = " . $TxtFUNCAO;
	$Argumento = $Argumento . "TxtFUNCAO=".$TxtFUNCAO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Encarregado.ID AS `ID`, Encarregado.NOME AS `" . $_Mascara['NOME'] . "`, Encarregado.NOME_GUERRA AS `" . $_Mascara['NOME_GUERRA'] . "`, Encarregado.POSTO AS `" . $_Mascara['POSTO'] . "`, Encarregado.FUNCAO AS `" . $_Mascara['FUNCAO'] . "`  from  Encarregado where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroEncarregado"," Encarregado ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT POSTO,FUNCAO,NOME,NOME_GUERRA  from  Encarregado";
	$NomeForm = "FrmCadastroEncarregado";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtPOSTO 	= VerificaInsercoesMaliciosas($_POST['TxtPOSTO']);
		$TxtFUNCAO 	= VerificaInsercoesMaliciosas($_POST['TxtFUNCAO']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtNOME_GUERRA 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_GUERRA']);

		$smsecurequery = "Select * from Encarregado where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Encarregado(POSTO,FUNCAO,NOME,NOME_GUERRA)
		 VALUES
		 ('" . $TxtPOSTO ."','" . $TxtFUNCAO ."','" . $TxtNOME ."','" . $TxtNOME_GUERRA ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtPOSTO 	= VerificaInsercoesMaliciosas($_POST['TxtPOSTO']);
		$TxtFUNCAO 	= VerificaInsercoesMaliciosas($_POST['TxtFUNCAO']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtNOME_GUERRA 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_GUERRA']);

		$strSQL = "Update  Encarregado set 
			POSTO			='" . $TxtPOSTO .
			"',FUNCAO			='" . $TxtFUNCAO .
			"',NOME			='" . $TxtNOME .
			"',NOME_GUERRA			='" . $TxtNOME_GUERRA ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Encarregado    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroEncarregado.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroEncarregado.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroEncarregado.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,POSTO,FUNCAO,NOME,NOME_GUERRA  from  Encarregado  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroEncarregado') ;

	echo '<script>document.FrmCadastroEncarregado.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroEncarregado.TxtPOSTO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroEncarregado.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroEncarregado method=post action=FrmCadastroEncarregado.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Encarregado';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["POSTO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["FUNCAO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtPOSTO value="" maxlength=25 size=25></td>';
	echo '<td class=white><input type=text name=TxtFUNCAO value="" maxlength=40 size=40></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME_GUERRA"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME value="" maxlength=40 size=40></td>';
	echo '<td class=white><input type=text name=TxtNOME_GUERRA value="" maxlength=30 size=30></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroEncarregado)>';
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
	echo '<form name=FrmCadastroEncarregado method=GET action=FrmCadastroEncarregado.php>';
	ExibeTitulo('Pesquisa ->Encarregado');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME_GUERRA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME_GUERRA maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["POSTO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["FUNCAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtPOSTO maxlength=25 size=25></td>';
	echo '<td class=white><input type=text name=TxtFUNCAO maxlength=40 size=40></td>';
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
