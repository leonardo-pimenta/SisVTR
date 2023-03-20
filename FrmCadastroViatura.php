<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_ACIDENTE"] 	= "";
$_Mascara["ID_SITUACAO"] 	= "Situação";
$_Mascara["PLACA"] 	= "Placa";
$_Mascara["CHASSI"] 	= "Chassi";
$_Mascara["SEGURO"] 	= "Seguro(dd/mm/aaaa)";
$_Mascara["ID_MARCA"] 	= "Marca";
$_Mascara["ID_TIPO"] 	= "Tipo";
$_Mascara["ID_MODELO"] 	= "Modelo";
$_Mascara["ANO"] 	= "Ano";
$_Mascara["COR"] 	= "Cor";
$_Mascara["RENAVAM"] 	= "Renavam";
$_Mascara["OBS"] 	= "Observação";
$_Mascara["CODIGO_VIATURA"] 	= "Código da Viatura";
$_Mascara["ORG_RESP"] 	= "Setor Responsável";
$_Mascara["ODOMETRO"] 	= "Odômetro";

$CodigoPagina = 'FrmCadastroViatura';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroViatura';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroViatura.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtCODIGO_VIATURA']))
	$TxtCODIGO_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtCODIGO_VIATURA']);
else
	$TxtCODIGO_VIATURA = '';

if (isset($_GET['TxtID_SITUACAO']))
	$TxtID_SITUACAO = VerificaInsercoesMaliciosas($_GET['TxtID_SITUACAO']);
else
	$TxtID_SITUACAO = '';

if (isset($_GET['TxtPLACA']))
	$TxtPLACA = VerificaInsercoesMaliciosas($_GET['TxtPLACA']);
else
	$TxtPLACA = '';

if (isset($_GET['TxtCHASSI']))
	$TxtCHASSI = VerificaInsercoesMaliciosas($_GET['TxtCHASSI']);
else
	$TxtCHASSI = '';

if (isset($_GET['TxtSEGURO']))
	$TxtSEGURO = VerificaInsercoesMaliciosas($_GET['TxtSEGURO']);
else
	$TxtSEGURO = '';

if (isset($_GET['TxtID_MARCA']))
	$TxtID_MARCA = VerificaInsercoesMaliciosas($_GET['TxtID_MARCA']);
else
	$TxtID_MARCA = '';

if (isset($_GET['TxtID_TIPO']))
	$TxtID_TIPO = VerificaInsercoesMaliciosas($_GET['TxtID_TIPO']);
else
	$TxtID_TIPO = '';

if (isset($_GET['TxtID_MODELO']))
	$TxtID_MODELO = VerificaInsercoesMaliciosas($_GET['TxtID_MODELO']);
else
	$TxtID_MODELO = '';

if (isset($_GET['TxtANO']))
	$TxtANO = VerificaInsercoesMaliciosas($_GET['TxtANO']);
else
	$TxtANO = '';

if (isset($_GET['TxtCOR']))
	$TxtCOR = VerificaInsercoesMaliciosas($_GET['TxtCOR']);
else
	$TxtCOR = '';

if (isset($_GET['TxtRENAVAM']))
	$TxtRENAVAM = VerificaInsercoesMaliciosas($_GET['TxtRENAVAM']);
else
	$TxtRENAVAM = '';

if (isset($_GET['TxtORG_RESP']))
	$TxtORG_RESP = VerificaInsercoesMaliciosas($_GET['TxtORG_RESP']);
else
	$TxtORG_RESP = '';

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

if ($TxtCODIGO_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.CODIGO_VIATURA = '" . $TxtCODIGO_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["CODIGO_VIATURA"] . " = " . $TxtCODIGO_VIATURA;
	$Argumento = $Argumento . "TxtCODIGO_VIATURA=".$TxtCODIGO_VIATURA . "&";
}

if ($TxtID_SITUACAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID_SITUACAO = '" . $TxtID_SITUACAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_SITUACAO"] . " = " . $TxtID_SITUACAO;
	$Argumento = $Argumento . "TxtID_SITUACAO=".$TxtID_SITUACAO . "&";
}

if ($TxtPLACA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.PLACA = '" . $TxtPLACA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["PLACA"] . " = " . $TxtPLACA;
	$Argumento = $Argumento . "TxtPLACA=".$TxtPLACA . "&";
}

if ($TxtCHASSI <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.CHASSI = '" . $TxtCHASSI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["CHASSI"] . " = " . $TxtCHASSI;
	$Argumento = $Argumento . "TxtCHASSI=".$TxtCHASSI . "&";
}

if ($TxtSEGURO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.SEGURO = '" . $TxtSEGURO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["SEGURO"] . " = " . $TxtSEGURO;
	$Argumento = $Argumento . "TxtSEGURO=".$TxtSEGURO . "&";
}

if ($TxtID_MARCA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID_MARCA = '" . $TxtID_MARCA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_MARCA"] . " = " . $TxtID_MARCA;
	$Argumento = $Argumento . "TxtID_MARCA=".$TxtID_MARCA . "&";
}

if ($TxtID_TIPO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID_TIPO = '" . $TxtID_TIPO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_TIPO"] . " = " . $TxtID_TIPO;
	$Argumento = $Argumento . "TxtID_TIPO=".$TxtID_TIPO . "&";
}

if ($TxtID_MODELO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID_MODELO = '" . $TxtID_MODELO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_MODELO"] . " = " . $TxtID_MODELO;
	$Argumento = $Argumento . "TxtID_MODELO=".$TxtID_MODELO . "&";
}

if ($TxtANO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ANO = '" . $TxtANO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ANO"] . " = " . $TxtANO;
	$Argumento = $Argumento . "TxtANO=".$TxtANO . "&";
}

if ($TxtCOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.COR = '" . $TxtCOR . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["COR"] . " = " . $TxtCOR;
	$Argumento = $Argumento . "TxtCOR=".$TxtCOR . "&";
}

if ($TxtRENAVAM <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.RENAVAM = '" . $TxtRENAVAM . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["RENAVAM"] . " = " . $TxtRENAVAM;
	$Argumento = $Argumento . "TxtRENAVAM=".$TxtRENAVAM . "&";
}

if ($TxtORG_RESP <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ORG_RESP = '" . $TxtORG_RESP . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ORG_RESP"] . " = " . $TxtORG_RESP;
	$Argumento = $Argumento . "TxtORG_RESP=".$TxtORG_RESP . "&";
}

if ($TxtODOMETRO <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ODOMETRO = '" . $TxtODOMETRO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOMETRO"] . " = " . $TxtODOMETRO;
	$Argumento = $Argumento . "TxtODOMETRO=".$TxtODOMETRO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Viatura.ID AS `ID`, Viatura.CODIGO_VIATURA AS `" . $_Mascara['CODIGO_VIATURA'] . "`, Situacao.DESCRICAO AS `" . $_Mascara['ID_SITUACAO'] . "`, Viatura.PLACA AS `" . $_Mascara['PLACA'] . "`, Viatura.SEGURO AS `" . $_Mascara['SEGURO'] . "`, Marca.DESCRICAO AS `" . $_Mascara['ID_MARCA'] . "`, Tipo.DESCRICAO AS `" . $_Mascara['ID_TIPO'] . "`, Modelo.DESCRICAO AS `" . $_Mascara['ID_MODELO'] . "`, Viatura.ANO AS `" . $_Mascara['ANO'] . "`, Viatura.COR AS `" . $_Mascara['COR'] . "`, Viatura.RENAVAM AS `" . $_Mascara['RENAVAM'] . "`, Viatura.ORG_RESP AS `" . $_Mascara['ORG_RESP'] . "`, Viatura.ODOMETRO AS `" . $_Mascara['ODOMETRO'] . "`  from  Viatura,Situacao,Marca,Tipo,Modelo where 1=1 AND Viatura.ID_SITUACAO = Situacao.ID AND Viatura.ID_MARCA = Marca.ID AND Viatura.ID_TIPO = Tipo.ID AND Viatura.ID_MODELO = Modelo.ID " . $TxtWhere ."  ORDER BY CODIGO_VIATURA" ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroViatura"," Viaturas ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT CODIGO_VIATURA,ID_SITUACAO,PLACA,ID_MARCA,ID_TIPO,ID_MODELO,ANO,COR,ORG_RESP,ODOMETRO  from  Viatura";
	$NomeForm = "FrmCadastroViatura";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtCODIGO_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtCODIGO_VIATURA']);
		$TxtID_SITUACAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_SITUACAO']);
		$TxtPLACA 	= VerificaInsercoesMaliciosas($_POST['TxtPLACA']);
		$TxtCHASSI 	= VerificaInsercoesMaliciosas($_POST['TxtCHASSI']);
		$TxtSEGURO 	= VerificaInsercoesMaliciosas($_POST['TxtSEGURO']);
		$TxtID_MARCA 	= VerificaInsercoesMaliciosas($_POST['TxtID_MARCA']);
		$TxtID_TIPO 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO']);
		$TxtID_MODELO 	= VerificaInsercoesMaliciosas($_POST['TxtID_MODELO']);
		$TxtANO 	= VerificaInsercoesMaliciosas($_POST['TxtANO']);
		$TxtCOR 	= VerificaInsercoesMaliciosas($_POST['TxtCOR']);
		$TxtRENAVAM 	= VerificaInsercoesMaliciosas($_POST['TxtRENAVAM']);
		$TxtORG_RESP 	= VerificaInsercoesMaliciosas($_POST['TxtORG_RESP']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtOBS 	= VerificaInsercoesMaliciosas($_POST['TxtOBS']);

		$smsecurequery = "Select * from Viatura where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Viatura(CODIGO_VIATURA,ID_SITUACAO,PLACA,CHASSI,SEGURO,ID_MARCA,ID_TIPO,ID_MODELO,ANO,COR,RENAVAM,ORG_RESP,ODOMETRO,OBS)
		 VALUES
		 ('" . $TxtCODIGO_VIATURA ."','" . $TxtID_SITUACAO ."','" . $TxtPLACA ."','" . $TxtCHASSI ."','" . substr($TxtSEGURO,6,4) . "-" . substr($TxtSEGURO,3,2) . "-" . substr($TxtSEGURO,0,2) ."','" . $TxtID_MARCA ."','" . $TxtID_TIPO ."','" . $TxtID_MODELO ."','" . $TxtANO ."','" . $TxtCOR ."','" . $TxtRENAVAM ."','" . $TxtORG_RESP ."','" . $TxtODOMETRO ."','" . $TxtOBS ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtCODIGO_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtCODIGO_VIATURA']);
		$TxtID_SITUACAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_SITUACAO']);
		$TxtPLACA 	= VerificaInsercoesMaliciosas($_POST['TxtPLACA']);
		$TxtCHASSI 	= VerificaInsercoesMaliciosas($_POST['TxtCHASSI']);
		$TxtSEGURO 	= VerificaInsercoesMaliciosas($_POST['TxtSEGURO']);
		$TxtID_MARCA 	= VerificaInsercoesMaliciosas($_POST['TxtID_MARCA']);
		$TxtID_TIPO 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO']);
		$TxtID_MODELO 	= VerificaInsercoesMaliciosas($_POST['TxtID_MODELO']);
		$TxtANO 	= VerificaInsercoesMaliciosas($_POST['TxtANO']);
		$TxtCOR 	= VerificaInsercoesMaliciosas($_POST['TxtCOR']);
		$TxtRENAVAM 	= VerificaInsercoesMaliciosas($_POST['TxtRENAVAM']);
		$TxtORG_RESP 	= VerificaInsercoesMaliciosas($_POST['TxtORG_RESP']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);
		$TxtOBS 	= VerificaInsercoesMaliciosas($_POST['TxtOBS']);

		$strSQL = "Update  Viatura set 
			CODIGO_VIATURA			='" . $TxtCODIGO_VIATURA .
			"',ID_SITUACAO			='" . $TxtID_SITUACAO .
			"',PLACA			='" . $TxtPLACA .
			"',CHASSI			='" . $TxtCHASSI .
			"',SEGURO			='" . substr($TxtSEGURO,6,4) . "-" . substr($TxtSEGURO,3,2) . "-" . substr($TxtSEGURO,0,2) .
			"',ID_MARCA			='" . $TxtID_MARCA .
			"',ID_TIPO			='" . $TxtID_TIPO .
			"',ID_MODELO			='" . $TxtID_MODELO .
			"',ANO			='" . $TxtANO .
			"',COR			='" . $TxtCOR .
			"',RENAVAM			='" . $TxtRENAVAM .
			"',ORG_RESP			='" . $TxtORG_RESP .
			"',ODOMETRO			='" . $TxtODOMETRO .
			"',OBS			='" . $TxtOBS ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Viatura    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroViatura.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroViatura.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroViatura.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,CODIGO_VIATURA,ID_SITUACAO,PLACA,CHASSI,SEGURO,ID_MARCA,ID_TIPO,ID_MODELO,ANO,COR,RENAVAM,ORG_RESP,ODOMETRO,OBS  from  Viatura  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroViatura') ;

	echo '<script>document.FrmCadastroViatura.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroViatura.TxtID_ACIDENTE.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroViatura.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroViatura method=post action=FrmCadastroViatura.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["CODIGO_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_SITUACAO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCODIGO_VIATURA value="" maxlength=20 size=20></td>';
	echo '<td class=white><select name=TxtID_SITUACAO>';
	$strSQL = 'select * from Situacao';
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["PLACA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["CHASSI"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["SEGURO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtPLACA value="" maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtCHASSI value="" maxlength=30 size=30></td>';
	echo '<td class=white><input type=text name=TxtSEGURO value="" maxlength=10 size=10></td>';
 	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MARCA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_TIPO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MODELO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ANO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_MARCA>';
	$strSQL = 'select * from Marca';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_TIPO>';
	$strSQL = 'select * from Tipo';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_MODELO>';
	$strSQL = 'select * from Modelo';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtANO value="" maxlength=4 size=4></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["COR"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["RENAVAM"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ORG_RESP"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCOR value="" maxlength=20 size=20></td>';
	echo '<td class=white><input type=text name=TxtRENAVAM value="" maxlength=9 size=9></td>';
	echo '<td class=white><input type=text name=TxtORG_RESP value="" maxlength=50 size=30></td>';
	echo '<td class=white><input type=text name=TxtODOMETRO value="" maxlength=8 size=8></td>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroViatura)>';
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
	echo '<form name=FrmCadastroViatura method=GET action=FrmCadastroViatura.php>';
	ExibeTitulo('Pesquisa ->Viaturas');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["CODIGO_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_SITUACAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCODIGO_VIATURA maxlength=20 size=20></td>';
	echo '<td class=white><select name=TxtID_SITUACAO>';
	$strSQL = 'select * from Situacao';
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
	echo '<td class=ColorFormulario><b>' . $_Mascara["PLACA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["CHASSI"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["SEGURO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtPLACA maxlength=8 size=8></td>';
	echo '<td class=white><input type=text name=TxtCHASSI maxlength=30 size=30></td>';
	echo '<td class=white><input type=text name=TxtSEGURO maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_MARCA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_TIPO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_MODELO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ANO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_MARCA>';
	$strSQL = 'select * from Marca';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_TIPO>';
	$strSQL = 'select * from Tipo';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_MODELO>';
	$strSQL = 'select * from Modelo';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtANO maxlength=4 size=4></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["COR"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["RENAVAM"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ORG_RESP"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ODOMETRO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtCOR maxlength=20 size=20></td>';
	echo '<td class=white><input type=text name=TxtRENAVAM maxlength=9 size=9></td>';
	echo '<td class=white><input type=text name=TxtORG_RESP maxlength=50 size=50></td>';
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
