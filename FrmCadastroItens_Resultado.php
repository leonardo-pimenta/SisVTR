<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_RESULTADO_POSSIVEL"] 	= "Resultados";
$_Mascara["ID_ITENS_PARA_INSPECAO"] 	= "Itens";

$CodigoPagina = 'FrmCadastroItens_Resultado';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroItens_Resultado';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroItens_Resultado.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_ITENS_PARA_INSPECAO']))
	$TxtID_ITENS_PARA_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtID_ITENS_PARA_INSPECAO']);
else
	$TxtID_ITENS_PARA_INSPECAO = '';

if (isset($_GET['TxtID_RESULTADO_POSSIVEL']))
	$TxtID_RESULTADO_POSSIVEL = VerificaInsercoesMaliciosas($_GET['TxtID_RESULTADO_POSSIVEL']);
else
	$TxtID_RESULTADO_POSSIVEL = '';

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

if ($TxtID_ITENS_PARA_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Itens_Resultado.ID_ITENS_PARA_INSPECAO = '" . $TxtID_ITENS_PARA_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_ITENS_PARA_INSPECAO"] . " = " . $TxtID_ITENS_PARA_INSPECAO;
	$Argumento = $Argumento . "TxtID_ITENS_PARA_INSPECAO=".$TxtID_ITENS_PARA_INSPECAO . "&";
}

if ($TxtID_RESULTADO_POSSIVEL <> '')
{
	$TxtWhere = $TxtWhere . " AND Itens_Resultado.ID_RESULTADO_POSSIVEL = '" . $TxtID_RESULTADO_POSSIVEL . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_RESULTADO_POSSIVEL"] . " = " . $TxtID_RESULTADO_POSSIVEL;
	$Argumento = $Argumento . "TxtID_RESULTADO_POSSIVEL=".$TxtID_RESULTADO_POSSIVEL . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Itens_Resultado.ID AS `ID`, Itens_para_inspecao.DESCRICAO AS `" . $_Mascara['ID_ITENS_PARA_INSPECAO'] . "`, Resultado_possivel.DESCRICAO AS `" . $_Mascara['ID_RESULTADO_POSSIVEL'] . "`  from  Itens_Resultado,Itens_para_inspecao,Resultado_possivel where 1=1 AND Itens_Resultado.ID_ITENS_PARA_INSPECAO = Itens_para_inspecao.ID AND Itens_Resultado.ID_RESULTADO_POSSIVEL = Resultado_possivel.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroItens_Resultado","  ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL  from  Itens_Resultado";
	$NomeForm = "FrmCadastroItens_Resultado";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);
		$TxtID_RESULTADO_POSSIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO_POSSIVEL']);

		$smsecurequery = "Select * from Itens_Resultado where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Itens_Resultado(ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL)
		 VALUES
		 ('" . $TxtID_ITENS_PARA_INSPECAO ."','" . $TxtID_RESULTADO_POSSIVEL ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);
		$TxtID_RESULTADO_POSSIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO_POSSIVEL']);

		$strSQL = "Update  Itens_Resultado set 
			ID_ITENS_PARA_INSPECAO			='" . $TxtID_ITENS_PARA_INSPECAO .
			"',ID_RESULTADO_POSSIVEL			='" . $TxtID_RESULTADO_POSSIVEL ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Itens_Resultado    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroItens_Resultado.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_Resultado.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroItens_Resultado.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL  from  Itens_Resultado  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroItens_Resultado') ;

	echo '<script>document.FrmCadastroItens_Resultado.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_Resultado.TxtID_RESULTADO_POSSIVEL.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroItens_Resultado.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroItens_Resultado method=post action=FrmCadastroItens_Resultado.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = '';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_ITENS_PARA_INSPECAO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_RESULTADO_POSSIVEL"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtID_ITENS_PARA_INSPECAO>';
	$strSQL = 'select * from Itens_para_inspecao';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white height=32><select name=TxtID_RESULTADO_POSSIVEL>';
	$strSQL = 'select * from Resultado_possivel';
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
	echo '<td class=white>';
	if ($_GET['TxtOpcao'] == 'V')
	{
		echo '<input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()>';
	}
	else
	{
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroItens_Resultado)>';
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
	echo '<form name=FrmCadastroItens_Resultado method=GET action=FrmCadastroItens_Resultado.php>';
	ExibeTitulo('Pesquisa ->');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_ITENS_PARA_INSPECAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_RESULTADO_POSSIVEL"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtID_ITENS_PARA_INSPECAO>';
	$strSQL = 'select * from Itens_para_inspecao';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white height=32><select name=TxtID_RESULTADO_POSSIVEL>';
	$strSQL = 'select * from Resultado_possivel';
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
