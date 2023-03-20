<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_VIATURA"] 	= "Viatura";
$_Mascara["DATA_INICIO"] 	= "Data de Início";
$_Mascara["DATA_FIM"] 	= "Data do Fim";
$_Mascara["ID_TIPO_REPARO"] 	= "Tipo de Reparo";
$_Mascara["ID_MOTIVO"] 	= "Motivo";
$_Mascara["VALOR_REPARO"] 	= "Valor do Reparo(xx.xx)";
$_Mascara["ID_REPARADOR"] 	= "Reparador";
$_Mascara["ODOMETRO"] 	= "Odômetro";
$_Mascara["OBS"] 	= "Observação";
$_Mascara["N_DOCUMENTO"] 	= "No do Documento";
$_Mascara["QTD_COMBUSTIVEL"] = "Qtd de Combustível";

$CodigoPagina = 'FrmCadastroReparo';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroReparo';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroReparo.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtDATA_INICIO']))
	$TxtDATA_INICIO = VerificaInsercoesMaliciosas($_GET['TxtDATA_INICIO']);
else
	$TxtDATA_INICIO = '';

if (isset($_GET['TxtDATA_FIM']))
	$TxtDATA_FIM = VerificaInsercoesMaliciosas($_GET['TxtDATA_FIM']);
else
	$TxtDATA_FIM = '';

if (isset($_GET['TxtID_TIPO_REPARO']))
	$TxtID_TIPO_REPARO = VerificaInsercoesMaliciosas($_GET['TxtID_TIPO_REPARO']);
else
	$TxtID_TIPO_REPARO = '';

if (isset($_GET['TxtID_MOTIVO']))
	$TxtID_MOTIVO = VerificaInsercoesMaliciosas($_GET['TxtID_MOTIVO']);
else
	$TxtID_MOTIVO = '';

if (isset($_GET['TxtVALOR_REPARO']))
	$TxtVALOR_REPARO = VerificaInsercoesMaliciosas($_GET['TxtVALOR_REPARO']);
else
	$TxtVALOR_REPARO = '';

if (isset($_GET['TxtID_REPARADOR']))
	$TxtID_REPARADOR = VerificaInsercoesMaliciosas($_GET['TxtID_REPARADOR']);
else
	$TxtID_REPARADOR = '';

if (isset($_GET['TxtODOMETRO']))
	$TxtODOMETRO = VerificaInsercoesMaliciosas($_GET['TxtODOMETRO']);
else
	$TxtODOMETRO = '';

if (isset($_GET['TxtN_DOCUMENTO']))
	$TxtN_DOCUMENTO = VerificaInsercoesMaliciosas($_GET['TxtN_DOCUMENTO']);
else
	$TxtN_DOCUMENTO = '';

// Código Alterado pelo Lincoln
if (isset($_GET['TxtQTD_COMBUSTIVEL']))
	$TxtQTD_COMBUSTIVEL = VerificaInsercoesMaliciosas($_GET['TxtQTD_COMBUSTIVEL']);
else
	$TxtQTD_COMBUSTIVEL = '';


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
	$TxtWhere = $TxtWhere . " AND Reparo.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtDATA_INICIO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.DATA_INICIO ='" . substr($TxtDATA_INICIO,6,4) . "-" . substr($TxtDATA_INICIO,3,2) . "-" . substr($TxtDATA_INICIO,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA_INICIO"] . " = " . $TxtDATA_INICIO;
	$Argumento = $Argumento . "TxtDATA_INICIO=".$TxtDATA_INICIO . "&";
}

if ($TxtDATA_FIM <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.DATA_FIM = '" . substr($TxtDATA_FIM,6,4) . "-" . substr($TxtDATA_FIM,3,2) . "-" . substr($TxtDATA_FIM,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA_FIM"] . " = " . $TxtDATA_FIM;
	$Argumento = $Argumento . "TxtDATA_FIM=".$TxtDATA_FIM . "&";
}

if ($TxtID_TIPO_REPARO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.ID_TIPO_REPARO = '" . $TxtID_TIPO_REPARO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_TIPO_REPARO"] . " = " . $TxtID_TIPO_REPARO;
	$Argumento = $Argumento . "TxtID_TIPO_REPARO=".$TxtID_TIPO_REPARO . "&";
}

if ($TxtID_MOTIVO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.ID_MOTIVO = '" . $TxtID_MOTIVO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_MOTIVO"] . " = " . $TxtID_MOTIVO;
	$Argumento = $Argumento . "TxtID_MOTIVO=".$TxtID_MOTIVO . "&";
}

if ($TxtVALOR_REPARO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.VALOR_REPARO = '" . $TxtVALOR_REPARO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["VALOR_REPARO"] . " = " . $TxtVALOR_REPARO;
	$Argumento = $Argumento . "TxtVALOR_REPARO=".$TxtVALOR_REPARO . "&";
}

if ($TxtID_REPARADOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.ID_REPARADOR = '" . $TxtID_REPARADOR . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_REPARADOR"] . " = " . $TxtID_REPARADOR;
	$Argumento = $Argumento . "TxtID_REPARADOR=".$TxtID_REPARADOR . "&";
}

if ($TxtODOMETRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.ODOMETRO = '" . $TxtODOMETRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
}

if ($TxtN_DOCUMENTO <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.N_DOCUMENTO = '" . $TxtN_DOCUMENTO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["N_DOCUMENTO"] . " = " . $TxtN_DOCUMENTO;
	$Argumento = $Argumento . "TxtN_DOCUMENTO=".$TxtN_DOCUMENTO . "&";
}

//Alterado por Lincoln
if ($TxtQTD_COMBUSTIVEL <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparo.QTDCOMBUSTIVEL = '" . $TxtQTD_COMBUSTIVEL . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["QTD_COMBUSTIVEL"] . " = " . $TxtN_DOCUMENTO;
	$Argumento = $Argumento . "TxtQTD_COMBUSTIVEL=".$TxtQTD_COMBUSTIVEL . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Reparo.ID AS `ID`, Viatura.CODIGO_VIATURA AS `" . $_Mascara['ID_VIATURA'] . "`, Reparo.DATA_INICIO AS `" . $_Mascara['DATA_INICIO'] . "`, Reparo.DATA_FIM AS `" . $_Mascara['DATA_FIM'] . "`, Tipo_Reparo.DESCRICAO AS `" . $_Mascara['ID_TIPO_REPARO'] . "`, Motivo_Reparo.DESCRICAO AS `" . $_Mascara['ID_MOTIVO'] . "`, Reparo.VALOR_REPARO AS `" . $_Mascara['VALOR_REPARO'] . "`, Reparador.NOME AS `" . $_Mascara['ID_REPARADOR'] . "`, Reparo.ODOMETRO AS `" . $_Mascara['ODOMETRO'] . "`  from  Reparo,Viatura,Tipo_Reparo,Motivo_Reparo,Reparador where 1=1 AND Reparo.ID_VIATURA = Viatura.ID AND Reparo.ID_TIPO_REPARO = Tipo_Reparo.ID AND Reparo.ID_MOTIVO = Motivo_Reparo.ID AND Reparo.ID_REPARADOR = Reparador.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroReparo"," Reparo ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_VIATURA,DATA_INICIO,DATA_FIM,ID_TIPO_REPARO,ID_MOTIVO,VALOR_REPARO,ID_REPARADOR,ODOMETRO,N_DOCUMENTO,OBS,QTD_COMBUSTIVEL  from  Reparo";
	$NomeForm = "FrmCadastroReparo";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID          	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA  	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDATA_INICIO 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_INICIO']);
		$TxtDATA_FIM    	= VerificaInsercoesMaliciosas($_POST['TxtDATA_FIM']);
		$TxtID_TIPO_REPARO 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO_REPARO']);
		$TxtID_MOTIVO   	= VerificaInsercoesMaliciosas($_POST['TxtID_MOTIVO']);
		$TxtVALOR_REPARO 	= VerificaInsercoesMaliciosas($_POST['TxtVALOR_REPARO']);
		$TxtID_REPARADOR 	= VerificaInsercoesMaliciosas($_POST['TxtID_REPARADOR']);
		$TxtODOMETRO     	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtN_DOCUMENTO 	= VerificaInsercoesMaliciosas($_POST['TxtN_DOCUMENTO']);
		$TxtOBS 	        = VerificaInsercoesMaliciosas($_POST['TxtOBS']);
        $TxtQTD_COMBUSTIVEL = VerificaInsercoesMaliciosas($_POST['TxtQTD_COMBUSTIVEL']);

		$smsecurequery = "Select * from Reparo where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Reparo(ID_VIATURA,DATA_INICIO,DATA_FIM,ID_TIPO_REPARO,ID_MOTIVO,VALOR_REPARO,ID_REPARADOR,ODOMETRO,N_DOCUMENTO,OBS,QTD_COMBUSTIVEL)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . substr($TxtDATA_INICIO,6,4) . "-" . substr($TxtDATA_INICIO,3,2) . "-" . substr($TxtDATA_INICIO,0,2) ."','" . substr($TxtDATA_FIM,6,4) . "-" . substr($TxtDATA_FIM,3,2) . "-" . substr($TxtDATA_FIM,0,2) ."','" . $TxtID_TIPO_REPARO ."','" . $TxtID_MOTIVO ."','" . $TxtVALOR_REPARO ."','" . $TxtID_REPARADOR ."','" . $TxtODOMETRO ."','" . $TxtN_DOCUMENTO ."','" . $TxtOBS ."','" . $TxtQTD_COMBUSTIVEL ."')";

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
		$TxtDATA_INICIO 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_INICIO']);
		$TxtDATA_FIM 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_FIM']);
		$TxtID_TIPO_REPARO 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO_REPARO']);
		$TxtID_MOTIVO 	= VerificaInsercoesMaliciosas($_POST['TxtID_MOTIVO']);
		$TxtVALOR_REPARO 	= VerificaInsercoesMaliciosas($_POST['TxtVALOR_REPARO']);
		$TxtID_REPARADOR 	= VerificaInsercoesMaliciosas($_POST['TxtID_REPARADOR']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtN_DOCUMENTO 	= VerificaInsercoesMaliciosas($_POST['TxtN_DOCUMENTO']);
		$TxtOBS 	= VerificaInsercoesMaliciosas($_POST['TxtOBS']);
        $TxtQTD_COMBUSTIVEL 	= VerificaInsercoesMaliciosas($_POST['TxtQTD_COMBUSTIVEL']);

		$strSQL = "Update  Reparo set
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',DATA_INICIO			='" . substr($TxtDATA_INICIO,6,4) . "-" . substr($TxtDATA_INICIO,3,2) . "-" . substr($TxtDATA_INICIO,0,2) .
			"',DATA_FIM			='" . substr($TxtDATA_FIM,6,4) . "-" . substr($TxtDATA_FIM,3,2) . "-" . substr($TxtDATA_FIM,0,2) .
			"',ID_TIPO_REPARO			='" . $TxtID_TIPO_REPARO .
			"',ID_MOTIVO			='" . $TxtID_MOTIVO .
			"',VALOR_REPARO			='" . $TxtVALOR_REPARO .
			"',ID_REPARADOR			='" . $TxtID_REPARADOR .
			"',ODOMETRO			='" . $TxtODOMETRO .
			"',N_DOCUMENTO			='" . $TxtN_DOCUMENTO .
			"',OBS			='" . $TxtOBS .
			"',QTD_COMBUSTIVEL			='" . $TxtQTD_COMBUSTIVEL ."'  where ID = '" . $TxtID . "'";

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
	$strSQL = "delete from  Reparo    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroReparo.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroReparo.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroReparo.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,DATA_INICIO,DATA_FIM,ID_TIPO_REPARO,ID_MOTIVO,VALOR_REPARO,ID_REPARADOR,ODOMETRO,N_DOCUMENTO,OBS,QTD_COMBUSTIVEL  from  Reparo  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroReparo') ;

	echo '<script>document.FrmCadastroReparo.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroReparo.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroReparo.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroReparo method=post action=FrmCadastroReparo.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Reparo';

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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA_INICIO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA_FIM"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtDATA_INICIO value="" maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtDATA_FIM value="" maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_TIPO_REPARO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MOTIVO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["VALOR_REPARO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_REPARADOR"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_TIPO_REPARO>';
	$strSQL = 'select * from Tipo_Reparo';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_MOTIVO>';
	$strSQL = 'select * from Motivo_Reparo';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtVALOR_REPARO value="" maxlength=22 size=22></td>';
	echo '<td class=white><select name=TxtID_REPARADOR>';
	$strSQL = 'select * from Reparador';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["QTD_COMBUSTIVEL"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["N_DOCUMENTO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtQTD_COMBUSTIVEL value="" maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtN_DOCUMENTO value="" maxlength=20 size=20></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroReparo)>';
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
	echo '<form name=FrmCadastroReparo method=GET action=FrmCadastroReparo.php>';
	ExibeTitulo('Pesquisa ->Reparo');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA_INICIO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA_FIM"] . '</b></td>';
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
	echo '<td class=white><input type=text name=TxtDATA_INICIO maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtDATA_FIM maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_TIPO_REPARO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_MOTIVO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["VALOR_REPARO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_REPARADOR"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_TIPO_REPARO>';
	$strSQL = 'select * from Tipo_Reparo';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_MOTIVO>';
	$strSQL = 'select * from Motivo_Reparo';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtVALOR_REPARO maxlength=22 size=22></td>';
	echo '<td class=white><select name=TxtID_REPARADOR>';
	$strSQL = 'select * from Reparador';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo '</select></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ODOMETRO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["QTD_COMBUSTIVEL"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["N_DOCUMENTO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtODOMETRO maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtQTD_COMBUSTIVEL maxlength=5 size=5></td>';
	echo '<td class=white><input type=text name=TxtN_DOCUMENTO maxlength=20 size=20></td>';
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
