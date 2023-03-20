<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["NOME_MENU"] 	= "Nome";
$_Mascara["MENU_APONTA"] 	= "Menu Aponta";
$_Mascara["POSICAO_MENU"] 	= "Posição";
$_Mascara["DESCRICAO_MENU"] 	= "Descrição";
$_Mascara["POSICAO_1024X768"] 	= "POSICAO_1024X768";
$_Mascara["POSICAO_800X600"] 	= "POSICAO_800X600";
$_Mascara["LARGURA_CAIXA"] 	= "LARGURA_CAIXA";
$_Mascara["ALTURA_CAIXA"] 	= "ALTURA_CAIXA";

$CodigoPagina = 'FrmCadastroMenu';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroMenu';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroMenu.php?Pesquisa=S>Pesquisar</A>';
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

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Menu.ID AS `ID`, Menu.NOME_MENU AS `" . $_Mascara['NOME_MENU'] . "`, Menu.MENU_APONTA AS `" . $_Mascara['MENU_APONTA'] . "`, Menu.DESCRICAO_MENU AS `" . $_Mascara['DESCRICAO_MENU'] . "`, Menu.POSICAO_MENU AS `" . $_Mascara['POSICAO_MENU'] . "`  from  Menu where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroMenu"," Cadastro de Menu ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT NOME_MENU,MENU_APONTA,POSICAO_MENU,DESCRICAO_MENU,POSICAO_1024X768,POSICAO_800X600,LARGURA_CAIXA,ALTURA_CAIXA  from  Menu";
	$NomeForm = "FrmCadastroMenu";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_MENU']);
		$TxtMENU_APONTA 	= VerificaInsercoesMaliciosas($_POST['TxtMENU_APONTA']);
		$TxtPOSICAO_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_MENU']);
		$TxtDESCRICAO_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO_MENU']);
		$TxtPOSICAO_1024X768 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_1024X768']);
		$TxtPOSICAO_800X600 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_800X600']);
		$TxtLARGURA_CAIXA 	= VerificaInsercoesMaliciosas($_POST['TxtLARGURA_CAIXA']);
		$TxtALTURA_CAIXA 	= VerificaInsercoesMaliciosas($_POST['TxtALTURA_CAIXA']);

		$smsecurequery = "Select * from Menu where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Menu(NOME_MENU,MENU_APONTA,POSICAO_MENU,DESCRICAO_MENU,POSICAO_1024X768,POSICAO_800X600,LARGURA_CAIXA,ALTURA_CAIXA)
		 VALUES
		 ('" . $TxtNOME_MENU ."','" . $TxtMENU_APONTA ."','" . $TxtPOSICAO_MENU ."','" . $TxtDESCRICAO_MENU ."','" . $TxtPOSICAO_1024X768 ."','" . $TxtPOSICAO_800X600 ."','" . $TxtLARGURA_CAIXA ."','" . $TxtALTURA_CAIXA ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_MENU']);
		$TxtMENU_APONTA 	= VerificaInsercoesMaliciosas($_POST['TxtMENU_APONTA']);
		$TxtPOSICAO_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_MENU']);
		$TxtDESCRICAO_MENU 	= VerificaInsercoesMaliciosas($_POST['TxtDESCRICAO_MENU']);
		$TxtPOSICAO_1024X768 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_1024X768']);
		$TxtPOSICAO_800X600 	= VerificaInsercoesMaliciosas($_POST['TxtPOSICAO_800X600']);
		$TxtLARGURA_CAIXA 	= VerificaInsercoesMaliciosas($_POST['TxtLARGURA_CAIXA']);
		$TxtALTURA_CAIXA 	= VerificaInsercoesMaliciosas($_POST['TxtALTURA_CAIXA']);

		$strSQL = "Update  Menu set 
			NOME_MENU			='" . $TxtNOME_MENU .
			"',MENU_APONTA			='" . $TxtMENU_APONTA .
			"',POSICAO_MENU			='" . $TxtPOSICAO_MENU .
			"',DESCRICAO_MENU			='" . $TxtDESCRICAO_MENU .
			"',POSICAO_1024X768			='" . $TxtPOSICAO_1024X768 .
			"',POSICAO_800X600			='" . $TxtPOSICAO_800X600 .
			"',LARGURA_CAIXA			='" . $TxtLARGURA_CAIXA .
			"',ALTURA_CAIXA			='" . $TxtALTURA_CAIXA ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Menu    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroMenu.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroMenu.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroMenu.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,NOME_MENU,MENU_APONTA,POSICAO_MENU,DESCRICAO_MENU,POSICAO_1024X768,POSICAO_800X600,LARGURA_CAIXA,ALTURA_CAIXA  from  Menu  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroMenu') ;

	echo '<script>document.FrmCadastroMenu.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroMenu.TxtNOME_MENU.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroMenu.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroMenu method=post action=FrmCadastroMenu.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Cadastro de Menu';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME_MENU"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME_MENU value="" maxlength=50 size=50></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["MENU_APONTA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["POSICAO_MENU"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtMENU_APONTA value="" maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtPOSICAO_MENU value="" maxlength=8 size=8></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DESCRICAO_MENU"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtDESCRICAO_MENU value="" maxlength=50 size=50></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["POSICAO_1024X768"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["POSICAO_800X600"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["LARGURA_CAIXA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ALTURA_CAIXA"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtPOSICAO_1024X768 value="" maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtPOSICAO_800X600 value="" maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtLARGURA_CAIXA value="" maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtALTURA_CAIXA value="" maxlength=8 size=8></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroMenu)>';
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
	echo '<form name=FrmCadastroMenu method=GET action=FrmCadastroMenu.php>';
	ExibeTitulo('Pesquisa ->Cadastro de Menu');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
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
