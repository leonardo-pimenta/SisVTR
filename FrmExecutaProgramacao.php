<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - S�BADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_OM"] 	= "Om";
$_Mascara["ID_DESPACHANTE"] 	= "Despachante";
$_Mascara["ID_MOTORISTA"] 	= "Motorista";
$_Mascara["ID_PROGRAMADOR"] 	= "Programador";
$_Mascara["ID_VIATURA"] 	= "Viatura/Placa";
$_Mascara["RESP_PED"] 	= "Respons�vel";
$_Mascara["DATA_PED"] 	= "Data do Pedido (dd/mm/aaaa)";
$_Mascara["H_PED"] 	= "Hora do Pediddo (hh:mm:ss)";
$_Mascara["DESC_PED"] 	= "Descri��o do Servi�o";
$_Mascara["DESTINO_PED"] 	= "Destino";
$_Mascara["DT_SAI_PREV"] 	= "Data de Sa�da Prevista (dd/mm/aaaa)";
$_Mascara["H_SAI_PREV"] 	= "Hora de Sa�da Prevista (hh:mm:ss)";
$_Mascara["DT_APRES_PREV"] 	= "Data de Apresenta��o Prevista";
$_Mascara["H_APRES_PREV"] 	= "Hora de Apresenta��o Prevista";
$_Mascara["RESP_APRES"] 	= "Repons�vel pela Apresenta��o";
$_Mascara["NR_PESSOAS"] 	= "No de Pessoas";
$_Mascara["DA_SAI"] 	= "Data da Sa�da";
$_Mascara["H_SAI"] 	= "Hora da Sa�da";
$_Mascara["ODOM_SAI"] 	= "Od�metro de Sa�da";
$_Mascara["INSPECAO_SAI"] 	= "Inspe��o de Sa�da";
$_Mascara["DESP_SAI"] 	= "Despachante da Sa�da";
$_Mascara["DT_APRES"] 	= "Data da Apresenta��o";
$_Mascara["H_APRES"] 	= "Hora da Apresenta��o";
$_Mascara["DT_DISP"] 	= "Data da Dispen�a";
$_Mascara["H_DISP"] 	= "Hora da Dispen�a";
$_Mascara["DT_REGRES"] 	= "Data de Regresso";
$_Mascara["H_REGRES"] 	= "Hora do Regresso";
$_Mascara["ODOM_REGRES"] 	= "Od�metro de Regresso";
$_Mascara["INSPECAO_REGRES"] 	= "Inspe��o de Regresso";
$_Mascara["DESP_REGRES"] 	= "Despachante do Regresso";
$_Mascara["ID_TIPO_SERVICO"] 	= "Tipo de Servi�o";
$_Mascara["OBS_DESP_SAI"] 	= "Observa��o Desp. Sa�da";
$_Mascara["OBS_DESP_REGRES"] 	= "Observa��o Desp. Regresso";
$_Mascara["OBS_USUARIO"] 	= "Observa��o do Usu�rio";
$_Mascara["ID_AVALIACAO"] 	= "Avalia��o";

$CodigoPagina = 'FrmExecutaProgramacao';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmExecutaProgramacao';
require('utilities/MinfoAbas.php');
require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmExecutaProgramacao.php?Pesquisa=S>Pesquisar</A>';
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

}
else
{
	if (!$TxtOpcao == '')
	{
		CriaFormulario($_Mascara);
		if ($TxtOpcao == 'A' or $TxtOpcao == 'V')
			EnviaAlteracao();

		sair();
	}
}

if (isset($_GET['TxtID_OM']))
	$TxtID_OM = VerificaInsercoesMaliciosas($_GET['TxtID_OM']);
else
	$TxtID_OM = '';

if (isset($_GET['TxtID_DESPACHANTE']))
	$TxtID_DESPACHANTE = VerificaInsercoesMaliciosas($_GET['TxtID_DESPACHANTE']);
else
	$TxtID_DESPACHANTE = '';
if (isset($_GET['TxtRESP_PED']))
	$TxtRESP_PED = VerificaInsercoesMaliciosas($_GET['TxtRESP_PED']);
else
	$TxtRESP_PED = '';
if (isset($_GET['TxtRESP_APRES']))
	$TxtRESP_APRES = VerificaInsercoesMaliciosas($_GET['TxtRESP_APRES']);
else
	$TxtRESP_APRES = '';

if (isset($_GET['TxtID_PROGRAMADOR']))
	$TxtID_PROGRAMADOR = VerificaInsercoesMaliciosas($_GET['TxtID_PROGRAMADOR']);
else
	$TxtID_PROGRAMADOR = '';

if (isset($_GET['TxtID_MOTORISTA']))
	$TxtID_MOTORISTA = VerificaInsercoesMaliciosas($_GET['TxtID_MOTORISTA']);
else
	$TxtID_MOTORISTA = '';

if (isset($_GET['TxtID_VIATURA']))
	$TxtID_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtID_VIATURA']);
else
	$TxtID_VIATURA = '';

if (isset($_GET['TxtRESP_PED']))
	$TxtRESP_PED = VerificaInsercoesMaliciosas($_GET['TxtRESP_PED']);
else
	$TxtRESP_PED = '';

if (isset($_GET['TxtDATA_PED']))
	$TxtDATA_PED = VerificaInsercoesMaliciosas($_GET['TxtDATA_PED']);
else
	$TxtDATA_PED = '';

if (isset($_GET['TxtH_PED']))
	$TxtH_PED = VerificaInsercoesMaliciosas($_GET['TxtH_PED']);
else
	$TxtH_PED = '';

if (isset($_GET['TxtDESC_PED']))
	$TxtDESC_PED = VerificaInsercoesMaliciosas($_GET['TxtDESC_PED']);
else
	$TxtDESC_PED = '';

if (isset($_GET['TxtDESTINO_PED']))
	$TxtDESTINO_PED = VerificaInsercoesMaliciosas($_GET['TxtDESTINO_PED']);
else
	$TxtDESTINO_PED = '';

if (isset($_GET['TxtDT_SAI_PREV']))
	$TxtDT_SAI_PREV = VerificaInsercoesMaliciosas($_GET['TxtDT_SAI_PREV']);
else
	$TxtDT_SAI_PREV = '';

if (isset($_GET['TxtH_SAI_PREV']))
	$TxtH_SAI_PREV = VerificaInsercoesMaliciosas($_GET['TxtH_SAI_PREV']);
else
	$TxtH_SAI_PREV = '';

if (isset($_GET['TxtDT_APRES_PREV']))
	$TxtDT_APRES_PREV = VerificaInsercoesMaliciosas($_GET['TxtDT_APRES_PREV']);
else
	$TxtDT_APRES_PREV = '';

if (isset($_GET['TxtH_APRES_PREV']))
	$TxtH_APRES_PREV = VerificaInsercoesMaliciosas($_GET['TxtH_APRES_PREV']);
else
	$TxtH_APRES_PREV = '';

if (isset($_GET['TxtRESP_APRES']))
	$TxtRESP_APRES = VerificaInsercoesMaliciosas($_GET['TxtRESP_APRES']);
else
	$TxtRESP_APRES = '';

if (isset($_GET['TxtNR_PESSOAS']))
	$TxtNR_PESSOAS = VerificaInsercoesMaliciosas($_GET['TxtNR_PESSOAS']);
else
	$TxtNR_PESSOAS = '';

if (isset($_GET['TxtDA_SAI']))
	$TxtDA_SAI = VerificaInsercoesMaliciosas($_GET['TxtDA_SAI']);
else
	$TxtDA_SAI = '';

if (isset($_GET['TxtH_SAI']))
	$TxtH_SAI = VerificaInsercoesMaliciosas($_GET['TxtH_SAI']);
else
	$TxtH_SAI = '';

if (isset($_GET['TxtODOM_SAI']))
	$TxtODOM_SAI = VerificaInsercoesMaliciosas($_GET['TxtODOM_SAI']);
else
	$TxtODOM_SAI = '';

if (isset($_GET['TxtINSPECAO_SAI']))
	$TxtINSPECAO_SAI = VerificaInsercoesMaliciosas($_GET['TxtINSPECAO_SAI']);
else
	$TxtINSPECAO_SAI = '';

if (isset($_GET['TxtDESP_SAI']))
	$TxtDESP_SAI = VerificaInsercoesMaliciosas($_GET['TxtDESP_SAI']);
else
	$TxtDESP_SAI = '';

if (isset($_GET['TxtDT_APRES']))
	$TxtDT_APRES = VerificaInsercoesMaliciosas($_GET['TxtDT_APRES']);
else
	$TxtDT_APRES = '';

if (isset($_GET['TxtH_APRES']))
	$TxtH_APRES = VerificaInsercoesMaliciosas($_GET['TxtH_APRES']);
else
	$TxtH_APRES = '';

if (isset($_GET['TxtDT_DISP']))
	$TxtDT_DISP = VerificaInsercoesMaliciosas($_GET['TxtDT_DISP']);
else
	$TxtDT_DISP = '';

if (isset($_GET['TxtH_DISP']))
	$TxtH_DISP = VerificaInsercoesMaliciosas($_GET['TxtH_DISP']);
else
	$TxtH_DISP = '';

if (isset($_GET['TxtDT_REGRES']))
	$TxtDT_REGRES = VerificaInsercoesMaliciosas($_GET['TxtDT_REGRES']);
else
	$TxtDT_REGRES = '';

if (isset($_GET['TxtH_REGRES']))
	$TxtH_REGRES = VerificaInsercoesMaliciosas($_GET['TxtH_REGRES']);
else
	$TxtH_REGRES = '';

if (isset($_GET['TxtODOM_REGRES']))
	$TxtODOM_REGRES = VerificaInsercoesMaliciosas($_GET['TxtODOM_REGRES']);
else
	$TxtODOM_REGRES = '';

if (isset($_GET['TxtINSPECAO_REGRES']))
	$TxtINSPECAO_REGRES = VerificaInsercoesMaliciosas($_GET['TxtINSPECAO_REGRES']);
else
	$TxtINSPECAO_REGRES = '';

if (isset($_GET['TxtDESP_REGRES']))
	$TxtDESP_REGRES = VerificaInsercoesMaliciosas($_GET['TxtDESP_REGRES']);
else
	$TxtDESP_REGRES = '';

if (isset($_GET['TxtID_TIPO_SERVICO']))
	$TxtID_TIPO_SERVICO = VerificaInsercoesMaliciosas($_GET['TxtID_TIPO_SERVICO']);
else
	$TxtID_TIPO_SERVICO = '';

if (isset($_GET['TxtOBS_DESP_SAI']))
	$TxtOBS_DESP_SAI = VerificaInsercoesMaliciosas($_GET['TxtOBS_DESP_SAI']);
else
	$TxtOBS_DESP_SAI = '';

if (isset($_GET['TxtOBS_DESP_REGRES']))
	$TxtOBS_DESP_REGRES = VerificaInsercoesMaliciosas($_GET['TxtOBS_DESP_REGRES']);
else
	$TxtOBS_DESP_REGRES = '';

if (isset($_GET['TxtOBS_USUARIO']))
	$TxtOBS_USUARIO = VerificaInsercoesMaliciosas($_GET['TxtOBS_USUARIO']);
else
	$TxtOBS_USUARIO = '';

if (isset($_GET['TxtID_AVALIACAO']))
	$TxtID_AVALIACAO = VerificaInsercoesMaliciosas($_GET['TxtID_AVALIACAO']);
else
	$TxtID_AVALIACAO = '';

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

if ($TxtID_OM <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_OM = '" . $TxtID_OM . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_OM"] . " = " . $TxtID_OM;
	$Argumento = $Argumento . "TxtID_OM=".$TxtID_OM . "&";
}

if ($TxtID_DESPACHANTE <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_DESPACHANTE = '" . $TxtID_DESPACHANTE . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_DESPACHANTE"] . " = " . $TxtID_DESPACHANTE;
	$Argumento = $Argumento . "TxtID_DESPACHANTE=".$TxtID_DESPACHANTE . "&";
}

if ($TxtID_PROGRAMADOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_PROGRAMADOR = '" . $TxtID_PROGRAMADOR . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_PROGRAMADOR"] . " = " . $TxtID_PROGRAMADOR;
	$Argumento = $Argumento . "TxtID_PROGRAMADOR=".$TxtID_PROGRAMADOR . "&";
}

if ($TxtID_MOTORISTA <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_MOTORISTA = '" . $TxtID_MOTORISTA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_MOTORISTA"] . " = " . $TxtID_MOTORISTA;
	$Argumento = $Argumento . "TxtID_MOTORISTA=".$TxtID_MOTORISTA . "&";
}

if ($TxtID_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtRESP_PED <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.RESP_PED = '" . $TxtRESP_PED . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["RESP_PED"] . " = " . $TxtRESP_PED;
	$Argumento = $Argumento . "TxtRESP_PED=".$TxtRESP_PED . "&";
}

if ($TxtDATA_PED <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DATA_PED = '" . $TxtDATA_PED . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA_PED"] . " = " . $TxtDATA_PED;
	$Argumento = $Argumento . "TxtDATA_PED=".$TxtDATA_PED . "&";
}

if ($TxtH_PED <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_PED = '" . $TxtH_PED . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_PED"] . " = " . $TxtH_PED;
	$Argumento = $Argumento . "TxtH_PED=".$TxtH_PED . "&";
}

if ($TxtDESC_PED <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DESC_PED = '" . $TxtDESC_PED . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESC_PED"] . " = " . $TxtDESC_PED;
	$Argumento = $Argumento . "TxtDESC_PED=".$TxtDESC_PED . "&";
}

if ($TxtDESTINO_PED <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DESTINO_PED = '" . $TxtDESTINO_PED . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESTINO_PED"] . " = " . $TxtDESTINO_PED;
	$Argumento = $Argumento . "TxtDESTINO_PED=".$TxtDESTINO_PED . "&";
}

if ($TxtDT_SAI_PREV <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DT_SAI_PREV = '" . $TxtDT_SAI_PREV . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DT_SAI_PREV"] . " = " . $TxtDT_SAI_PREV;
	$Argumento = $Argumento . "TxtDT_SAI_PREV=".$TxtDT_SAI_PREV . "&";
}

if ($TxtH_SAI_PREV <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_SAI_PREV = '" . $TxtH_SAI_PREV . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_SAI_PREV"] . " = " . $TxtH_SAI_PREV;
	$Argumento = $Argumento . "TxtH_SAI_PREV=".$TxtH_SAI_PREV . "&";
}

if ($TxtDT_APRES_PREV <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DT_APRES_PREV = '" . $TxtDT_APRES_PREV . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DT_APRES_PREV"] . " = " . $TxtDT_APRES_PREV;
	$Argumento = $Argumento . "TxtDT_APRES_PREV=".$TxtDT_APRES_PREV . "&";
}

if ($TxtH_APRES_PREV <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_APRES_PREV = '" . $TxtH_APRES_PREV . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_APRES_PREV"] . " = " . $TxtH_APRES_PREV;
	$Argumento = $Argumento . "TxtH_APRES_PREV=".$TxtH_APRES_PREV . "&";
}

if ($TxtRESP_APRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.RESP_APRES = '" . $TxtRESP_APRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["RESP_APRES"] . " = " . $TxtRESP_APRES;
	$Argumento = $Argumento . "TxtRESP_APRES=".$TxtRESP_APRES . "&";
}

if ($TxtNR_PESSOAS <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.NR_PESSOAS = '" . $TxtNR_PESSOAS . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NR_PESSOAS"] . " = " . $TxtNR_PESSOAS;
	$Argumento = $Argumento . "TxtNR_PESSOAS=".$TxtNR_PESSOAS . "&";
}

if ($TxtDA_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DA_SAI = '" . $TxtDA_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DA_SAI"] . " = " . $TxtDA_SAI;
	$Argumento = $Argumento . "TxtDA_SAI=".$TxtDA_SAI . "&";
}

if ($TxtH_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_SAI = '" . $TxtH_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_SAI"] . " = " . $TxtH_SAI;
	$Argumento = $Argumento . "TxtH_SAI=".$TxtH_SAI . "&";
}

if ($TxtODOM_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ODOM_SAI = '" . $TxtODOM_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOM_SAI"] . " = " . $TxtODOM_SAI;
	$Argumento = $Argumento . "TxtODOM_SAI=".$TxtODOM_SAI . "&";
}

if ($TxtINSPECAO_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.INSPECAO_SAI = '" . $TxtINSPECAO_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["INSPECAO_SAI"] . " = " . $TxtINSPECAO_SAI;
	$Argumento = $Argumento . "TxtINSPECAO_SAI=".$TxtINSPECAO_SAI . "&";
}

if ($TxtDESP_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DESP_SAI = '" . $TxtDESP_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESP_SAI"] . " = " . $TxtDESP_SAI;
	$Argumento = $Argumento . "TxtDESP_SAI=".$TxtDESP_SAI . "&";
}

if ($TxtDT_APRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DT_APRES = '" . $TxtDT_APRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DT_APRES"] . " = " . $TxtDT_APRES;
	$Argumento = $Argumento . "TxtDT_APRES=".$TxtDT_APRES . "&";
}

if ($TxtH_APRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_APRES = '" . $TxtH_APRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_APRES"] . " = " . $TxtH_APRES;
	$Argumento = $Argumento . "TxtH_APRES=".$TxtH_APRES . "&";
}

if ($TxtDT_DISP <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DT_DISP = '" . $TxtDT_DISP . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DT_DISP"] . " = " . $TxtDT_DISP;
	$Argumento = $Argumento . "TxtDT_DISP=".$TxtDT_DISP . "&";
}

if ($TxtH_DISP <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_DISP = '" . $TxtH_DISP . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_DISP"] . " = " . $TxtH_DISP;
	$Argumento = $Argumento . "TxtH_DISP=".$TxtH_DISP . "&";
}

if ($TxtDT_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DT_REGRES = '" . $TxtDT_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DT_REGRES"] . " = " . $TxtDT_REGRES;
	$Argumento = $Argumento . "TxtDT_REGRES=".$TxtDT_REGRES . "&";
}

if ($TxtH_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.H_REGRES = '" . $TxtH_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["H_REGRES"] . " = " . $TxtH_REGRES;
	$Argumento = $Argumento . "TxtH_REGRES=".$TxtH_REGRES . "&";
}

if ($TxtODOM_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ODOM_REGRES = '" . $TxtODOM_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ODOM_REGRES"] . " = " . $TxtODOM_REGRES;
	$Argumento = $Argumento . "TxtODOM_REGRES=".$TxtODOM_REGRES . "&";
}

if ($TxtINSPECAO_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.INSPECAO_REGRES = '" . $TxtINSPECAO_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["INSPECAO_REGRES"] . " = " . $TxtINSPECAO_REGRES;
	$Argumento = $Argumento . "TxtINSPECAO_REGRES=".$TxtINSPECAO_REGRES . "&";
}

if ($TxtDESP_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.DESP_REGRES = '" . $TxtDESP_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DESP_REGRES"] . " = " . $TxtDESP_REGRES;
	$Argumento = $Argumento . "TxtDESP_REGRES=".$TxtDESP_REGRES . "&";
}

if ($TxtID_TIPO_SERVICO <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_TIPO_SERVICO = '" . $TxtID_TIPO_SERVICO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_TIPO_SERVICO"] . " = " . $TxtID_TIPO_SERVICO;
	$Argumento = $Argumento . "TxtID_TIPO_SERVICO=".$TxtID_TIPO_SERVICO . "&";
}

if ($TxtOBS_DESP_SAI <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.OBS_DESP_SAI = '" . $TxtOBS_DESP_SAI . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["OBS_DESP_SAI"] . " = " . $TxtOBS_DESP_SAI;
	$Argumento = $Argumento . "TxtOBS_DESP_SAI=".$TxtOBS_DESP_SAI . "&";
}

if ($TxtOBS_DESP_REGRES <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.OBS_DESP_REGRES = '" . $TxtOBS_DESP_REGRES . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["OBS_DESP_REGRES"] . " = " . $TxtOBS_DESP_REGRES;
	$Argumento = $Argumento . "TxtOBS_DESP_REGRES=".$TxtOBS_DESP_REGRES . "&";
}

if ($TxtOBS_USUARIO <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.OBS_USUARIO = '" . $TxtOBS_USUARIO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["OBS_USUARIO"] . " = " . $TxtOBS_USUARIO;
	$Argumento = $Argumento . "TxtOBS_USUARIO=".$TxtOBS_USUARIO . "&";
}

if ($TxtID_AVALIACAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Pedido.ID_AVALIACAO = '" . $TxtID_AVALIACAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_AVALIACAO"] . " = " . $TxtID_AVALIACAO;
	$Argumento = $Argumento . "TxtID_AVALIACAO=".$TxtID_AVALIACAO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Pedido.ID AS `ID`,concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Pedido.ID) AS `Pedido No`,  concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Om.SIGLA) AS `" . $_Mascara['ID_OM'] . "`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Pedido.RESP_APRES) AS `" . $_Mascara['RESP_APRES'] . "`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), DT_APRES_PREV,' - ',H_APRES_PREV) AS `Data/Hora Apresenta��o`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), DT_SAI_PREV,' - ',H_SAI_PREV) AS `Data/Hora Sa�da`  from  Pedido,Om where 1=1 AND Pedido.ID_OM = Om.ID and H_REGRES=' . 00:00:00 . '" . $TxtWhere ." ORDER BY DT_APRES_PREV DESC" ;

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
	echo '<script> alert("N�o Existem Pesquisas Dispon�veis Para Esse Formul�rio!");</script>';
}
//
//	echo $smsecurequery;
//exit;
	ExibeDados_Quebrando($smsecurequery,9,"FrmExecutaProgramacao"," Programa��o ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
	echo "<font size=2 color=red><center>-Pedidos em cinza s�o pedios j� programados.</center></font>";
	//echo $smsecurequery;
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA  from  Pedido";
	$NomeForm = "FrmExecutaProgramacao";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_OM 	= VerificaInsercoesMaliciosas($_POST['TxtID_OM']);
		$TxtRESP_PED 	= VerificaInsercoesMaliciosas($_POST['TxtRESP_PED']);
		$TxtID_TIPO_SERVICO 	= VerificaInsercoesMaliciosas($_POST['TxtID_TIPO_SERVICO']);
		$TxtNR_PESSOAS 	= VerificaInsercoesMaliciosas($_POST['TxtNR_PESSOAS']);
		$TxtDATA_PED 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_PED']);
		$TxtH_PED 	= VerificaInsercoesMaliciosas($_POST['TxtH_PED']);
		$TxtID_DESPACHANTE 	= VerificaInsercoesMaliciosas($_POST['TxtID_DESPACHANTE']);
		$TxtDT_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_SAI_PREV']);
		$TxtH_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI_PREV']);
		$TxtDT_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES_PREV']);
		$TxtH_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES_PREV']);
		$TxtID_PROGRAMADOR 	= VerificaInsercoesMaliciosas($_POST['TxtID_PROGRAMADOR']);
		$TxtID_MOTORISTA 	= VerificaInsercoesMaliciosas($_POST['TxtID_MOTORISTA']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDESC_PED 	= VerificaInsercoesMaliciosas($_POST['TxtDESC_PED']);
		$TxtDESTINO_PED 	= VerificaInsercoesMaliciosas($_POST['TxtDESTINO_PED']);
		$TxtRESP_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtRESP_APRES']);
		$TxtDA_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDA_SAI']);
		$TxtH_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI']);
		$TxtODOM_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_SAI']);
		$TxtINSPECAO_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_SAI']);
		$TxtDESP_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_SAI']);
		$TxtDT_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES']);
		$TxtH_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES']);
		$TxtDT_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtDT_DISP']);
		$TxtH_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtH_DISP']);
		$TxtDT_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_REGRES']);
		$TxtH_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_REGRES']);
		$TxtODOM_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_REGRES']);
		$TxtINSPECAO_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_REGRES']);
		$TxtDESP_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_REGRES']);
		$TxtOBS_DESP_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_DESP_SAI']);
		$TxtOBS_DESP_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_DESP_REGRES']);
		$TxtID_AVALIACAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_AVALIACAO']);
		$TxtOBS_USUARIO 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_USUARIO']);

		$smsecurequery = "Select * from Pedido where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>J� existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Pedido(ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_DESPACHANTE,DT_SAI_PREV,H_SAI_PREV,DT_APRES_PREV,H_APRES_PREV,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DA_SAI,H_SAI,ODOM_SAI,INSPECAO_SAI,DESP_SAI,DT_APRES,H_APRES,DT_DISP,H_DISP,DT_REGRES,H_REGRES,ODOM_REGRES,INSPECAO_REGRES,DESP_REGRES,OBS_DESP_SAI,OBS_DESP_REGRES,ID_AVALIACAO,OBS_USUARIO)
		 VALUES
		 ('" . $TxtID_OM ."','" . $TxtRESP_PED ."','" . $TxtID_TIPO_SERVICO ."','" . $TxtNR_PESSOAS ."','" . substr($TxtDATA_PED,6,4) . "-" . substr($TxtDATA_PED,3,2) . "-" . substr($TxtDATA_PED,0,2) ."','" . $TxtH_PED ."','" . $TxtID_DESPACHANTE ."','" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) ."','" . $TxtH_SAI_PREV ."','" . substr($TxtDT_APRES_PREV,6,4) . "-" . substr($TxtDT_APRES_PREV,3,2) . "-" . substr($TxtDT_APRES_PREV,0,2) ."','" . $TxtH_APRES_PREV ."','" . $TxtID_PROGRAMADOR ."','" . $TxtID_MOTORISTA ."','" . $TxtID_VIATURA ."','" . $TxtDESC_PED ."','" . $TxtDESTINO_PED ."','" . $TxtRESP_APRES ."','" . substr($TxtDA_SAI,6,4) . "-" . substr($TxtDA_SAI,3,2) . "-" . substr($TxtDA_SAI,0,2) ."','" . $TxtH_SAI ."','" . $TxtODOM_SAI ."','" . $TxtINSPECAO_SAI ."','" . $TxtDESP_SAI ."','" . substr($TxtDT_APRES,6,4) . "-" . substr($TxtDT_APRES,3,2) . "-" . substr($TxtDT_APRES,0,2) ."','" . $TxtH_APRES ."','" . substr($TxtDT_DISP,6,4) . "-" . substr($TxtDT_DISP,3,2) . "-" . substr($TxtDT_DISP,0,2) ."','" . $TxtH_DISP ."','" . substr($TxtDT_REGRES,6,4) . "-" . substr($TxtDT_REGRES,3,2) . "-" . substr($TxtDT_REGRES,0,2) ."','" . $TxtH_REGRES ."','" . $TxtODOM_REGRES ."','" . $TxtINSPECAO_REGRES ."','" . $TxtDESP_REGRES ."','" . $TxtOBS_DESP_SAI ."','" . $TxtOBS_DESP_REGRES ."','" . $TxtID_AVALIACAO ."','" . $TxtOBS_USUARIO ."')";

		$strSQL2 = "Update  Viatura set
			ODOMETRO			='" . $TxtODOM_REGRES .	"' where ID = '" . $TxtID_VIATURA . "'";



		$smsecurers = mysql_query($strSQL);
	$smsecurers = mysql_query($strSQL2);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);

		$TxtID_DESPACHANTE 	= VerificaInsercoesMaliciosas($_POST['TxtID_DESPACHANTE']);
		$TxtDT_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_SAI_PREV']);
		$TxtH_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI_PREV']);
		$TxtDT_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES_PREV']);
		$TxtH_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES_PREV']);
		$TxtID_PROGRAMADOR 	= VerificaInsercoesMaliciosas($_POST['TxtID_PROGRAMADOR']);
		$TxtID_MOTORISTA 	= VerificaInsercoesMaliciosas($_POST['TxtID_MOTORISTA']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtRESP_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtRESP_APRES']);
		$TxtDA_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDA_SAI']);
		$TxtH_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI']);
		$TxtODOM_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_SAI']);
		$TxtINSPECAO_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_SAI']);
		$TxtDESP_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_SAI']);
		$TxtDT_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES']);
		$TxtH_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES']);
		$TxtDT_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtDT_DISP']);
		$TxtH_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtH_DISP']);
		$TxtDT_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_REGRES']);
		$TxtH_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_REGRES']);
		$TxtODOM_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_REGRES']);
		$TxtINSPECAO_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_REGRES']);
		$TxtDESP_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_REGRES']);

		$strSQL2 = "Update  Viatura set
			ODOMETRO			='" . $TxtODOM_REGRES .	"' where ID = '" . $TxtID_VIATURA . "'";



		$strSQL = "Update  Pedido set
			ID_DESPACHANTE			='" . $TxtID_DESPACHANTE .
			"',DT_SAI_PREV			='" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) .
			"',H_SAI_PREV			='" . $TxtH_SAI_PREV .
			"',DT_APRES_PREV			='" . substr($TxtDT_APRES_PREV,6,4) . "-" . substr($TxtDT_APRES_PREV,3,2) . "-" . substr($TxtDT_APRES_PREV,0,2) .
			"',H_APRES_PREV			='" . $TxtH_APRES_PREV .
			"',ID_PROGRAMADOR			='" . $TxtID_PROGRAMADOR .
			"',ID_MOTORISTA			='" . $TxtID_MOTORISTA .
			"',ID_VIATURA			='" . $TxtID_VIATURA .
			"',DA_SAI			='" . substr($TxtDA_SAI,6,4) . "-" . substr($TxtDA_SAI,3,2) . "-" . substr($TxtDA_SAI,0,2) .
			"',H_SAI			='" . $TxtH_SAI .
			"',ODOM_SAI			='" . $TxtODOM_SAI .
			"',INSPECAO_SAI			='" . $TxtINSPECAO_SAI .
			"',DESP_SAI			='" . $TxtDESP_SAI .
			"',DT_APRES			='" . substr($TxtDT_APRES,6,4) . "-" . substr($TxtDT_APRES,3,2) . "-" . substr($TxtDT_APRES,0,2) .
			"',H_APRES			='" . $TxtH_APRES .
			"',DT_DISP			='" . substr($TxtDT_DISP,6,4) . "-" . substr($TxtDT_DISP,3,2) . "-" . substr($TxtDT_DISP,0,2) .
			"',H_DISP			='" . $TxtH_DISP .
			"',DT_REGRES			='" . substr($TxtDT_REGRES,6,4) . "-" . substr($TxtDT_REGRES,3,2) . "-" . substr($TxtDT_REGRES,0,2) .
			"',H_REGRES			='" . $TxtH_REGRES .
			"',ODOM_REGRES			='" . $TxtODOM_REGRES .
			"',INSPECAO_REGRES			='" . $TxtINSPECAO_REGRES .
			"',DESP_REGRES			='" . $TxtDESP_REGRES . "'  where ID = '" . $TxtID . "'";


  $strSQLver ="select * from Pedido where DT_SAI_PREV= '" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) . "' and ID_VIATURA= '" . $TxtID_VIATURA . "' and ID <> '" . $TxtID . "'";
				$smsecurers1 = mysql_query($strSQLver);
				$nreg=@mysql_affected_rows();
				if($nreg>0)
				{
					?><script>
                                  				//window.open("datas.php?TxtVIATURA=" + '"$TxtID_VIATURA"',"datas","toolbar=no,location=no,derectories=no,status=no,menubar=no,scrollbars=no,resizable=no,top=5,left=5,width=300,height=50");
												var agree=confirm("J� exixtem programa��es futuras para esta viatura ou a mesma est� em uso...\n\nConfira na janela ao lado as datas programadas para esta viatura.\n\nConfirma Programa��o?");
												//flush();

												if (!agree)
												{
													window.history.go(-1);

												}




					</script><?
				}



		if(($TxtODOM_REGRES=="")||($TxtODOM_REGRES==0))
		{
					if($TxtDT_APRES_PREV>$TxtDT_SAI_PREV)
					{

						?><script>
							var agree=confirm("Data de Apresentacao Prevista MAIOR que data de Saida Prevista! Confirma?");

							if (!agree)
							{
								window.history.go(-1);

							}
						</script><?

	    			}




		}
		else
		{

					if($TxtDT_APRES>$TxtDA_SAI)
					{
						?><script>alert("Data de Apresentacao MAIOR que data de Saida!");window.history.go(-1);</script><?
					}
					if($TxtDT_APRES>$TxtDT_DISP)
					{
						?><script>alert("Data de Apresentacao MAIOR que data de Dispensa!");window.history.go(-1);</script><?
					}
					if($TxtDA_SAI>$TxtDT_DISP)
					{
						?><script>alert("Data de Saida MAIOR que data de Dispensa!");window.history.go(-1);</script><?
					}
					if($TxtDT_APRES>$TxtDT_REGRES)
					{
						?><script>alert("Data de Apresentacao MAIOR que data de Regresso!");window.history.go(-1);</script><?
					}
					if($TxtDA_SAI>$TxtDT_REGRES)
					{
											?><script>alert("Data de Saida MAIOR que data de Regresso!");window.history.go(-1);</script><?
					}
					if($TxtDT_DISP>$TxtDT_REGRES)
					{
						?><script>alert("Data de Dispensa MAIOR que data de Regresso!");window.history.go(-1);</script><?
					}
					if($TxtODOM_SAI>$TxtODOM_REGRES)
					{
						?><script>alert("Odometro de Saida MAIOR que odometro de Regresso!");window.history.go(-1);</script><?
					}
		}


		$smsecurers = mysql_query($strSQL);
		$registros=@mysql_affected_rows();
		//echo $TxtDA_SAI ."-".  $TxtDT_DISP;
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());
		if(@mysql_affected_rows()>0)
							{
							//echo "<center><a href=FrmCadastroInspecao_Itens.php?TxtOpcao=I&TP_INSPECAO='" . $row1["TP_INSPECAO"] . "'&Codigo='" . $row1["ID"] . "' ><b>Inspecionar �tem</center></b></a>";
												//echo "<form name=FrmCadastroInspecao2 method=post action=FrmCadastroInspecao_Pedido.php?TxtOpcao=I&npedido=" . $TxtID . ">";
												//echo '<center><input type=Submit name=Submit3 value=Fazer&nbsp;Inspe��o></center></form>';
		}
		if(($TxtODOM_REGRES<>"")||($TxtODOM_REGRES<>0))
		{
			$smsecurers = mysql_query($strSQL2);
			//VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());
		}
	if($registros==1)
	{

	//EMISS�O DO BDT!

			require("Lib/MinfoRelatorio.php");
			include("Lib/MinfoMsg.php");


			$strSQLBDT =  "Select * from Pedido where ID = '" . $TxtID . "'";
				$smsecurersBDT = mysql_query($strSQLBDT);
				for ($t = 1; $t <= @mysql_affected_rows(); $t++)
				{
					$rowBDT = mysql_fetch_array($smsecurersBDT);
					if(($rowBDT['DT_REGRES']=='0000-00-00')&&($rowBDT['H_REGRES']=='00:00:00'))
					{

						$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioBDT'.date("dmY")."-".rand(1,1000).".rtf";
						$MASCARA_RELATORIO='relatorios/RelatorioBDT.rel';

		 				$ag1= new aguarde("Por favor, aguarde;<BR>Emitindo BDT...<BR>");;
	  					$ag1->abre();    /* Mensagem de "Aguarde..." */

		    			$smsecurequery = "Select Pedido.ID AS `ID`,Pedido.ID AS `Pedido No`,Motorista.NOME_GUERRA AS `MOTORISTA`,Om.SIGLA AS `OM`,Om.DESCRICAO AS `OM_DESC`,CONCAT(SUBSTRING(DATA_PED,9,2),'-',SUBSTRING(DATA_PED,6,2),'-',SUBSTRING(DATA_PED,1,4)) AS `DATA`,DAYOFMONTH(CURDATE()) AS `DIA`,MONTH(CURDATE()) AS `MES`,YEAR(CURDATE()) AS `ANO`,Pedido.RESP_APRES AS `RESP_APRES`,Pedido.RESP_PED AS `RESPONSAVEL`,Tipo.DESCRICAO AS `TIPO`,Viatura.PLACA AS `PLACA`,Pedido.DESC_PED AS `SERVICO`,Pedido.DESTINO_PED AS `DESTINO`,CONCAT(SUBSTRING(DT_APRES_PREV,9,2),'-',SUBSTRING(DT_APRES_PREV,6,2),'-',SUBSTRING(DT_APRES_PREV,1,4)) AS `DATA_PREV_APRES`,H_APRES_PREV AS `HORA_PREV_APRES`,CONCAT(SUBSTRING(DT_SAI_PREV,9,2),'-',SUBSTRING(DT_SAI_PREV,6,2),'-',SUBSTRING(DT_SAI_PREV,1,4)) AS `DATA_PREV_SAIDA`,H_SAI_PREV AS `HORA_PREV_SAIDA`  from  Pedido,Om,Tipo_Servico,Tipo,Viatura,Motorista where 1=1 AND Pedido.ID_OM = Om.ID and Tipo_Servico.ID=Pedido.ID_TIPO_SERVICO and  Tipo.ID=Viatura.ID_TIPO and Pedido.ID=$TxtID and Viatura.ID=$TxtID_VIATURA and Motorista.ID=Pedido.ID_MOTORISTA";
	 	   				//echo $smsecurequery;
	  	  				//exit;
	  	  			}
	  	  			else
	  	  			{
	  	  				$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioBDT'.date("dmY")."-".rand(1,1000).".rtf";
						$MASCARA_RELATORIO='relatorios/RelatorioBDTRegres.rel';

						$ag1= new aguarde("Por favor, aguarde;<BR>Emitindo BDT...<BR>");;
						$ag1->abre();    /* Mensagem de "Aguarde..." */

						$smsecurequery = "Select Pedido.ID AS `ID`,
												 Pedido.ID AS `Pedido No`,
												 Motorista.NOME_GUERRA AS `MOTORISTA`,
												 Om.SIGLA AS `OM`,
												 Om.DESCRICAO AS `OM_DESC`,
												 CONCAT(SUBSTRING(DATA_PED,9,2),'-',SUBSTRING(DATA_PED,6,2),'-',SUBSTRING(DATA_PED,1,4)) AS `DATA`,
												 DAYOFMONTH(CURDATE()) AS `DIA`,
												 MONTH(CURDATE()) AS `MES`,
												 YEAR(CURDATE()) AS `ANO`,
												 Pedido.RESP_APRES AS `RESP_APRES`,
												 Pedido.RESP_PED AS `RESPONSAVEL`,
												 Viatura.CODIGO_VIATURA AS `TIPO`,
												 Viatura.PLACA AS `PLACA`,
												 Pedido.DESC_PED AS `SERVICO`,
												 Pedido.DESTINO_PED AS `DESTINO`,
												 CONCAT(SUBSTRING(DT_APRES_PREV,9,2),'-',SUBSTRING(DT_APRES_PREV,6,2),'-',SUBSTRING(DT_APRES_PREV,1,4)) AS `DATA_PREV_APRES`,
												 CONCAT(SUBSTRING(DT_APRES,9,2),'-',SUBSTRING(DT_APRES,6,2),'-',SUBSTRING(DT_APRES,1,4)) AS `DATA_APRES_EFET`,
												 H_APRES_PREV AS `HORA_PREV_APRES`,
												 CONCAT(SUBSTRING(DT_SAI_PREV,9,2),'-',SUBSTRING(DT_SAI_PREV,6,2),'-',SUBSTRING(DT_SAI_PREV,1,4)) AS `DATA_PREV_SAIDA`,
												 CONCAT(SUBSTRING(DT_DISP,9,2),'-',SUBSTRING(DT_DISP,6,2),'-',SUBSTRING(DT_DISP,1,4)) AS `DATA_DISP`,
												 H_SAI_PREV AS `HORA_PREV_SAIDA`,
												 H_APRES AS `HORA_APRES_EFET`,
												 H_DISP AS `HORA_DISP`,
												 OBS_USUARIO AS `OBS`,
												 Avaliacao.DESCRICAO AS `AVALIACAO`,
												 CONCAT(SUBSTRING(DA_SAI,9,2),'-',SUBSTRING(DA_SAI,6,2),'-',SUBSTRING(DA_SAI,1,4)) AS `DATA_SAIDA_EFET`,
												 H_SAI AS `HORA_SAIDA_PREV`,
												 ODOM_SAI AS `ODOMETRO_SAIDA`,
												 INSPECAO_SAI AS `INSPECAO_SAIDA`,
												 CONCAT(SUBSTRING(DT_REGRES,9,2),'-',SUBSTRING(DT_REGRES,6,2),'-',SUBSTRING(DT_REGRES,1,4)) AS `DATA_REGRES`,
												 H_REGRES AS `HORA_REGRES`,
												 ODOM_REGRES AS `ODOMETRO_REGRES`,
												 INSPECAO_REGRES AS `INSPECAO_REGRES` from Avaliacao,Pedido,Om,Tipo_Servico,Tipo,Viatura,Motorista where 1=1 and Avaliacao.ID=Pedido.ID_AVALIACAO AND Pedido.ID_OM = Om.ID and Tipo_Servico.ID=Pedido.ID_TIPO_SERVICO and  Tipo.ID=Viatura.ID_TIPO and Pedido.ID=$TxtID and Viatura.ID=$TxtID_VIATURA and Motorista.ID=Pedido.ID_MOTORISTA";
						//echo $smsecurequery;
	  	  				//exit;
	  	  			}
	  	  		}

	   	 		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die("N�o pude conectar");
	    		MYSQL_SELECT_DB($_ENV['NomeBase']);

	    		$smsecurers1 = mysql_query($smsecurequery);
	    		$Registros  = @mysql_num_rows($smsecurers1);

	    		if ($Registros <= 0)
	    		{
	     	  	      echo "N�o retornou nenhum registro..." ;
	      	  	      $ag1->fecha();   /* Fecha janela de "Aguarde" */
	        		exit;
	    		}

	    		/* Neste ponto acontece a gera��o do relat�rio. */
	   		// echo "<BR><center><b>Aguarde Emitindo BDT...</b></center>";
	    		flush();
	    		$VARIAVEIS["QUERY1"]        = $smsecurequery;

	    		$VARIAVEIS["TxtTITULO"]     = "bdt- Boletim Di�rio de Tr�fego, por ".ucfirst(strtolower($_GET['TxtORDENAR']));
		//      $VARIAVEIS["TxtTITULO"]     = "R05 - PROCESSOS POR TIPO DE A��O";
	 	        $VARIAVEIS["TxtFiltro"]     = $MsgTxtWhere;
	    		$VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
	    		$VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];

	    		if(PreRelat($VARIAVEIS,$MASCARA_RELATORIO,$ARQUIVO_TEMPORARIO))
	    		{
	       			 echo "<BR><BR><B>Houveram erros na gera��o do BDT. Favor contactar o administrador do sistema.</B>";
	        		$ag1->fecha();
	        		@unlink($ArquivoGravadoX);
	        		exit;
	    		}
	    		$ag1->fecha();   /* Fecha janela de "Aguarde" */
	    		//RtfToPdf($ARQUIVO_TEMPORARIO);
			echo "<script>window.open('" . $ARQUIVO_TEMPORARIO . "');</script>";

			//EMISS�O DO BI!

//			require("Lib/MinfoRelatorio.php");
//			include("Lib/MinfoMsg.php");



						$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioBI'.date("dmY")."-".rand(1,1000).".rtf";
						$MASCARA_RELATORIO='relatorios/RelatorioBI.rel';

		 				$ag1= new aguarde("Por favor, aguarde;<BR>Emitindo BI...<BR>");;
	  					$ag1->abre();    /* Mensagem de "Aguarde..." */

		    			$smsecurequery = "Select Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO, Itens_para_inspecao.descricao as `ITEM_SAIDA`, Pedido.ID
                        AS `ID`,Pedido.ID AS `npedido`,Motorista.NOME_GUERRA AS `MOTORISTA`,
                        CONCAT(SUBSTRING(DATA_PED,9,2),'-',SUBSTRING(DATA_PED,6,2),'-',SUBSTRING(DATA_PED,1,4)) AS `data`,
                        DAYOFMONTH(CURDATE()) AS `DIA`,MONTH(CURDATE()) AS `MES`,YEAR(CURDATE()) AS `ANO`,
                        Viatura.PLACA AS `placa` from  Itens_inspecao_viaturas, Itens_para_inspecao, Pedido,Viatura,
                        Motorista
                        where 1=1 AND Pedido.ID=$TxtID and Viatura.ID=$TxtID_VIATURA and Motorista.ID=Pedido.ID_MOTORISTA
                        and Itens_inspecao_viaturas.ID_VIATURA = Viatura.id
                        and Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO = Itens_para_inspecao.ID";

	 	   				//echo $smsecurequery;
	  	  				//exit;


	   	 		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die("N�o pude conectar");
	    		MYSQL_SELECT_DB($_ENV['NomeBase']);

	    		$smsecurers = mysql_query($smsecurequery);
	    		$row = mysql_fetch_array($smsecurers);
	    		$Registros  = @mysql_num_rows($smsecurers);

	    		if ($Registros <= 0)
	    		{
	     	  	      echo "N�o retornou nenhum registro..." ;
	      	  	      $ag1->fecha();   /* Fecha janela de "Aguarde" */
	        		exit;
	    		}

	    		/* Neste ponto acontece a gera��o do relat�rio. */
	   		// echo "<BR><center><b>Aguarde Emitindo BDT...</b></center>";

        		flush();

        		$VARIAVEIS["QUERY1"]        = $smsecurequery;
           		$VARIAVEIS["npedido"]     = $row['npedido'];
		        $VARIAVEIS["placa"]     = $row['placa'];
	 	        $VARIAVEIS["motorista"]     = $row['MOTORISTA'];
	    		$VARIAVEIS["data"]     = date('d/m/Y - H:i:s');
//	    		$VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];

	    		if(PreRelat($VARIAVEIS,$MASCARA_RELATORIO,$ARQUIVO_TEMPORARIO))
	    		{
	       			 echo "<BR><BR><B>Houveram erros na gera��o do BI. Favor contactar o administrador do sistema.</B>";
	        		$ag1->fecha();
	        		@unlink($ArquivoGravadoX);
	        		exit;
	    		}
	    		$ag1->fecha();   /* Fecha janela de "Aguarde" */
	    		//RtfToPdf($ARQUIVO_TEMPORARIO);
			echo "<script>window.open('" . $ARQUIVO_TEMPORARIO . "');</script>";

		}

	}

}

/*function ImprimeBI()
{
//EMISS�O DO BI!

			require("Lib/MinfoRelatorio.php");
			include("Lib/MinfoMsg.php");


			$strSQLBI =  "Select * from Pedido where ID = '" . $TxtID . "'";
				$smsecurersBI = mysql_query($strSQLBI);
				for ($t = 1; $t <= @mysql_affected_rows(); $t++)
				{
					$rowBI = mysql_fetch_array($smsecurersBI);
					$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioBI'.date("dmY")."-".rand(1,1000).".rtf";
					$MASCARA_RELATORIO='relatorios/RelatorioBI.rel';

	 				$ag1= new aguarde("Por favor, aguarde;<BR>Emitindo BI...<BR>");;
  					$ag1->abre();    /* Mensagem de "Aguarde..." */


                    //Esquematizar as Tabelas Corretamentes, para poder ser efetuada a Select
                    //Altera��es por Lincoln Junior ...
                    //N�o est�o conclu�das, aguardando altera��es na estrutura da Base de Dados
                    //Modificar � partir daqui !
/*
					$smsecurequery = "Select Pedido.ID AS `ID`,
											 Pedido.ID AS `NPEDIDO`,
											 ITENS_INSPECAO.Descricao AS `ITEM_SAIDA`,
                                             RESULTADO.DESCRICAO AS `RESULTADO_SAIDA`,
                                             from Pedido,Itens_Inspecao,Resultado where Pedido.ID=$TxtID and ;
					//echo $smsecurequery;
  	  				//exit;
	  	  			}
	  	  		}

	   	 		$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die("N�o pude conectar");
	    		MYSQL_SELECT_DB($_ENV['NomeBase']);

	    		$smsecurers1 = mysql_query($smsecurequery);
	    		$Registros  = @mysql_num_rows($smsecurers1);

	    		if ($Registros <= 0)
	    		{
	     	  	      echo "N�o retornou nenhum registro..." ;
	      	  	      $ag1->fecha();   /* Fecha janela de "Aguarde" */
//	        		exit;
//	    		}

	    		/* Neste ponto acontece a gera��o do relat�rio. */
/*	    		flush();
	    		$VARIAVEIS["QUERY1"]        = $smsecurequery;
           		$VARIAVEIS["TxtTITULO"]     = "bdt- Boletim Di�rio de Tr�fego, por ".ucfirst(strtolower($_GET['TxtORDENAR']));
		        $VARIAVEIS["TxtFiltro"]     = $MsgTxtWhere;
	    		$VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
	    		$VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];

	    		if(PreRelat($VARIAVEIS,$MASCARA_RELATORIO,$ARQUIVO_TEMPORARIO))
	    		{
	       			 echo "<BR><BR><B>Houveram erros na gera��o do BDT. Favor contactar o administrador do sistema.</B>";
	        		$ag1->fecha();
	        		@unlink($ArquivoGravadoX);
	        		exit;
	    		}
	    		$ag1->fecha();   /* Fecha janela de "Aguarde" */
	    		//RtfToPdf($ARQUIVO_TEMPORARIO);
/*			echo "<script>window.open('" . $ARQUIVO_TEMPORARIO . "');</script>";

		}

	}
}
*/

function ProcessaExclusao($_Mascara)
{

	$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
	$strSQL = "delete from  Pedido    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmExecutaProgramacao.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmExecutaProgramacao.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmExecutaProgramacao.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';
	$strSQL1 = "select * from Pedido where  Pedido.ID='" . VerificaInsercoesMaliciosas($_GET['Codigo']) . "'";
		$smsecurers1 = mysql_query($strSQL1);
		$COUNT=@mysql_affected_rows();
		for ($t = 1; $t <= $COUNT; $t++)
		{
			$row1 = mysql_fetch_array($smsecurers1);
			if($row1['ODOM_SAI']=='0')
			{
				$strSQL = "SELECT ID,ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_DESPACHANTE,DT_SAI_PREV,H_SAI_PREV,DT_APRES_PREV,H_APRES_PREV,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DA_SAI,H_SAI,INSPECAO_SAI,DESP_SAI,DT_APRES,H_APRES,DT_DISP,H_DISP,DT_REGRES,H_REGRES,ODOM_REGRES,INSPECAO_REGRES,DESP_REGRES,OBS_DESP_SAI,OBS_DESP_REGRES,ID_AVALIACAO,OBS_USUARIO  from  Pedido  where ID = '" . $TxtID . "'";
				SetaDadosAlteracao($strSQL,'FrmExecutaProgramacao') ;
			}

			else
			{	$strSQL = "SELECT ID,ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_DESPACHANTE,DT_SAI_PREV,H_SAI_PREV,DT_APRES_PREV,H_APRES_PREV,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DA_SAI,H_SAI,ODOM_SAI,INSPECAO_SAI,DESP_SAI,DT_APRES,H_APRES,DT_DISP,H_DISP,DT_REGRES,H_REGRES,ODOM_REGRES,INSPECAO_REGRES,DESP_REGRES,OBS_DESP_SAI,OBS_DESP_REGRES,ID_AVALIACAO,OBS_USUARIO  from  Pedido  where ID = '" . $TxtID . "'";
				SetaDadosAlteracao($strSQL,'FrmExecutaProgramacao') ;
			}
		}

	echo '<script>document.FrmExecutaProgramacao.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmExecutaProgramacao.TxtID_OM.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmExecutaProgramacao.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';



	echo '<form name=FrmExecutaProgramacao method=post action=FrmExecutaProgramacao.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';

	echo '</td></tr>';
	ExibeTitulo(Programa��o);	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';


	echo$_SESSION['AbreMoldura'];
	echo'<tr>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PROGRAMADOR"] . '</b></font></td>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MOTORISTA"] . '</b></font></td>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo'</tr>';
	echo'<tr>';
	echo'<td class=white><select name=TxtID_PROGRAMADOR>';
	$strSQL = 'select * from Programador';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo'</select></td>';
	echo'<td class=white><select name=TxtID_MOTORISTA>';
	$strSQL = 'select * from Motorista';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo'<option value='. $row['ID'] . '>' .  $row['NOME_GUERRA'] . '</option>';
	}
	echo'</select></td>';
	echo'<td class=white><select name=TxtID_VIATURA>';

				$strSQL = "select * from Viatura";
				$smsecurers = mysql_query($strSQL);
				for ($t = 1; $t <= @mysql_affected_rows(); $t++)
				{
					$row = mysql_fetch_array($smsecurers);

					echo'<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';

				}


	echo'</select>'; echo '</td>';
	echo'</tr>';
	echo$_SESSION['FechaMoldura'];

	echo$_SESSION['AbreMoldura'];
	echo'<tr>';
		echo'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Data (dd/mm/aaaa)</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Hora (hh:mm:ss)</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Despachante</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Od�metro</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Inspe��o</b></font></td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Sa�da:</td>';
		echo'<td class=white>&nbsp;Prevista:</td>';
		echo'<td class=white><input type=text name=TxtDT_SAI_PREV value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_SAI_PREV value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDA_SAI value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_SAI value="" maxlength=8 size=8></td>';
		echo'<td class=white><select name=TxtDESP_SAI>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		echo'</select></td>';
		$strSQL = "select * from Pedido where  Pedido.ID='" . VerificaInsercoesMaliciosas($_GET['Codigo']) . "'";
		$smsecurers = mysql_query($strSQL);
		$COUNT=@mysql_affected_rows();
		for ($t = 1; $t <= $COUNT; $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			if($row['ODOM_SAI']=='0')
			{
				$strSQL1 = "select Viatura.ODOMETRO AS `ODOM` from Viatura,Pedido where Pedido.ID_VIATURA=Viatura.ID and Pedido.ID='" . VerificaInsercoesMaliciosas($_GET['Codigo']) . "'";
				$smsecurers1 = mysql_query($strSQL1);


					$row1 = mysql_fetch_array($smsecurers1);

					echo"<td class=white><input type=text name=TxtODOM_SAI value='" . $row1['ODOM'] . "' maxlength=8 size=8></td>";


			}
			else
			{
					echo"<td class=white><input type=text name=TxtODOM_SAI value='' maxlength=8 size=8></td>";
			}

		}

		if($TxtID_TIPO_SERVICO<>2)
		{
		echo'<td class=white><input type=text name=TxtINSPECAO_SAI value="" maxlength=8 size=8></td>';
		}
	 //echo"<td>"; echo $strSQL; echo"</td>";
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Apresenta��o:</td>';
		echo'<td class=white>&nbsp;Prevista:</td>';
		echo'<td class=white><input type=text name=TxtDT_APRES_PREV value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDT_APRES value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_APRES value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Dispensa:</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDT_DISP value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_DISP value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Regresso:</td>';
		echo'<td class=white>&nbsp;Efetivo:</td>';
		echo'<td class=white><input type=text name=TxtDT_REGRES value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_REGRES value="" maxlength=8 size=8></td>';
		echo'<td class=white><select name=TxtDESP_REGRES>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		echo'<option value=0 selected>N�o Definido</option>';
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		echo'</select></td>';
		echo'<td class=white><input type=text name=TxtODOM_REGRES value="" maxlength=8 size=8></td>';
		echo'<td class=white><input type=text name=TxtINSPECAO_REGRES value="" maxlength=8 size=8></td>';

	echo'</tr>';

	echo$_SESSION['FechaMoldura'];
	echo$_SESSION['AbreMoldura'];






	if ($_GET['TxtOpcao'] == 'V')
	{

		echo'<td class=white align=right><input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()></td>';

	}
	else
	{

		echo'<td class=white align=right><input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmExecutaProgramacao)><input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()></td>';

	}



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
	echo '<form name=FrmExecutaProgramacao method=GET action=FrmExecutaProgramacao.php>';
	//ExibeTitulo('Pesquisa ->Pedido');
	$Titulo = "Pesquisa ->Pedido";
	$aba1="";

	$aba1.= "\n".$_SESSION['AbreMoldura'];
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Programa��o No</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_OM"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["RESP_PED"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_TIPO_SERVICO"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NR_PESSOAS"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA_PED"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["H_PED"] . '</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	if($TxtOpcao=="I")
	{
	$strSQL = 'select * from Pedido order by ID DESC LIMIT 1';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$n=$row['ID']+1;
		$aba1.= "\n".'<td class=white>' . $n . ' </td>';
	}
	}
	else
	{
	$aba1.= "\n".'<td class=white>' . $_GET['Codigo'] . ' </td>';
	}
	$aba1.= "\n".'<td class=white><select name=TxtID_OM>';
	$strSQL = 'select * from Om';
	$smsecurers = mysql_query($strSQL);
	$aba1.= "\n".'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba1.= "\n".'<option value='. $row['ID'] . '>' .  $row['SIGLA'] . '</option>';
	}
	$aba1.= "\n".'</select></td>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtRESP_PED value="" maxlength=30 size=20></td>';

	$aba1.= "\n".'<td class=white><select name=TxtID_TIPO_SERVICO>';
	$strSQL = 'select * from Tipo_Servico';
	$smsecurers = mysql_query($strSQL);
	$aba1.= "\n".'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba1.= "\n".'<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	$aba1.= "\n".'</select></td>';

	$aba1.= "\n".'<td class=white><input type=text name=TxtNR_PESSOAS value="" maxlength=3 size=3></td>';
	if($TxtOpcao=="I")
	{
	$aba1.= "\n"."<td class=white><input type=text name=TxtDATA_PED value='" . date(d) ."/" . date(m) . "/" . date(Y) . "' maxlength=10 size=10></td>";
	$aba1.= "\n"."<td class=white><input type=text name=TxtH_PED value='" . date(H) .":" . date(i) . ":" . date(s) . "' maxlength=8 size=8></td>";
	}
	else
	{
	$aba1.= "\n"."<td class=white><input type=text name=TxtDATA_PED value='' maxlength=10 size=10></td>";
	$aba1.= "\n".'<td class=white><input type=text name=TxtH_PED value="" maxlength=8 size=8></td>';
	}


	$aba1.= "\n".'</tr>';
	$aba1.= "\n".$_SESSION['FechaMoldura'];
	$aba1.= "\n".$_SESSION['AbreMoldura'];

	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DESC_PED"] . '</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtDESC_PED value="" maxlength=50 size=50></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".$_SESSION['FechaMoldura'];

	$aba1.= "\n".$_SESSION['AbreMoldura'];
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DESTINO_PED"] . '</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtDESTINO_PED value="" maxlength=50 size=50></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".$_SESSION['FechaMoldura'];
	$aba1.= "\n". $_SESSION['AbreMoldura'];
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["RESP_APRES"] . '</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Usu�rio</b></font></td>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_AVALIACAO"] . '</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtRESP_APRES value="" maxlength=30 size=30></td>';
	$aba1.= "\n"."<td class=white>" . $_SESSION['LOGIN'] . "</td>";
	$aba1.= "\n".'<td class=white><select name=TxtID_AVALIACAO>';
	$strSQL = 'select * from Avaliacao';
	$smsecurers = mysql_query($strSQL);
	$aba1.= "\n".'<option value=0 selected>N�o Definido</option>';
	$aba1.= "\n".'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba1.= "\n".'<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	$aba1.= "\n".'</select></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n". $_SESSION['FechaMoldura'];
	$aba1.= "\n". $_SESSION['AbreMoldura'];
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["OBS_USUARIO"] . '</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><textarea name=TxtOBS_USUARIO value="" rows=10 cols=80 ></textarea></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n". $_SESSION['FechaMoldura'];
	$aba1.= "\n". $_SESSION['AbreMoldura'];

	echo$_SESSION['AbreMoldura'];
	echo'<tr>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PROGRAMADOR"] . '</b></font></td>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MOTORISTA"] . '</b></font></td>';
	echo'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo'</tr>';
	echo'<tr>';
	echo'<td class=white><select name=TxtID_PROGRAMADOR>';
	$strSQL = 'select * from Programador';
	$smsecurers = mysql_query($strSQL);
	echo'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo'</select></td>';
	echo'<td class=white><select name=TxtID_MOTORISTA>';
	$strSQL = 'select * from Motorista';
	$smsecurers = mysql_query($strSQL);
	echo'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo'<option value='. $row['ID'] . '>' .  $row['NOME_GUERRA'] . '</option>';
	}
	echo'</select></td>';
	echo'<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo'<option value=""></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo'<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo'</select></td>';
	echo'</tr>';
	echo$_SESSION['FechaMoldura'];

	echo$_SESSION['AbreMoldura'];
	echo'<tr>';
		echo'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Data (dd/mm/aaaa)</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Hora (hh:mm:ss)</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Despachante</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Od�metro</b></font></td>';
		echo'<td class=ColorFormulario><font color=000000><b>Inspe��o</b></font></td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Sa�da:</td>';
		echo'<td class=white>&nbsp;Prevista:</td>';
		echo'<td class=white><input type=text name=TxtDT_SAI_PREV value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_SAI_PREV value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDA_SAI value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_SAI value="" maxlength=8 size=8></td>';
		echo'<td class=white><select name=TxtDESP_SAI>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		echo'<option value=""></option>';
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		echo'</select></td>';
		echo'<td class=white><input type=text name=TxtODOM_SAI value="" maxlength=8 size=8></td>';
		if($TxtID_TIPO_SERVICO<>2)
		{
		echo'<td class=white><input type=text name=TxtINSPECAO_SAI value="" maxlength=8 size=8></td>';
		}
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Apresenta��o:</td>';
		echo'<td class=white>&nbsp;Prevista:</td>';
		echo'<td class=white><input type=text name=TxtDT_APRES_PREV value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDT_APRES value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_APRES value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Dispensa:</td>';
		echo'<td class=white>&nbsp;Efetiva:</td>';
		echo'<td class=white><input type=text name=TxtDT_DISP value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_DISP value="" maxlength=8 size=8></td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		echo'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	echo'</tr>';

	echo'<tr>';
		echo'<td class=white>&nbsp;Regresso:</td>';
		echo'<td class=white>&nbsp;Efetivo:</td>';
		echo'<td class=white><input type=text name=TxtDT_REGRES value="" maxlength=10 size=10></td>';
		echo'<td class=white><input type=text name=TxtH_REGRES value="" maxlength=8 size=8></td>';
		echo'<td class=white><select name=TxtDESP_REGRES>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		echo'<option value=0 selected>N�o Definido</option>';
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		echo'</select></td>';
		echo'<td class=white><input type=text name=TxtODOM_REGRES value="" maxlength=8 size=8></td>';
		echo'<td class=white><input type=text name=TxtINSPECAO_REGRES value="" maxlength=8 size=8></td>';

	echo'</tr>';

	echo$_SESSION['FechaMoldura'];
	echo$_SESSION['AbreMoldura'];








		$aba1.= "\n".'<td class=white align=right><input type=Submit name=Submit value=Pesquisar></td>';
		echo'<td class=white align=right><input type=Submit name=Submit value=Pesquisar></td>';



	ExibeFormComAbas($Titulo,array("Pedido","Execu��o"),array($aba1,$aba2),"left",$fimdoform,0);

	echo $_SESSION['FechaMoldura'];

	echo '</form>';
}
mysql_close($link) ;
?>
</body>
</HTML>
