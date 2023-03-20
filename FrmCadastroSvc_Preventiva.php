<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["DESCRICAO"] 	= "Descrição";
$_Mascara["KILOMETRAGEM"] 	= "Kilometragem";
$_Mascara["VALOR"] 	= "Valor";

$CodigoPagina = 'FrmCadastroSvc_Preventiva';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroSvc_Preventiva';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroSvc_Preventiva.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtDESCRICAO']))
	$TxtDESCRICAO = VerificaInsercoesMaliciosas($_GET['TxtDESCRICAO']);
else
	$TxtDESCRICAO = '';

if (isset($_GET['TxtKILOMETRAGEM']))
	$TxtKILOMETRAGEM = VerificaInsercoesMaliciosas($_GET['TxtKILOMETRAGEM']);
else
	$TxtKILOMETRAGEM = '';

if (isset($_GET['TxtVALOR']))
	$TxtVALOR = VerificaInsercoesMaliciosas($_GET['TxtVALOR']);
else
	$TxtVALOR = '';

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

if ($TxtDESCRICAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Svc_Preventiva.DESCRICAO = '" . $TxtDESCRICAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESCRICAO"] . " = " . $TxtDESCRICAO;
	$Argumento = $Argumento . "TxtDESCRICAO=".$TxtDESCRICAO . "&";
}

if ($TxtKILOMETRAGEM <> '')
{
	$TxtWhere = $TxtWhere . " AND Svc_Preventiva.KILOMETRAGEM = '" . $TxtKILOMETRAGEM . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["KILOMETRAGEM"] . " = " . $TxtKILOMETRAGEM;
	$Argumento = $Argumento . "TxtKILOMETRAGEM=".$TxtKILOMETRAGEM . "&";
}

if ($TxtVALOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Svc_Preventiva.VALOR = '" . $TxtVALOR . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["VALOR"] . " = " . $TxtVALOR;
	$Argumento = $Argumento . "TxtVALOR=".$TxtVALOR . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Svc_Preventiva.ID AS `ID`, Svc_Preventiva.DESCRICAO AS `" . $_Mascara['DESCRICAO'] . "`, Svc_Preventiva.KILOMETRAGEM AS `" . $_Mascara['KILOMETRAGEM'] . "`, Svc_Preventiva.VALOR AS `" . $_Mascara['VALOR'] . "`  from  Svc_Preventiva where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroSvc_Preventiva"," Serviço de Preventiva ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT DESCRICAO,KILOMETRAGEM,VALOR  from  Svc_Preventiva";
	$NomeForm = "FrmCadastroSvc_Preventiva";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtDESCRICAO 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO']);
		$TxtKILOMETRAGEM 	= VerificaInsercoesMaliciosas($_POST['TxtKILOMETRAGEM']);
		$TxtVALOR 	= VerificaInsercoesMaliciosas($_POST['TxtVALOR']);

		$smsecurequery = "Select * from Svc_Preventiva where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Svc_Preventiva(DESCRICAO,KILOMETRAGEM,VALOR)
		 VALUES
		 ('" . $TxtDESCRICAO ."','" . $TxtKILOMETRAGEM ."','" . $TxtVALOR ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtDESCRICAO 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO']);
		$TxtKILOMETRAGEM 	= VerificaInsercoesMaliciosas($_POST['TxtKILOMETRAGEM']);
		$TxtVALOR 	= VerificaInsercoesMaliciosas($_POST['TxtVALOR']);

		$strSQL = "Update  Svc_Preventiva set 
			DESCRICAO			='" . $TxtDESCRICAO .
			"',KILOMETRAGEM			='" . $TxtKILOMETRAGEM .
			"',VALOR			='" . $TxtVALOR ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Svc_Preventiva    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroSvc_Preventiva.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroSvc_Preventiva.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroSvc_Preventiva.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,DESCRICAO,KILOMETRAGEM,VALOR  from  Svc_Preventiva  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroSvc_Preventiva') ;

	echo '<script>document.FrmCadastroSvc_Preventiva.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroSvc_Preventiva.TxtDESCRICAO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroSvc_Preventiva.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroSvc_Preventiva method=post action=FrmCadastroSvc_Preventiva.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Serviço de Preventiva';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DESCRICAO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["KILOMETRAGEM"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["VALOR"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><input type=text name=TxtDESCRICAO value="" maxlength=30 size=30></td>';
	echo '<td class=white height=32><input type=text name=TxtKILOMETRAGEM value="" maxlength=8 size=8></td>';
	echo '<td class=white height=32><input type=text name=TxtVALOR value="" maxlength=11 size=11></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroSvc_Preventiva)>';
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
	echo '<form name=FrmCadastroSvc_Preventiva method=GET action=FrmCadastroSvc_Preventiva.php>';
	ExibeTitulo('Pesquisa ->Serviço de Preventiva');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DESCRICAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["KILOMETRAGEM"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["VALOR"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><input type=text name=TxtDESCRICAO maxlength=30 size=30></td>';
	echo '<td class=white height=32><input type=text name=TxtKILOMETRAGEM maxlength=8 size=8></td>';
	echo '<td class=white height=32><input type=text name=TxtVALOR maxlength=11 size=11></td>';
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
