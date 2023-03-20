<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_CONTROLE_PECAS"] 	= "Cod. do Controle";
$_Mascara["ID_PECA"] 	= "Peça";
$_Mascara["ID_SITUACAO_PECA"] 	= "Situação da Peça";
$_Mascara["ID_VIATURA"] 	= "Viatura";


$CodigoPagina = 'FrmCadastroPecas_Controle';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroPecas_Controle';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroPecas_Controle.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_VIATURA']))
	$TxtID_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtID_VIATURA']);
else
	$TxtID_VIATURA = '';

if (isset($_GET['TxtID_CONTROLE_PECAS']))
	$TxtID_CONTROLE_PECAS = VerificaInsercoesMaliciosas($_GET['TxtID_CONTROLE_PECAS']);
else
	$TxtID_CONTROLE_PECAS = '';

if (isset($_GET['TxtID_PECA']))
	$TxtID_PECA = VerificaInsercoesMaliciosas($_GET['TxtID_PECA']);
else
	$TxtID_PECA = '';

if (isset($_GET['TxtID_SITUACAO_PECA']))
	$TxtID_SITUACAO_PECA = VerificaInsercoesMaliciosas($_GET['TxtID_SITUACAO_PECA']);
else
	$TxtID_SITUACAO_PECA = '';

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

if ($TxtID_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Pecas_Controle.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtID_CONTROLE_PECAS <> '')
{
	$TxtWhere = $TxtWhere . " AND Pecas_Controle.ID_CONTROLE_PECAS = '" . $TxtID_CONTROLE_PECAS . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_CONTROLE_PECAS"] . " = " . $TxtID_CONTROLE_PECAS;
	$Argumento = $Argumento . "TxtID_CONTROLE_PECAS=".$TxtID_CONTROLE_PECAS . "&";
}

if ($TxtID_PECA <> '')
{
	$TxtWhere = $TxtWhere . " AND Pecas_Controle.ID_PECA = '" . $TxtID_PECA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_PECA"] . " = " . $TxtID_PECA;
	$Argumento = $Argumento . "TxtID_PECA=".$TxtID_PECA . "&";
}

if ($TxtID_SITUACAO_PECA <> '')
{
	$TxtWhere = $TxtWhere . " AND Pecas_Controle.ID_SITUACAO_PECA = '" . $TxtID_SITUACAO_PECA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_SITUACAO_PECA"] . " = " . $TxtID_SITUACAO_PECA;
	$Argumento = $Argumento . "TxtID_SITUACAO_PECA=".$TxtID_SITUACAO_PECA . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Pecas_Controle.ID AS `ID`, Viatura.CODIGO_VIATURA AS `" . $_Mascara['ID_VIATURA'] . "`, Controle_Pecas.ID AS `" . $_Mascara['ID_CONTROLE_PECAS'] . "`, Pecas.DESCRICAO AS `" . $_Mascara['ID_PECA'] . "`, Situacao_Peca.DESCRICAO AS `" . $_Mascara['ID_SITUACAO_PECA'] . "`  from  Pecas_Controle,Viatura,Controle_Pecas,Pecas,Situacao_Peca where 1=1 AND Pecas_Controle.ID_VIATURA = Viatura.ID AND Pecas_Controle.ID_CONTROLE_PECAS = Controle_Pecas.ID AND Pecas_Controle.ID_PECA = Pecas.ID AND Pecas_Controle.ID_SITUACAO_PECA = Situacao_Peca.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroPecas_Controle"," Peças Controle ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_VIATURA,ID_CONTROLE_PECAS,ID_PECA,ID_SITUACAO_PECA  from  Pecas_Controle";
	$NomeForm = "FrmCadastroPecas_Controle";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_CONTROLE_PECAS 	= VerificaInsercoesMaliciosas($_POST['TxtID_CONTROLE_PECAS']);
		$TxtID_PECA 	= VerificaInsercoesMaliciosas($_POST['TxtID_PECA']);
		$TxtID_SITUACAO_PECA 	= VerificaInsercoesMaliciosas($_POST['TxtID_SITUACAO_PECA']);


		$smsecurequery = "Select * from Pecas_Controle where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Pecas_Controle(ID_VIATURA,ID_CONTROLE_PECAS,ID_PECA,ID_SITUACAO_PECA)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . $TxtID_CONTROLE_PECAS ."','" . $TxtID_PECA ."','" . $TxtID_SITUACAO_PECA ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());

		//Bloco que faz voltar para o modo de alteracao da pagina principal

		$strSQL = "SELECT *  from  Controle_Pecas where ID='".$TxtID_CONTROLE_PECAS."' AND ID_VIATURA='" . $TxtID_VIATURA . "'";
		//SetaDadosAlteracao($strSQL,'FrmCadastroRecadastramentoServidor') ;
		//$TxtOpcao=I2;
		//echo $strSQL;
		//Sair();
		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die('Não pude conectar');
		MYSQL_SELECT_DB($_ENV['NomeBase']);
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{

			$row = mysql_fetch_array($smsecurers);



			//inseri paradar um reload na pagina após a execução desta função...
		 	echo "<form action=FrmCadastroControle_Pecas?TxtOpcao=A&Codigo=" . $row["ID"] ." method=get id=Redirecionar name=Redirecionar>";
  		 	echo "<input name=TxtOpcao type=hidden value='A'>";
 		 	echo "<input name=Codigo type=hidden value='" . $row["ID"] . "'>";
  		 	echo "<script>";
  		 	echo "document.Redirecionar.submit()";
  		 	echo "</script>";

		}

	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_CONTROLE_PECAS 	= VerificaInsercoesMaliciosas($_POST['TxtID_CONTROLE_PECAS']);
		$TxtID_PECA 	= VerificaInsercoesMaliciosas($_POST['TxtID_PECA']);
		$TxtID_SITUACAO_PECA 	= VerificaInsercoesMaliciosas($_POST['TxtID_SITUACAO_PECA']);


		$strSQL = "Update  Pecas_Controle set
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',ID_CONTROLE_PECAS			='" . $TxtID_CONTROLE_PECAS .
			"',ID_PECA			='" . $TxtID_PECA .
			"',ID_SITUACAO_PECA			='" . $TxtID_SITUACAO_PECA ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Pecas_Controle    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroPecas_Controle.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroPecas_Controle.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroPecas_Controle.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,ID_CONTROLE_PECAS,ID_PECA,ID_SITUACAO_PECA  from  Pecas_Controle  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroPecas_Controle') ;

	echo '<script>document.FrmCadastroPecas_Controle.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroPecas_Controle.TxtID_CONTROLE_PECAS.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroPecas_Controle.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroPecas_Controle method=post action=FrmCadastroPecas_Controle.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Peças Controle';

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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_CONTROLE_PECAS"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PECA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_SITUACAO_PECA"] . '</b></font></td>';

	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = "select * from Viatura where ID='" .VerificaInsercoesMaliciosas($_GET['ID_VIATURA']) . "'";
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_CONTROLE_PECAS>';
	$strSQL = "select * from Controle_Pecas where ID='" .VerificaInsercoesMaliciosas($_GET['Codigo']) . "'";
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_PECA>';
	$strSQL = 'select * from Pecas where ATIVO="Sim"';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_SITUACAO_PECA>';
	$strSQL = 'select * from Situacao_Peca';
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
		echo "<input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)>";
	}
	else
	{
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroPecas_Controle)>';
		echo "<input type=button name=Submit2 value=Cancelar onclick=javascript:window.history.go(-1)>";
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
	echo '<form name=FrmCadastroPecas_Controle method=GET action=FrmCadastroPecas_Controle.php>';
	ExibeTitulo('Pesquisa ->Peças Controle');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_CONTROLE_PECAS"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_PECA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_SITUACAO_PECA"] . '</b></td>';

	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_CONTROLE_PECAS>';
	$strSQL = 'select * from Controle_Pecas';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_PECA>';
	$strSQL = 'select * from Pecas';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_SITUACAO_PECA>';
	$strSQL = 'select * from Situacao_Peca';
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
