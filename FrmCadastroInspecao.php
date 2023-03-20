<?php
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_ITENS_INSPECAO"] 	= "Ítens de Inspeção";
$_Mascara["ID_RESULTADO"] 	= "Resultado";
$_Mascara["ID_INSPECAO"] 	= "Inspeção No";
$_Mascara["ID_PEDIDO"] 	= "ID_PEDIDO";
$_Mascara["TP_INSPECAO"] 	= "Tipo de Inspeção";

$CodigoPagina = 'FrmCadastroInspecao';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroInspecao';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
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

function ExibeGrid()

{

	if($_GET['acao'] == 3)

		$Titulo = "Inspeção de Saída";
	else if($_GET['acao'] == 4)

		$Titulo = "Inspeção de Regresso";
	ImprimeCabecalho($Titulo,$Cabecalho,$ContadorLinha,$Pagina,$Limite,$TotalMaximoPorTela,$ProximoLimite,$AnteriorLimite,$TotalRegistrosQuerySemLimitador,$Nome,$Argumento);

	echo $_SESSION['AbreMoldura'];
	echo  "<TR>";
	echo "<TD class=smsecurehlcolor><B>Número do Pedido</B></TD>";
	echo  "</TR>";
	$smsecurequery = "Select Inspecao.ID AS `ID`, Pedido.ID AS `ID_PEDIDO`, if(TP_INSPECAO=1,'Saída','Regresso') AS `" . $_Mascara['TP_INSPECAO'] . "`  from  Inspecao,Pedido  where 1=1 AND Inspecao.ID_PEDIDO = Pedido.ID and Pedido.ID_VIATURA <> 0 and Inspecao.TP_INSPECAO = '" . VerificaInsercoesMaliciosas($_GET['acao']) . "' " . $TxtWhere ;
	$smsecurers = mysql_query($smsecurequery);
	if(@mysql_affected_rows() == 0)

	{
		echo "<tr>";
		echo "<TD class=white align=left><font size='1'>Não existe nenhum pedido para fazer";
		if($_GET['acao'] == 3)
			echo " a saída";
		else if($_GET['acao'] == 4)
			echo " o regresso";
		echo ".</font></TD>";
		echo "</tr>";
	}

	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo "<tr>";
		echo "<TD class=white align=left><font size='1'><a href=FrmCadastroInspecao?TxtOpcao=I&Codigo=" . $row['ID_PEDIDO'] . "&acao=" . $_GET['acao'] . ">" . $row['ID_PEDIDO'] . "</a></font></TD>";
		echo "</tr>";
	}
	echo $_SESSION['FechaMoldura'];
}
ExibeGrid();
//echo $smsecurequery;
//ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroInspecao_Itens"," Inspeção de Ítens ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function ProcessaInclusao($_Mascara)
{
	$TxtID_PEDIDO		= VerificaInsercoesMaliciosas($_POST['Pedido']);
	$strSQL = "SELECT ID from Inspecao where ID_Pedido = '" . $TxtID_PEDIDO . "' and TP_INSPECAO = '" . $_GET['acao'] . "'";

	$smsecurers = mysql_query($strSQL);

	$row = mysql_fetch_array($smsecurers);
	$TxtID_INSPECAO = $row['ID'];

	$strSQL = "delete from Itens_da_inspecao where ID_INSPECAO = '" . $TxtID_INSPECAO . "'";
	$smsecurers = mysql_query($strSQL);

	$strSQL1 = "select Itens_para_inspecao.DESCRICAO, Itens_para_inspecao.ID from
		Itens_para_inspecao, Itens_inspecao_viaturas,Pedido where
		Pedido.ID = '" . $_POST['Pedido'] . "' and
		Pedido.ID_VIATURA = Itens_inspecao_viaturas.ID_VIATURA and
		Itens_para_inspecao.ID = Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO";
	$smsecurers1 = mysql_query($strSQL1);
	$Contador1 = @mysql_affected_rows();
	for ($t1 = 1; $t1 <= $Contador1; $t1++)
	{
		$row1 = mysql_fetch_array($smsecurers1);
		$TxtID_ITENS_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO' . $row1['ID']]);
		$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO' . $row1['ID']]);

		$strSQL = "insert into Itens_da_inspecao(ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL,ID_INSPECAO)
			VALUES
			('" . $TxtID_ITENS_INSPECAO ."','" . $TxtID_RESULTADO ."','" . $TxtID_INSPECAO ."')";
		$smsecurers = mysql_query($strSQL);
	}


	VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());

	if($_GET['acao'] == 3)
	{
		$strSQL = "update Inspecao set TP_INSPECAO = '1' where ID_PEDIDO = '" . $TxtID_PEDIDO . "' and TP_INSPECAO = 3";
		$smsecurers = mysql_query($strSQL);

		$strSQL = "insert into Inspecao (TP_INSPECAO,ID_PEDIDO)
			VALUES
			('4','" . $TxtID_PEDIDO ."')";
		$smsecurers = mysql_query($strSQL);
	}
	else
	{
		$strSQL = "update Inspecao set TP_INSPECAO = '2' where ID_PEDIDO = '" . $TxtID_PEDIDO . "' and TP_INSPECAO = 4";
		$smsecurers = mysql_query($strSQL);
	}

	//Bloco que faz voltar para o modo de alteracao da pagina principal
// 	echo "<form action=FrmCadastroInspecao.php method=get id=Redirecionar name=Redirecionar>";
// 	echo "<input name=acao type=hidden value='" . $_GET['acao'] . "'>";
// 	echo "<input name=Codigo type=hidden value='" . $TxtID_INSPECAO . "'>";
// 	echo "<script>";
// 	echo "document.Redirecionar.submit()";
// 	echo "</script>";
}
function EnviaInclusao()
{
	echo '<script>document.FrmCadastroInspecao_Itens.TxtTipoFormulario.value="I"</SCRIPT>';
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroInspecao method=post action=FrmCadastroInspecao.php?acao=' . $_GET['acao'] . '><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario value="I">';
	$Titulo = 'Inspeção de Ítens';

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


	echo '<td class=ColorFormulario><font color=000000><b>Ítem da Inspeção</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>Resultado da Inspeção</b></font></td>';
	echo '</tr>';

	$strSQL1 = "select Itens_para_inspecao.DESCRICAO, Itens_para_inspecao.ID from
		Itens_para_inspecao, Itens_inspecao_viaturas,Pedido where
		Pedido.ID = '" . $_GET['Codigo'] . "' and
		Pedido.ID_VIATURA = Itens_inspecao_viaturas.ID_VIATURA and
		Itens_para_inspecao.ID = Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO";
	$smsecurers1 = mysql_query($strSQL1);
	$Contador1 = @mysql_affected_rows();
	for ($t1 = 1; $t1 <= $Contador1; $t1++)
	{
		$row1 = mysql_fetch_array($smsecurers1);
		echo '<tr>';
		echo '<input type=hidden name=TxtID_INSPECAO value="' . VerificaInsercoesMaliciosas($_GET['Codigo']) . '">';
		echo '<input type=hidden name="TxtID_ITENS_PARA_INSPECAO' . $row1['ID'] . '" value="' . $row1['ID'] . '">';
		echo '<input type=hidden name=Pedido value="' . $_GET['Codigo'] . '">';
		echo '<td class=white height=35>' . $row1['DESCRICAO'] . '</td>';
		echo '<td class=white height=35><select name=TxtID_RESULTADO' . $row1['ID'] . '>';
		$strSQL = 'select Resultado_possivel.DESCRICAO, Resultado_possivel.ID from
			Resultado_possivel,Itens_Resultado where
			Itens_Resultado.ID_RESULTADO_POSSIVEL = Resultado_possivel.ID and
			Itens_Resultado.ID_ITENS_PARA_INSPECAO = ' . $row1['ID'] . ' order by Resultado_possivel.DESCRICAO';
		$smsecurers = mysql_query($strSQL);
		$Contador = @mysql_affected_rows();
		for ($t = 1; $t <= $Contador; $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			$strSQL2 = 'select Itens_da_inspecao.ID_RESULTADO_POSSIVEL from
				Itens_da_inspecao, Inspecao where
				Inspecao.ID = Itens_da_inspecao.ID_INSPECAO and
				Inspecao.TP_INSPECAO = 1 and
				Itens_da_inspecao.ID_RESULTADO_POSSIVEL = ' . $row['ID'] . ' and
				Inspecao.ID_PEDIDO = ' . $_GET['Pedido'] . ' and
				Itens_da_inspecao.ID_ITENS_PARA_INSPECAO = ' . $row1['ID'] . '';
			$smsecurers2 = mysql_query($strSQL2);
			$row2 = mysql_fetch_array($smsecurers2);
			if ($row2['ID_RESULTADO_POSSIVEL'] == $row['ID'])
				$selected = 'selected';
			else
				$selected = ' ';
			echo '<option value='. $row['ID'] . ' ' . $selected . '>' .  $row['DESCRICAO'] . '</option>';
		}
		echo '</select></td>';
		echo '</tr>';
	}
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroInspecao)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:window.history.go(-1)>';
	}
	echo '</td></tr>';
	echo $_SESSION['FechaMoldura'];

	echo '</form>';
}
?>