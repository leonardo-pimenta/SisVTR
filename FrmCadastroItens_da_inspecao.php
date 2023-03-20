<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_INSPECAO"] 	= "Inspeção";
$_Mascara["ID_ITENS_PARA_INSPECAO"] 	= "Itens Para Inspeção";
$_Mascara["ID_RESULTADO_POSSIVEL"] 	= "Resultado";

$CodigoPagina = 'FrmCadastroItens_da_inspecao';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroItens_da_inspecao';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroItens_da_inspecao.php?Pesquisa=S>Pesquisar</A>';
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

if ($TxtID_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao.ID_PEDIDO = '" . $TxtID_PEDIDO . "'";
	$MsgTxtWhere = $MsgTxtWhere . "Número do Pedido = " . $TxtID_PEDIDO;
	$Argumento = $Argumento . "TxtID_PEDIDO=".$TxtID_PEDIDO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}

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
	echo $_SESSION['AbreMoldura'];
	echo  "<TR>";
	echo "<TD class=smsecurehlcolor><B>Número do Pedido</B></TD>";
	echo  "</TR>";
	$smsecurequery = "Select ID_PEDIDO as `ID`, ID_PEDIDO from  Inspecao where 1=1 " . $TxtWhere . " group by ID_PEDIDO";
	$smsecurers = mysql_query($smsecurequery);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo "<tr>";
		echo "<TD class=white align=left><font size='1'><a href=FrmCadastroItens_da_inspecao.php?TxtOpcao=V&Codigo=" . $row['ID'] . ">" . $row['ID_PEDIDO'] . "</font></TD>";
		echo "</tr>";
	}
	echo $_SESSION['FechaMoldura'];
//	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroItens_da_inspecao"," Itens da Inspeção ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_INSPECAO,ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL  from  Itens_da_inspecao";
	$NomeForm = "FrmCadastroItens_da_inspecao";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);
		$TxtID_RESULTADO_POSSIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO_POSSIVEL']);

		$smsecurequery = "Select * from Itens_da_inspecao where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Itens_da_inspecao(ID_INSPECAO,ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL)
		 VALUES
		 ('" . $TxtID_INSPECAO ."','" . $TxtID_ITENS_PARA_INSPECAO ."','" . $TxtID_RESULTADO_POSSIVEL ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);
		$TxtID_RESULTADO_POSSIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO_POSSIVEL']);

		$strSQL = "Update  Itens_da_inspecao set
			ID_INSPECAO			='" . $TxtID_INSPECAO .
			"',ID_ITENS_PARA_INSPECAO			='" . $TxtID_ITENS_PARA_INSPECAO .
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
	$strSQL = "delete from  Itens_da_inspecao    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroItens_da_inspecao.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_da_inspecao.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroItens_da_inspecao.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_INSPECAO,ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL  from  Itens_da_inspecao  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroItens_da_inspecao') ;

	echo '<script>document.FrmCadastroItens_da_inspecao.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_da_inspecao.TxtID_INSPECAO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroItens_da_inspecao.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{
	echo $_SESSION['AbreMoldura'];
	echo  "<TR>";
	echo "<TD class=smsecurehlcolor><B>Pedido Número " . $_GET['Codigo'] . " - Saída</B></TD>";
	echo  "</TR>";
	$smsecurequery = "Select Resultado_possivel.DESCRICAO as RESULTADO, Itens_para_inspecao.DESCRICAO as 'ITEM' from  Inspecao,Itens_da_inspecao,Resultado_possivel,Itens_para_inspecao  where Inspecao.ID = Itens_da_inspecao.ID_INSPECAO and Resultado_possivel.ID = Itens_da_inspecao.ID_RESULTADO_POSSIVEL and Itens_da_inspecao.ID_ITENS_PARA_INSPECAO = Itens_para_inspecao.ID AND Inspecao.ID_PEDIDO = " . $_GET['Codigo'] . " and Inspecao.TP_INSPECAO = 1";
	$smsecurers = mysql_query($smsecurequery);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo "<tr>";
		echo "<TD class=white align=left><font size='1'>" . $row['ITEM'] . " - " . $row['RESULTADO'] . "</font></TD>";
		echo "</tr>";
	}
	echo $_SESSION['FechaMoldura'];
	echo $_SESSION['AbreMoldura'];
	echo  "<TR>";
	echo "<TD class=smsecurehlcolor><B>Pedido Número " . $_GET['Codigo'] . " - Regresso</B></TD>";
	echo  "</TR>";
	$smsecurequery = "Select Resultado_possivel.DESCRICAO as RESULTADO, Itens_para_inspecao.DESCRICAO as 'ITEM' from  Inspecao,Itens_da_inspecao,Resultado_possivel,Itens_para_inspecao  where Inspecao.ID = Itens_da_inspecao.ID_INSPECAO and Resultado_possivel.ID = Itens_da_inspecao.ID_RESULTADO_POSSIVEL and Itens_da_inspecao.ID_ITENS_PARA_INSPECAO = Itens_para_inspecao.ID AND Inspecao.ID_PEDIDO = " . $_GET['Codigo'] . " and Inspecao.TP_INSPECAO = 2";
	$smsecurers = mysql_query($smsecurequery);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo "<tr>";
		echo "<TD class=white align=left><font size='1'>" . $row['ITEM'] . " - " . $row['RESULTADO'] . "</font></TD>";
		echo "</tr>";
	}
	echo $_SESSION['FechaMoldura'];
	echo '<center><a href="FrmCadastroItens_da_inspecao.php">VOLTAR</a><center>';
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
	echo '<form name=FrmCadastroItens_da_inspecao method=GET action=FrmCadastroItens_da_inspecao.php>';
	ExibeTitulo('Pesquisa ->Itens da Inspeção');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>Número do Pedido</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><input type=text name=TxtID_PEDIDO maxlength=11 size=4></td>';
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
