<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_VIATURA"] 	= "Viatura/Placa";
$_Mascara["ID_SVC_PREVENTIVA"] 	= "Serviço Preventivo";
$_Mascara["DATA"] 	= "Data (dd/mm/aaaa)";
$_Mascara["ODOMETRO"] 	= "Odômetro";

$CodigoPagina = 'FrmCadastroViatura_Preventiva';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroViatura_Preventiva';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroViatura_Preventiva.php?Pesquisa=S>Pesquisar</A>';
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
if (isset($_GET['TxtID_SVC_PREVENTIVA']))
	$TxtID_SVC_PREVENTIVA = VerificaInsercoesMaliciosas($_GET['TxtID_SVC_PREVENTIVA']);
else
	$TxtID_SVC_PREVENTIVA = '';

if (isset($_GET['TxtDATA']))
	$TxtDATA = VerificaInsercoesMaliciosas($_GET['TxtDATA']);
else
	$TxtDATA = '';

if (isset($_GET['TxtODOMETRO']))
	$TxtODOMETRO = VerificaInsercoesMaliciosas($_GET['TxtODOMETRO']);
else
	$TxtODOMETRO = '';

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
	$TxtWhere = $TxtWhere . " AND Viatura_Preventiva.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtDATA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura_Preventiva.DATA = '" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA"] . " = " . $TxtDATA;
	$Argumento = $Argumento . "TxtDATA=".$TxtDATA . "&";
}

if ($TxtID_SVC_PREVENTIVA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura_Preventiva.ID_SVC_PREVENTIVA = '" . $TxtID_SVC_PREVENTIVA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_SVC_PREVENTIVA"] . " = " . $TxtID_SVC_PREVENTIVA;
	$Argumento = $Argumento . "TxtID_SVC_PREVENTIVA=".$TxtID_SVC_PREVENTIVA . "&";
}

if ($TxtODOMETRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura_Preventiva.ODOMETRO = '" . $TxtODOMETRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Viatura_Preventiva.ID AS `ID`, CONCAT(Viatura.CODIGO_VIATURA,' - ',Viatura.PLACA) AS `" . $_Mascara['ID_VIATURA'] . "`,Svc_Preventiva.DESCRICAO AS `" . $_Mascara['ID_SVC_PREVENTIVA'] . "`, Viatura_Preventiva.DATA AS `" . $_Mascara['DATA'] . "`, Viatura_Preventiva.ODOMETRO AS `" . $_Mascara['ODOMETRO'] . "`  from  Viatura_Preventiva,Viatura,Svc_Preventiva where 1=1 AND Viatura_Preventiva.ID_VIATURA = Viatura.ID AND Viatura_Preventiva.ID_SVC_PREVENTIVA = Svc_Preventiva.ID " . $TxtWhere . " ORDER BY CODIGO_VIATURA" ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroViatura_Preventiva"," Viaturas ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT ID_VIATURA,DATA,ODOMETRO  from  Viatura_Preventiva";
	$NomeForm = "FrmCadastroViatura_Preventiva";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_SVC_PREVENTIVA 	= VerificaInsercoesMaliciosas($_POST['TxtID_SVC_PREVENTIVA']);
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);

		$smsecurequery = "Select * from Viatura_Preventiva where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Viatura_Preventiva(ID_VIATURA,ID_SVC_PREVENTIVA,DATA,ODOMETRO)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . $TxtID_SVC_PREVENTIVA ."','" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) ."','" . $TxtODOMETRO ."')";

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
		$TxtID_SVC_PREVENTIVA 	= VerificaInsercoesMaliciosas($_POST['TxtID_SVC_PREVENTIVA']);
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);

		$strSQL = "Update  Viatura_Preventiva set 
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',ID_SVC_PREVENTIVA			='" . $TxtID_SVC_PREVENTIVA .
			"',DATA			='" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) .
			"',ODOMETRO			='" . $TxtODOMETRO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Viatura_Preventiva    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroViatura_Preventiva.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroViatura_Preventiva.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroViatura_Preventiva.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,ID_SVC_PREVENTIVA,DATA,ODOMETRO  from  Viatura_Preventiva  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroViatura_Preventiva') ;

	echo '<script>document.FrmCadastroViatura_Preventiva.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroViatura_Preventiva.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroViatura_Preventiva.Submit.value="Alterar"</SCRIPT>';
	}
}


function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroViatura_Preventiva method=post action=FrmCadastroViatura_Preventiva.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Viaturas';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_SVC_PREVENTIVA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_SVC_PREVENTIVA>';
	$strSQL = 'select * from Svc_Preventiva';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo "<td class=white><input type=text name=TxtDATA value='" . date(d) ."/" . date(m) . "/" . date(Y) . "'  maxlength=10 size=10></td>" ;
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroViatura_Preventiva)>';
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
	echo '<form name=FrmCadastroViatura_Preventiva method=GET action=FrmCadastroViatura_Preventiva.php>';
	ExibeTitulo('Pesquisa ->Viaturas');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_SVC_PREVENTIVA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_SVC_PREVENTIVA>';
	$strSQL = 'select * from Svc_Preventiva';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtDATA maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO maxlength=8 size=8></td>';
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
