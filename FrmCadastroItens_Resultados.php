<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_ITENS_INSPECAO"] 	= "Ítem de Inspeção";
$_Mascara["ID_RESULTADO"] 	= "Resultado";

$CodigoPagina = 'FrmCadastroItens_Resultados';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroItens_Resultados';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroItens_Resultados.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_ITENS_INSPECAO']))
	$TxtID_ITENS_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtID_ITENS_INSPECAO']);
else
	$TxtID_ITENS_INSPECAO = '';

if (isset($_GET['TxtID_RESULTADO']))
	$TxtID_RESULTADO = VerificaInsercoesMaliciosas($_GET['TxtID_RESULTADO']);
else
	$TxtID_RESULTADO = '';

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

if ($TxtID_ITENS_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Itens_Resultados.ID_ITENS_INSPECAO = '" . $TxtID_ITENS_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_ITENS_INSPECAO"] . " = " . $TxtID_ITENS_INSPECAO;
	$Argumento = $Argumento . "TxtID_ITENS_INSPECAO=".$TxtID_ITENS_INSPECAO . "&";
}

if ($TxtID_RESULTADO <> '')
{
	$TxtWhere = $TxtWhere . " AND Itens_Resultados.ID_RESULTADO = '" . $TxtID_RESULTADO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_RESULTADO"] . " = " . $TxtID_RESULTADO;
	$Argumento = $Argumento . "TxtID_RESULTADO=".$TxtID_RESULTADO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Itens_Resultados.ID AS `ID`, Itens_Inspecao.DESCRICAO AS `" . $_Mascara['ID_ITENS_INSPECAO'] . "`, Resultado.DESCRICAO AS `" . $_Mascara['ID_RESULTADO'] . "`  from  Itens_Resultados,Itens_Inspecao,Resultado where 1=1 AND Itens_Resultados.ID_ITENS_INSPECAO = Itens_Inspecao.ID AND Itens_Resultados.ID_RESULTADO = Resultado.ID " . $TxtWhere . " ORDER BY Itens_Inspecao.DESCRICAO"  ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroItens_Resultados"," Resultados por Ítem de Inspeção ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_ITENS_INSPECAO,ID_RESULTADO  from  Itens_Resultados";
	$NomeForm = "FrmCadastroItens_Resultados";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_ITENS_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_INSPECAO']);
		$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO']);

		$smsecurequery = "Select * from Itens_Resultados where ID = '" . $TxtID . "'||(ID_ITENS_INSPECAO='" . $TxtID_ITENS_INSPECAO . "' and ID_RESULTADO='" . $TxtID_RESULTADO . "')";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Itens_Resultados(ID_ITENS_INSPECAO,ID_RESULTADO)
		 VALUES
		 ('" . $TxtID_ITENS_INSPECAO ."','" . $TxtID_RESULTADO ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_ITENS_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_INSPECAO']);
		$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO']);

		$strSQL = "Update  Itens_Resultados set
			ID_ITENS_INSPECAO			='" . $TxtID_ITENS_INSPECAO .
			"',ID_RESULTADO			='" . $TxtID_RESULTADO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Itens_Resultados    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroItens_Resultados.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_Resultados.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroItens_Resultados.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_ITENS_INSPECAO,ID_RESULTADO  from  Itens_Resultados  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroItens_Resultados') ;

	echo '<script>document.FrmCadastroItens_Resultados.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_Resultados.TxtID_ITENS_INSPECAO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroItens_Resultados.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroItens_Resultados method=post action=FrmCadastroItens_Resultados.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Resultados por Ítem de Inspeção';

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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_ITENS_INSPECAO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_RESULTADO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_ITENS_INSPECAO>';
	$strSQL = 'select * from Itens_Inspecao';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_RESULTADO>';
	$strSQL = 'select * from Resultado';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroItens_Resultados)>';
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
	echo '<form name=FrmCadastroItens_Resultados method=GET action=FrmCadastroItens_Resultados.php>';
	ExibeTitulo('Pesquisa ->Resultados por Ítem de Inspeção');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_ITENS_INSPECAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_RESULTADO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_ITENS_INSPECAO>';
	$strSQL = 'select * from Itens_Inspecao';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_RESULTADO>';
	$strSQL = 'select * from Resultado';
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
