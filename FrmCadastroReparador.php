<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["NOME"] 	= "Nome";
$_Mascara["ENDERECO"] 	= "Endereço";
$_Mascara["CPF_CNPJ"] 	= "CPF/CNPJ";
$_Mascara["OBS"] 	= "Observação";

$CodigoPagina = 'FrmCadastroReparador';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroReparador';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroReparador.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtNOME']))
	$TxtNOME = VerificaInsercoesMaliciosas($_GET['TxtNOME']);
else
	$TxtNOME = '';

if (isset($_GET['TxtCPF_CNPJ']))
	$TxtCPF_CNPJ = VerificaInsercoesMaliciosas($_GET['TxtCPF_CNPJ']);
else
	$TxtCPF_CNPJ = '';

if (isset($_GET['TxtENDERECO']))
	$TxtENDERECO = VerificaInsercoesMaliciosas($_GET['TxtENDERECO']);
else
	$TxtENDERECO = '';

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

if ($TxtNOME <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparador.NOME = '" . $TxtNOME . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NOME"] . " = " . $TxtNOME;
	$Argumento = $Argumento . "TxtNOME=".$TxtNOME . "&";
}

if ($TxtCPF_CNPJ <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparador.CPF_CNPJ = '" . $TxtCPF_CNPJ . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["CPF_CNPJ"] . " = " . $TxtCPF_CNPJ;
	$Argumento = $Argumento . "TxtCPF_CNPJ=".$TxtCPF_CNPJ . "&";
}

if ($TxtENDERECO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparador.ENDERECO = '" . $TxtENDERECO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ENDERECO"] . " = " . $TxtENDERECO;
	$Argumento = $Argumento . "TxtENDERECO=".$TxtENDERECO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Reparador.ID AS `ID`, Reparador.NOME AS `" . $_Mascara['NOME'] . "`, Reparador.CPF_CNPJ AS `" . $_Mascara['CPF_CNPJ'] . "`  from  Reparador where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroReparador"," Reparador ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT NOME,CPF_CNPJ,ENDERECO,OBS  from  Reparador";
	$NomeForm = "FrmCadastroReparador";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	if(!VerificaCNPJ_CPF(VerificaInsercoesMaliciosas($_POST['TxtCPF_CNPJ']),$strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtCPF_CNPJ 	= VerificaInsercoesMaliciosas($_POST['TxtCPF_CNPJ']);
		$TxtENDERECO 	= VerificaInsercoesMaliciosas($_POST['TxtENDERECO']);
		$TxtOBS 	= VerificaInsercoesMaliciosas($_POST['TxtOBS']);

		$smsecurequery = "Select * from Reparador where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Reparador(NOME,CPF_CNPJ,ENDERECO,OBS)
		 VALUES
		 ('" . $TxtNOME ."','" . $TxtCPF_CNPJ ."','" . $TxtENDERECO ."','" . $TxtOBS ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtCPF_CNPJ 	= VerificaInsercoesMaliciosas($_POST['TxtCPF_CNPJ']);
		$TxtENDERECO 	= VerificaInsercoesMaliciosas($_POST['TxtENDERECO']);
		$TxtOBS 	= VerificaInsercoesMaliciosas($_POST['TxtOBS']);

		$strSQL = "Update  Reparador set 
			NOME			='" . $TxtNOME .
			"',CPF_CNPJ			='" . $TxtCPF_CNPJ .
			"',ENDERECO			='" . $TxtENDERECO .
			"',OBS			='" . $TxtOBS ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Reparador    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroReparador.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroReparador.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroReparador.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,NOME,CPF_CNPJ,ENDERECO,OBS  from  Reparador  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroReparador') ;

	echo '<script>document.FrmCadastroReparador.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroReparador.TxtNOME.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroReparador.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroReparador method=post action=FrmCadastroReparador.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Reparador';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["CPF_CNPJ"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME value="" maxlength=40 size=40></td>';
	echo '<td class=white><input type=text name=TxtCPF_CNPJ value="" maxlength=14 size=14></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ENDERECO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtENDERECO value="" maxlength=50 size=50></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["OBS"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><textarea name=TxtOBS rows=10 cols=80></textarea></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroReparador)>';
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
	echo '<form name=FrmCadastroReparador method=GET action=FrmCadastroReparador.php>';
	ExibeTitulo('Pesquisa ->Reparador');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["CPF_CNPJ"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME maxlength=40 size=40></td>';
	echo '<td class=white><input type=text name=TxtCPF_CNPJ maxlength=14 size=14></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ENDERECO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtENDERECO maxlength=50 size=50></td>';
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
