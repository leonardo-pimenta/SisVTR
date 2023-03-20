<?php
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_ITENS_INSPECAO"] 	= "Ítens de Inspeção";
$_Mascara["ID_RESULTADO"] 	= "Resultado";
$_Mascara["ID_INSPECAO"] 	= "Inspeção No";

$CodigoPagina = 'FrmCadastroInspecao_Itens';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroInspecao_Itens';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroInspecao_Itens.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtTP_INSPECAO']))
	$TxtID_ITENS_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtTP_INSPECAO']);
else
	$TxtTP_INSPECAO = '';

if (isset($_GET['TxtTP_INSPECAO']))
	$TxtTP_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtTP_INSPECAO']);
else
	$TxtTP_INSPECAO = '';

if (isset($_GET['TxtID_RESULTADO']))
	$TxtID_RESULTADO = VerificaInsercoesMaliciosas($_GET['TxtID_RESULTADO']);
else
	$TxtID_RESULTADO = '';

if (isset($_GET['TxtID_INSPECAO']))
	$TxtID_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtID_INSPECAO']);
else
	$TxtID_INSPECAO = '';
//if (isset($_GET['TxtODOMETRO']))
//	$TxtODOMETRO = VerificaInsercoesMaliciosas($_GET['TxtODOMETRO']);
//else
//	$TxtODOMETRO = '';

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
	$TxtWhere = $TxtWhere . " AND Inspecao_Itens.ID_ITENS_INSPECAO = '" . $TxtID_ITENS_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_ITENS_INSPECAO"] . " = " . $TxtID_ITENS_INSPECAO;
	$Argumento = $Argumento . "TxtID_ITENS_INSPECAO=".$TxtID_ITENS_INSPECAO . "&";
}

if ($TxtID_RESULTADO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Itens.ID_RESULTADO = '" . $TxtID_RESULTADO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_RESULTADO"] . " = " . $TxtID_RESULTADO;
	$Argumento = $Argumento . "TxtID_RESULTADO=".$TxtID_RESULTADO . "&";
}

if ($TxtID_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Itens.ID_INSPECAO = '" . $TxtID_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_INSPECAO"] . " = " . $TxtID_INSPECAO;
	$Argumento = $Argumento . "TxtID_INSPECAO=".$TxtID_INSPECAO . "&";
}

//if ($TxtODOMETRO <> '')
//{
//	$TxtWhere = $TxtWhere . " AND Inspecao_Itens.ODOMETRO = '" . $TxtODOMETRO . "'";
//	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
//	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
//}


if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Inspecao_Itens.ID AS `ID`, Itens_Inspecao.DESCRICAO AS `" . $_Mascara['ID_ITENS_INSPECAO'] . "`, Resultado.DESCRICAO AS `" . $_Mascara['ID_RESULTADO'] . "`, Inspecao.ID AS `" . $_Mascara['ID_INSPECAO'] . "`    from  Inspecao_Itens,Itens_Inspecao,Resultado,Inspecao where 1=1 AND Inspecao_Itens.ID_ITENS_INSPECAO = Itens_Inspecao.ID AND Inspecao_Itens.ID_RESULTADO = Resultado.ID AND Inspecao_Itens.ID_INSPECAO = Inspecao.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroInspecao_Itens"," Inspeção de Ítens ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_ITENS_INSPECAO,ID_RESULTADO,ID_INSPECAO  from  Inspecao_Itens";
	$NomeForm = "FrmCadastroInspecao_Itens";
//	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
//		return false;

	return true;
}

function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {

		$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
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
			$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);

			$strSQL = "insert into Itens_da_inspecao(ID_ITENS_PARA_INSPECAO,ID_RESULTADO_POSSIVEL,ID_INSPECAO)
				VALUES
				('" . $TxtID_ITENS_INSPECAO ."','" . $TxtID_RESULTADO ."','" . $TxtID_INSPECAO ."')";
			$smsecurers = mysql_query($strSQL);
		}
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());



		//Bloco que faz voltar para o modo de alteracao da pagina principal
	 	echo "<form action=FrmCadastroInspecao.php?TxtOpcao=A&Codigo=" . $row["ID"] ." method=get id=Redirecionar name=Redirecionar>";
	 	echo "<input name=TxtOpcao type=hidden value='A'>";
	 	echo "<input name=Codigo type=hidden value='" . $TxtID_INSPECAO . "'>";
	 	echo "<script>";
	 	echo "document.Redirecionar.submit()";
	 	echo "</script>";
	}
}






function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_ITENS_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_INSPECAO']);
		$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO']);
		$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
		$TxtTP_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtTP_INSPECAO']);


		$strSQL = "Update  Inspecao_Itens set
			ID_ITENS_INSPECAO			='" . $TxtID_ITENS_INSPECAO .
			"',ID_RESULTADO			='" . $TxtID_RESULTADO .
			"',ID_INSPECAO			='" . $TxtID_INSPECAO ."'  where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());

		//Bloco que faz voltar para o modo de alteracao da pagina principal

		$strSQL = "SELECT *  from  Inspecao where ID='".$TxtID_INSPECAO."' AND TP_INSPECAO='" . $TxtTP_INSPECAO . "'";
		//SetaDadosAlteracao($strSQL,'FrmCadastroRecadastramentoServidor') ;
		//$TxtOpcao=I2;
		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die('Não pude conectar');
		MYSQL_SELECT_DB($_ENV['NomeBase']);
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{

			$row = mysql_fetch_array($smsecurers);



			//inseri paradar um reload na pagina após a execução desta função...
		 	echo "<form action=FrmCadastroInspecao.php?TxtOpcao=A&Codigo=" . $row["ID"] ." method=get id=Redirecionar name=Redirecionar>";
  		 	echo "<input name=TxtOpcao type=hidden value='A'>";
 		 	echo "<input name= type=hidden value='" . $row["ID"] . "'>";
  		 	echo "<script>";
  		 	echo "document.Redirecionar.submit()";
  		 	echo "</script>";

		}
	}
	else
	{
		echo '<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>';
	}
}

function ProcessaExclusao($_Mascara)
{

	$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
	$strSQL = "delete from  Inspecao_Itens    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());

	//Bloco que faz voltar para o modo de alteracao da pagina principal

		$strSQL = "SELECT *  from  Inspecao where ID='".$TxtID_INSPECAO."' AND TP_INSPECAO='" . $TxtTP_INSPECAO . "'";
		//SetaDadosAlteracao($strSQL,'FrmCadastroRecadastramentoServidor') ;
		//$TxtOpcao=I2;
		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die('Não pude conectar');
		MYSQL_SELECT_DB($_ENV['NomeBase']);
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{

			$row = mysql_fetch_array($smsecurers);



			//inseri paradar um reload na pagina após a execução desta função...
		 	echo "<form action=FrmCadastroInspecao.php?TxtOpcao=A&Codigo=" . $row["ID"] ." method=get id=Redirecionar name=Redirecionar>";
  		 	echo "<input name=TxtOpcao type=hidden value='A'>";
 		 	echo "<input name=Codigo type=hidden value='" . $row["ID"] . "'>";
  		 	echo "<script>";
  		 	echo "document.Redirecionar.submit()";
  		 	echo "</script>";

		}
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroInspecao_Itens.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroInspecao_Itens.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{



		echo '<script>document.FrmCadastroInspecao_Itens.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_ITENS_INSPECAO,ID_RESULTADO,ID_INSPECAO  from  Inspecao_Itens  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroInspecao_Itens') ;

	echo '<script>document.FrmCadastroInspecao_Itens.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroInspecao_Itens.TxtID_ITENS_INSPECAO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroInspecao_Itens.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroInspecao_Itens method=post action=FrmCadastroInspecao_Itens.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
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
		Pedido.ID = '" . $_GET['Pedido'] . "' and
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
		echo '<input type=hidden name=Pedido value="' . $_GET['Pedido'] . '">';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroInspecao_Itens)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:window.history.go(-1)>';
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
	echo '<form name=FrmCadastroInspecao_Itens method=GET action=FrmCadastroInspecao_Itens.php>';
	ExibeTitulo('Pesquisa ->Inspeção de Ítens');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_ITENS_INSPECAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_RESULTADO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_INSPECAO"] . '</b></td>';
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
	echo '<td class=white><select name=TxtID_INSPECAO>';
	$strSQL = 'select * from Inspecao';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
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
