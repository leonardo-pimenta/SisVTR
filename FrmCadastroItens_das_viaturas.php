<?php
session_start();

include('utilities/check.php');
require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0 width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';

echo '</td>';
echo '<td class=Branco width=50 align=right>';
echo '<a href=default.php>Voltar</A></td>';
echo '</tr></table>';

   CriaFormulario();

function CriaFormulario()
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';

	echo '<form name=FrmCadastroItens_das_viaturas method=post action=FrmCadastroItens_das_viaturas.php?><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Itens de Inspeção das Viaturas';

	if ($TxtOpcao == 'A')
		$Titulo = $Titulo . ' - Alteração';
	if ($TxtOpcao == 'D')
		$Titulo = $Titulo . ' - Exclusão';
	if ($TxtOpcao == 'I')
		$Titulo = $Titulo . ' - Inclusão';
	echo '</td></tr>';

	ExibeTitulo($Titulo);
    echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td colspan=2 class=ColorFormulario><font color=000000><b>Placa</b></font>' ;
    echo '&nbsp;<select name=TxtID_VIATURA>';

	$strSQL = 'select ID,PLACA from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] ;
        echo '>' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td></tr>';

	$strSQL1 = 'select * from `Itens_para_inspecao`';
	$smsecurers1 = mysql_query($strSQL1);
	for ($ts = 1; $ts <= @mysql_affected_rows(); $ts++)
    {
    echo '<tr>';
    echo '<td class=white height=32>Item&nbsp;<select name=TxtID_ITENS_PARA_INSPECAO' .$ts. '>';
   	$row1 = mysql_fetch_array($smsecurers1);
	echo '<option value='. $row1['ID'] . '>' .  $row1['DESCRICAO'] . '</option>';
	echo '</select></td>';
    echo '<td class=white height=32><select name=TxtCONFIRMA'.$ts.'>';
	echo '<option value=1>Sim</option>';
	echo '<option value=0>Nao</option>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroItens_das_viaturas)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()>';
	}
	echo '</td></tr>';
	echo $_SESSION['FechaMoldura'];

	echo '</form>';
}

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_VIATURA,ID_ITENS_PARA_INSPECAO  from  Itens_inspecao_viaturas";
	$NomeForm = "FrmCadastroItens_das_viaturas";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}

function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);

		$smsecurequery = "Select * from Itens_inspecao_viaturas where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Itens_inspecao_viaturas(ID_VIATURA,ID_ITENS_PARA_INSPECAO)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . $TxtID_ITENS_PARA_INSPECAO ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);

		$strSQL = "Update  Itens_inspecao_viaturas set
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',ID_ITENS_PARA_INSPECAO			='" . $TxtID_ITENS_PARA_INSPECAO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Itens_inspecao_viaturas    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroItens_das_viaturas.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_das_viaturas.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroItens_das_viaturas.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,ID_ITENS_PARA_INSPECAO  from  Itens_inspecao_viaturas  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroItens_das_viaturas') ;

	echo '<script>document.FrmCadastroItens_das_viaturas.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_das_viaturas.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroItens_das_viaturas.Submit.value="Alterar"</SCRIPT>';
	}
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
	echo '<form name=FrmCadastroItens_das_viaturas method=GET action=FrmCadastroItens_das_viaturas.php>';
	ExibeTitulo('Pesquisa ->Itens de Inspeção das Viaturas');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_ITENS_PARA_INSPECAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
    echo '<option value =>Todos</option>';
    for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white height=32><select name=TxtID_ITENS_PARA_INSPECAO>';
	$strSQL = 'select * from Itens_para_inspecao';
	$smsecurers = mysql_query($strSQL);
    echo '<option value =>Todos</option>';
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
