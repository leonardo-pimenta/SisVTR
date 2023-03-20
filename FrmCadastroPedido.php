<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
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
$_Mascara["RESP_PED"] 	= "Responsável";
$_Mascara["DATA_PED"] 	= "Data do Pedido (dd/mm/aaaa)";
$_Mascara["H_PED"] 	= "Hora do Pediddo (hh:mm:ss)";
$_Mascara["DESC_PED"] 	= "Descrição do Serviço";
$_Mascara["DESTINO_PED"] 	= "Destino";
$_Mascara["DT_SAI_PREV"] 	= "Data de Saída Prevista (dd/mm/aaaa)";
$_Mascara["H_SAI_PREV"] 	= "Hora de Saída Prevista (hh:mm:ss)";
$_Mascara["DT_APRES_PREV"] 	= "Data de Apresentação Prevista";
$_Mascara["H_APRES_PREV"] 	= "Hora de Apresentação Prevista";
$_Mascara["RESP_APRES"] 	= "Reponsável pela Apresentação";
$_Mascara["NR_PESSOAS"] 	= "No de Pessoas";
$_Mascara["DA_SAI"] 	= "Data da Saída";
$_Mascara["H_SAI"] 	= "Hora da Saída";
$_Mascara["ODOM_SAI"] 	= "Odômetro de Saída";
$_Mascara["INSPECAO_SAI"] 	= "Inspeção de Saída";
$_Mascara["DESP_SAI"] 	= "Despachante da Saída";
$_Mascara["DT_APRES"] 	= "Data da Apresentação";
$_Mascara["H_APRES"] 	= "Hora da Apresentação";
$_Mascara["DT_DISP"] 	= "Data da Dispença";
$_Mascara["H_DISP"] 	= "Hora da Dispença";
$_Mascara["DT_REGRES"] 	= "Data de Regresso";
$_Mascara["H_REGRES"] 	= "Hora do Regresso";
$_Mascara["ODOM_REGRES"] 	= "Odômetro de Regresso";
$_Mascara["INSPECAO_REGRES"] 	= "Inspeção de Regresso";
$_Mascara["DESP_REGRES"] 	= "Despachante do Regresso";
$_Mascara["ID_TIPO_SERVICO"] 	= "Tipo de Serviço";
$_Mascara["OBS_DESP_SAI"] 	= "Observação Desp. Saída";
$_Mascara["OBS_DESP_REGRES"] 	= "Observação Desp. Regresso";
$_Mascara["OBS_USUARIO"] 	= "Observação do Usuário";
$_Mascara["ID_AVALIACAO"] 	= "Avaliação";

$CodigoPagina = 'FrmCadastroPedido';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroPedido';
require('utilities/MinfoAbas.php');
require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroPedido.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_OM']))
	$TxtID_OM = VerificaInsercoesMaliciosas($_GET['TxtID_OM']);
else
	$TxtID_OM = '';

if (isset($_GET['TxtID_DESPACHANTE']))
	$TxtID_DESPACHANTE = VerificaInsercoesMaliciosas($_GET['TxtID_DESPACHANTE']);
else
	$TxtID_DESPACHANTE = '';

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
	$TxtWhere = $TxtWhere . " AND Pedido.DATA_PED = '" . substr($TxtDATA_PED,6,4) . "-" . substr($TxtDATA_PED,3,2) . "-" . substr($TxtDATA_PED,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DT_SAI_PREV = '" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DT_APRES_PREV = '" . substr($TxtDT_APRES_PREV,6,4) . "-" . substr($TxtDT_APRES_PREV,3,2) . "-" . substr($TxtDT_APRES_PREV,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DA_SAI = '" . substr($TxtDA_SAI,6,4) . "-" . substr($TxtDA_SAI,3,2) . "-" . substr($TxtDA_SAI,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DT_APRES = '" . substr($TxtDT_APRES,6,4) . "-" . substr($TxtDT_APRES,3,2) . "-" . substr($TxtDT_APRES,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DT_DISP = '" . substr($TxtDT_DISP,6,4) . "-" . substr($TxtDT_DISP,3,2) . "-" . substr($TxtDT_DISP,0,2) . "'";
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
	$TxtWhere = $TxtWhere . " AND Pedido.DT_REGRES = '" . substr($TxtDT_REGRES,6,4) . "-" . substr($TxtDT_REGRES,3,2) . "-" . substr($TxtDT_REGRES,0,2) . "'";
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


//	$smsecurequery = "Select Pedido.ID AS `ID`,Pedido.ID AS `Pedido No`,  Om.SIGLA AS `" . $_Mascara['ID_OM'] . "`, Pedido.RESP_APRES AS `" . $_Mascara['RESP_APRES'] . "`, CONCAT(DT_APRES_PREV,' - ',H_APRES_PREV) AS `Data/Hora Apresentação`, CONCAT(DT_SAI_PREV,' - ',H_SAI_PREV) AS `Data/Hora Saída`  from  Pedido,Om where 1=1 AND Pedido.ID_OM = Om.ID " . $TxtWhere ;



	$smsecurequery = "Select Pedido.ID AS `ID`,concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Pedido.ID) AS `Pedido No`,  concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Om.SIGLA) AS `" . $_Mascara['ID_OM'] . "`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), Pedido.RESP_APRES) AS `" . $_Mascara['RESP_APRES'] . "`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), DT_APRES_PREV,' - ',H_APRES_PREV) AS `Data/Hora Apresentação`, concat(if(Pedido.ID_PROGRAMADOR <> '','<font color=666666>',''), DT_SAI_PREV,' - ',H_SAI_PREV) AS `Data/Hora Saída`  from  Pedido,Om where 1=1 AND Pedido.ID_OM = Om.ID and H_REGRES=' . 00:00:00 . '" . $TxtWhere ." ORDER BY DT_APRES_PREV DESC" ;

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
	//echo $smsecurequery;
	FormularioPesquisa($_Mascara);

}
//

//exit;
	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroPedido"," Pedido ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
	//echo $smsecurequery;
echo "<font size=2 color=red><center>-Pedidos em cinza são pedios já programados.</center></font>";
sair();

function Critica($_Mascara)
{
	if($TxtOpcao==I)
	{
		$strSQL = "SELECT ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DESP_SAI  from  Pedido";
	}

	else
	{
		$strSQL = "SELECT ID_OM  from  Pedido";
	}
	$NomeForm = "FrmCadastroPedido";
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
		//$TxtDT_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_SAI_PREV']);
	//	$TxtH_SAI_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI_PREV']);
		$TxtDT_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES_PREV']);
		$TxtH_APRES_PREV 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES_PREV']);
	//	$TxtID_PROGRAMADOR 	= VerificaInsercoesMaliciosas($_POST['TxtID_PROGRAMADOR']);
	//	$TxtID_MOTORISTA 	= VerificaInsercoesMaliciosas($_POST['TxtID_MOTORISTA']);
	//	$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDESC_PED 	= VerificaInsercoesMaliciosas($_POST['TxtDESC_PED']);
		$TxtDESTINO_PED 	= VerificaInsercoesMaliciosas($_POST['TxtDESTINO_PED']);
		$TxtRESP_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtRESP_APRES']);
	//	$TxtDA_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDA_SAI']);
	//	$TxtH_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtH_SAI']);
	//	$TxtODOM_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_SAI']);
	//	$TxtINSPECAO_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_SAI']);
	//	$TxtDESP_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_SAI']);
	//	$TxtDT_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_APRES']);
	//	$TxtH_APRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_APRES']);
	//	$TxtDT_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtDT_DISP']);
	//	$TxtH_DISP 	= VerificaInsercoesMaliciosas($_POST['TxtH_DISP']);
	//	$TxtDT_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDT_REGRES']);
	//	$TxtH_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtH_REGRES']);
	//	$TxtODOM_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtODOM_REGRES']);
	//	$TxtINSPECAO_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtINSPECAO_REGRES']);
	//	$TxtDESP_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtDESP_REGRES']);
		$TxtOBS_DESP_SAI 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_DESP_SAI']);
		$TxtOBS_DESP_REGRES 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_DESP_REGRES']);
		$TxtID_AVALIACAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_AVALIACAO']);
		$TxtOBS_USUARIO 	= VerificaInsercoesMaliciosas($_POST['TxtOBS_USUARIO']);

		$smsecurequery = "Select * from Pedido where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Pedido(ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_DESPACHANTE,DT_SAI_PREV,H_SAI_PREV,DT_APRES_PREV,H_APRES_PREV,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DA_SAI,H_SAI,ODOM_SAI,INSPECAO_SAI,DESP_SAI,DT_APRES,H_APRES,DT_DISP,H_DISP,DT_REGRES,H_REGRES,ODOM_REGRES,INSPECAO_REGRES,DESP_REGRES,OBS_DESP_SAI,OBS_DESP_REGRES,ID_AVALIACAO,OBS_USUARIO)
		 VALUES
		 ('" . $TxtID_OM ."','" . $TxtRESP_PED ."','" . $TxtID_TIPO_SERVICO ."','" . $TxtNR_PESSOAS ."','" . substr($TxtDATA_PED,6,4) . "-" . substr($TxtDATA_PED,3,2) . "-" . substr($TxtDATA_PED,0,2) ."','" . $TxtH_PED ."','" . $TxtID_DESPACHANTE ."','" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) ."','" . $TxtH_SAI_PREV ."','" . substr($TxtDT_APRES_PREV,6,4) . "-" . substr($TxtDT_APRES_PREV,3,2) . "-" . substr($TxtDT_APRES_PREV,0,2) ."','" . $TxtH_APRES_PREV ."','" . $TxtID_PROGRAMADOR ."','" . $TxtID_MOTORISTA ."','" . $TxtID_VIATURA ."','" . $TxtDESC_PED ."','" . $TxtDESTINO_PED ."','" . $TxtRESP_APRES ."','" . substr($TxtDA_SAI,6,4) . "-" . substr($TxtDA_SAI,3,2) . "-" . substr($TxtDA_SAI,0,2) ."','" . $TxtH_SAI ."','" . $TxtODOM_SAI ."','" . $TxtINSPECAO_SAI ."','" . $TxtDESP_SAI ."','" . substr($TxtDT_APRES,6,4) . "-" . substr($TxtDT_APRES,3,2) . "-" . substr($TxtDT_APRES,0,2) ."','" . $TxtH_APRES ."','" . substr($TxtDT_DISP,6,4) . "-" . substr($TxtDT_DISP,3,2) . "-" . substr($TxtDT_DISP,0,2) ."','" . $TxtH_DISP ."','" . substr($TxtDT_REGRES,6,4) . "-" . substr($TxtDT_REGRES,3,2) . "-" . substr($TxtDT_REGRES,0,2) ."','" . $TxtH_REGRES ."','" . $TxtODOM_REGRES ."','" . $TxtINSPECAO_REGRES ."','" . $TxtDESP_REGRES ."','" . $TxtOBS_DESP_SAI ."','" . $TxtOBS_DESP_REGRES ."','" . $TxtID_AVALIACAO ."','" . $TxtOBS_USUARIO ."')";

		$smsecurers = mysql_query($strSQL);
		//echo $strSQL;
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());

		$TxtID = mysql_insert_id();
		//crio uma Inseção para este pedido
		$strSQL = "insert into Inspecao(TP_INSPECAO, ID_PEDIDO)
			VALUES
			('3','" . $TxtID . "')";
		$smsecurers = mysql_query($strSQL);
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
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

		$strSQL = "Update  Pedido set
			ID_OM			='" . $TxtID_OM .
			"',RESP_PED			='" . $TxtRESP_PED .
			"',ID_TIPO_SERVICO			='" . $TxtID_TIPO_SERVICO .
			"',NR_PESSOAS			='" . $TxtNR_PESSOAS .
			"',DATA_PED			='" . substr($TxtDATA_PED,6,4) . "-" . substr($TxtDATA_PED,3,2) . "-" . substr($TxtDATA_PED,0,2) .
			"',H_PED			='" . $TxtH_PED .
			//"',ID_DESPACHANTE			='" . $TxtID_DESPACHANTE .
			//"',DT_SAI_PREV			='" . substr($TxtDT_SAI_PREV,6,4) . "-" . substr($TxtDT_SAI_PREV,3,2) . "-" . substr($TxtDT_SAI_PREV,0,2) .
			//"',H_SAI_PREV			='" . $TxtH_SAI_PREV .
			//"',DT_APRES_PREV			='" . substr($TxtDT_APRES_PREV,6,4) . "-" . substr($TxtDT_APRES_PREV,3,2) . "-" . substr($TxtDT_APRES_PREV,0,2) .
			//"',H_APRES_PREV			='" . $TxtH_APRES_PREV .
			//"',ID_PROGRAMADOR			='" . $TxtID_PROGRAMADOR .
			//"',ID_MOTORISTA			='" . $TxtID_MOTORISTA .
			//"',ID_VIATURA			='" . $TxtID_VIATURA .
			"',DESC_PED			='" . $TxtDESC_PED .
			"',DESTINO_PED			='" . $TxtDESTINO_PED .
			"',RESP_APRES			='" . $TxtRESP_APRES .
			//"',DA_SAI			='" . substr($TxtDA_SAI,6,4) . "-" . substr($TxtDA_SAI,3,2) . "-" . substr($TxtDA_SAI,0,2) .
			//"',H_SAI			='" . $TxtH_SAI .
			//"',ODOM_SAI			='" . $TxtODOM_SAI .
			//"',INSPECAO_SAI			='" . $TxtINSPECAO_SAI .
			//"',DESP_SAI			='" . $TxtDESP_SAI .
			//"',DT_APRES			='" . substr($TxtDT_APRES,6,4) . "-" . substr($TxtDT_APRES,3,2) . "-" . substr($TxtDT_APRES,0,2) .
			//"',H_APRES			='" . $TxtH_APRES .
			//"',DT_DISP			='" . substr($TxtDT_DISP,6,4) . "-" . substr($TxtDT_DISP,3,2) . "-" . substr($TxtDT_DISP,0,2) .
			//"',H_DISP			='" . $TxtH_DISP .
			//"',DT_REGRES			='" . substr($TxtDT_REGRES,6,4) . "-" . substr($TxtDT_REGRES,3,2) . "-" . substr($TxtDT_REGRES,0,2) .
			//"',H_REGRES			='" . $TxtH_REGRES .
			//"',ODOM_REGRES			='" . $TxtODOM_REGRES .
			//"',INSPECAO_REGRES			='" . $TxtINSPECAO_REGRES .
			//"',DESP_REGRES			='" . $TxtDESP_REGRES .
			"',OBS_DESP_SAI			='" . $TxtOBS_DESP_SAI .
			"',OBS_DESP_REGRES			='" . $TxtOBS_DESP_REGRES .
			"',ID_AVALIACAO			='" . $TxtID_AVALIACAO .
			"',OBS_USUARIO			='" . $TxtOBS_USUARIO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Pedido    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroPedido.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroPedido.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroPedido.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_OM,RESP_PED,ID_TIPO_SERVICO,NR_PESSOAS,DATA_PED,H_PED,ID_DESPACHANTE,DT_SAI_PREV,H_SAI_PREV,DT_APRES_PREV,H_APRES_PREV,ID_PROGRAMADOR,ID_MOTORISTA,ID_VIATURA,DESC_PED,DESTINO_PED,RESP_APRES,DA_SAI,H_SAI,ODOM_SAI,INSPECAO_SAI,DESP_SAI,DT_APRES,H_APRES,DT_DISP,H_DISP,DT_REGRES,H_REGRES,ODOM_REGRES,INSPECAO_REGRES,DESP_REGRES,OBS_DESP_SAI,OBS_DESP_REGRES,ID_AVALIACAO,OBS_USUARIO  from  Pedido  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroPedido') ;
	echo "<form name=FrmCadastroInspecao2 method=post action=FrmCadastroInspecao_Itens.php?TxtOpcao=I&TP_INSPECAO='" . $row1["TP_INSPECAO"] . "'&Codigo='" . $row1["ID"] . "'>";
					echo '<center><input type=Submit name=Submit3 value=Inspecionar&nbsp;Ítem></center></form>';

	echo '<script>document.FrmCadastroPedido.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroPedido.TxtID_OM.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroPedido.Submit.value="Alterar"</SCRIPT>';
	}

}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroPedido method=post action=FrmCadastroPedido.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Pedido';

	if ($TxtOpcao == 'A')
		$Titulo = $Titulo . ' - Alteração';
	if ($TxtOpcao == 'D')
		$Titulo = $Titulo . ' - Exclusão';
	if ($TxtOpcao == 'I')
		$Titulo = $Titulo . ' - Inclusão';
	echo '</td></tr>';
	$aba1="";

	$aba1.= "\n".$_SESSION['AbreMoldura'];
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Pedido No</b></font></td>';
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
	if(@mysql_affected_rows()==0)
	{
		$aba1.= "\n".'<td class=white>1</td>';
	}
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
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Apresentação Prevista</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtDESC_PED value="" maxlength=50 size=50></td>';
	$aba1.= "\n".'<td class=white>data:&nbsp;<input type=text name=TxtDT_APRES_PREV value="" maxlength=10 size=10>&nbsp;&nbsp;Hora:&nbsp;<input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
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
	$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Usuário</b></font></td>';
	$aba1.= "\n".'</tr>';
	$aba1.= "\n".'<tr>';
	$aba1.= "\n".'<td class=white><input type=text name=TxtRESP_APRES value="" maxlength=30 size=30></td>';
	$aba1.= "\n"."<td class=white>" . $_SESSION['LOGIN'] . "</td>";

	$aba1.= "\n".'</tr>';
	$aba1.= "\n". $_SESSION['FechaMoldura'];
	$aba1.= "\n". $_SESSION['AbreMoldura'];

	$aba2.= "\n".$_SESSION['AbreMoldura'];
	$aba2.= "\n".'<tr>';
	$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PROGRAMADOR"] . '</b></font></td>';
	$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MOTORISTA"] . '</b></font></td>';
	$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	$aba2.= "\n".'</tr>';
	$aba2.= "\n".'<tr>';
	$aba2.= "\n".'<td class=white><select name=TxtID_PROGRAMADOR disabled=true>';
	$strSQL = 'select * from Programador';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	$aba2.= "\n".'</select></td>';
	$aba2.= "\n".'<td class=white><select name=TxtID_MOTORISTA disabled=true>';
	$strSQL = 'select * from Motorista';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME_GUERRA'] . '</option>';
	}
	$aba2.= "\n".'</select></td>';
	$aba2.= "\n".'<td class=white><select name=TxtID_VIATURA disabled=true>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	$aba2.= "\n".'</select></td>';
	$aba2.= "\n".'</tr>';
	$aba2.= "\n".$_SESSION['FechaMoldura'];

	$aba2.= "\n".$_SESSION['AbreMoldura'];
	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Data (dd/mm/aaaa)</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Hora (hh:mm:ss)</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Despachante</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Odômetro</b></font></td>';
		$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Inspeção</b></font></td>';
	$aba2.= "\n".'</tr>';
	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=white>&nbsp;Saída:</td>';
		$aba2.= "\n".'<td class=white>&nbsp;Prevista:</td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtDT_SAI_PREV value="" maxlength=10 size=10 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtH_SAI_PREV value="" maxlength=8 size=8 disabled=ture></td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$aba2.= "\n".'</tr>';
	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtDA_SAI value="" maxlength=10 size=10 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtH_SAI value="" maxlength=8 size=8 disabled=true></td>';
		$aba2.= "\n".'<td class=white><select name=TxtDESP_SAI disabled=true>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		$aba2.= "\n".'</select></td>';

		$aba2.= "\n".'<td class=white><input type=text name=TxtODOM_SAI value="" maxlength=8 size=8 disabled=true></td>';
		if($TxtID_TIPO_SERVICO<>2)
		{
		$aba2.= "\n".'<td class=white><input type=text name=TxtINSPECAO_SAI value="" maxlength=8 size=8 disabled=true></td>';
		}
	$aba2.= "\n".'</tr>';

	//$aba2.= "\n".'<tr>';

	//	$aba2.= "\n".'<td class=white>&nbsp;Prevista:</td>';
	//	$aba2.= "\n".'<td class=white><input type=text name=TxtDT_APRES_PREV value="" maxlength=10 size=10>&nbsp;&nbsp;<input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
	//	$aba2.= "\n".'<td class=white><input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
	//	$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	//	$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	//	$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	//$aba2.= "\n".'</tr>';


	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=white>&nbsp;Apresentação:</td>';
		$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtDT_APRES value="" maxlength=10 size=10 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtH_APRES value="" maxlength=8 size=8 disabled=true></td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$aba2.= "\n".'</tr>';

	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=white>&nbsp;Dispensa:</td>';
		$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtDT_DISP value="" maxlength=10 size=10 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtH_DISP value="" maxlength=8 size=8 disabled=true></td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$aba2.= "\n".'</tr>';

	$aba2.= "\n".'<tr>';
		$aba2.= "\n".'<td class=white>&nbsp;Regresso:</td>';
		$aba2.= "\n".'<td class=white>&nbsp;Efetivo:</td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtDT_REGRES value="" maxlength=10 size=10 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtH_REGRES value="" maxlength=8 size=8 disabled=true></td>';
		$aba2.= "\n".'<td class=white><select name=TxtDESP_REGRES disabled=true>';
		$strSQL = 'select * from Despachante';
		$smsecurers = mysql_query($strSQL);
		$aba2.= "\n".'<option value=0 selected>Não Definido</option>';
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
		}
		$aba2.= "\n".'</select></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtODOM_REGRES value="" maxlength=8 size=8 disabled=true></td>';
		$aba2.= "\n".'<td class=white><input type=text name=TxtINSPECAO_REGRES value="" maxlength=8 size=8 disabled=true></td>';

	$aba2.= "\n".'</tr>';


	$aba2.= "\n".$_SESSION['FechaMoldura'];
	$aba2.= "\n".$_SESSION['AbreMoldura'];

	if($TxtOpcao==I)
	{
		echo'<input type=hidden name=TxtID_PROGRAMADOR value=0><input type=hidden name=TxtID_MOTORISTA value=0><input type=hidden name=TxtID_VIATURA value=0><input type=hidden name=TxtDT_SAI_PREV value=0><input type=hidden name=TxtH_SAI_PREV value=0><input type=hidden name=TxtDA_SAI value=0><input type=hidden name=TxtH_SAI value=0><input type=hidden name=TxtDESP_SAI value=0><input type=hidden name=TxtODOM_SAI value=0><input type=hidden name=TxtINSPECAO_SAI value=0><input type=hidden name=TxtDT_APRES value=0><input type=hidden name=TxtH_APRES value=0>	<input type=hidden name=TxtDT_DISP value=0><input type=hidden name=TxtH_DISP value=0><input type=hidden name=TxtDT_REGRES value=0><input type=hidden name=TxtH_REGRES value=0><input type=hidden name=TxtDESP_REGRES value=0><input type=hidden name=TxtODOM_REGRES value=0><input type=hidden name=TxtINSPECAO_REGRES value=0><input type=hidden name=TxtOBS_DESP_SAI value=0><input type=hidden name=TxtOBS_DESP_REGRES value=0>';
	}


	$aba3.= "\n". $_SESSION['AbreMoldura'];
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_AVALIACAO"] . '</b></font></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=white><select name=TxtID_AVALIACAO>';
	$strSQL = 'select * from Avaliacao';
	$smsecurers = mysql_query($strSQL);
	//$aba3.= "\n".'<option>Não Definido</option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		$aba3.= "\n".'<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	$aba3.= "\n".'</select></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n". $_SESSION['FechaMoldura'];
	$aba3.= "\n". $_SESSION['AbreMoldura'];
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["OBS_USUARIO"] . '</b></font></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=white><textarea name=TxtOBS_USUARIO value="" rows=10 cols=80 ></textarea></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["OBS_DESP_SAI"] . '</b></font></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=white><textarea name=TxtOBS_DESP_SAI rows=10 cols=80 disabled=true></textarea></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["OBS_DESP_REGRES"] . '</b></font></td>';
	$aba3.= "\n".'</tr>';
	$aba3.= "\n".'<tr>';
	$aba3.= "\n".'<td class=white><textarea name=TxtOBS_DESP_REGRES rows=10 cols=80 disabled=true></textarea></td>';
	$aba3.= "\n".'</tr>';

	$aba3.= "\n". $_SESSION['FechaMoldura'];
	$aba3.= "\n". $_SESSION['AbreMoldura'];


	if ($_GET['TxtOpcao'] == 'V')
	{
		$aba1.= "\n".'<td class=white align=right><input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()></td>';
		$aba2.= "\n".'<td class=white align=right><input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()></td>';
		$aba3.= "\n".'<td class=white align=right><input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()></td>';
	}
	else
	{
		$aba1.= "\n".'<td class=white align=right><input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroPedido)><input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()></td>';
		$aba2.= "\n".'<td class=white align=right><input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroPedido)><input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()></td>';
		$aba3.= "\n".'<td class=white align=right><input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroPedido)><input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()></td>';
	}

	ExibeFormComAbas($Titulo,array("Pedido","Execução","Observações"),array($aba1,$aba2,$aba3),"left",$fimdoform,0);

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
	echo '<form name=FrmCadastroPedido method=GET action=FrmCadastroPedido.php>';
	//ExibeTitulo('Pesquisa ->Pedido');
			$Titulo = "Pesquisa ->Pedido";
			$aba1="";

			$aba1.= "\n".$_SESSION['AbreMoldura'];
			$aba1.= "\n".'<tr>';
			$aba1.= "\n".'<td class=ColorFormulario><font color=000000><b>Pedido No</b></font></td>';
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
			$aba1.= "\n".'</tr>';
			$aba1.= "\n".'<tr>';
			$aba1.= "\n".'<td class=white><input type=text name=TxtRESP_APRES value="" maxlength=30 size=30></td>';
			$aba1.= "\n".'</tr>';

			$aba1.= "\n". $_SESSION['FechaMoldura'];
			$aba1.= "\n". $_SESSION['AbreMoldura'];

			$aba2.= "\n".$_SESSION['AbreMoldura'];
			$aba2.= "\n".'<tr>';
			$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_PROGRAMADOR"] . '</b></font></td>';
			$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_MOTORISTA"] . '</b></font></td>';
			$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
			$aba2.= "\n".'</tr>';
			$aba2.= "\n".'<tr>';
			$aba2.= "\n".'<td class=white><select name=TxtID_PROGRAMADOR>';
			$strSQL = 'select * from Programador';
			$smsecurers = mysql_query($strSQL);
			$aba2.= "\n".'<option value=""></option>';
			for ($t = 1; $t <= @mysql_affected_rows(); $t++)
			{
				$row = mysql_fetch_array($smsecurers);
				$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
			}
			$aba2.= "\n".'</select></td>';
			$aba2.= "\n".'<td class=white><select name=TxtID_MOTORISTA>';
			$strSQL = 'select * from Motorista';
			$smsecurers = mysql_query($strSQL);
			$aba2.= "\n".'<option value=""></option>';
			for ($t = 1; $t <= @mysql_affected_rows(); $t++)
			{
				$row = mysql_fetch_array($smsecurers);
				$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME_GUERRA'] . '</option>';
			}
			$aba2.= "\n".'</select></td>';
			$aba2.= "\n".'<td class=white><select name=TxtID_VIATURA>';
			$strSQL = 'select * from Viatura';
			$smsecurers = mysql_query($strSQL);
			$aba2.= "\n".'<option value=""></option>';
			for ($t = 1; $t <= @mysql_affected_rows(); $t++)
			{
				$row = mysql_fetch_array($smsecurers);
				$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
			}
			$aba2.= "\n".'</select></td>';
			$aba2.= "\n".'</tr>';
			$aba2.= "\n".$_SESSION['FechaMoldura'];

			$aba2.= "\n".$_SESSION['AbreMoldura'];
			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Data (dd/mm/aaaa)</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Hora (hh:mm:ss)</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Despachante</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Odômetro</b></font></td>';
				$aba2.= "\n".'<td class=ColorFormulario><font color=000000><b>Inspeção</b></font></td>';
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;Saída:</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Prevista:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDT_SAI_PREV value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_SAI_PREV value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDA_SAI value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_SAI value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white><select name=TxtDESP_SAI>';
				$strSQL = 'select * from Despachante';
				$smsecurers = mysql_query($strSQL);
				$aba2.= "\n".'<option value=""></option>';
				for ($t = 1; $t <= @mysql_affected_rows(); $t++)
				{
					$row = mysql_fetch_array($smsecurers);
					$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
				}
				$aba2.= "\n".'</select></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtODOM_SAI value="" maxlength=8 size=8></td>';
				if($TxtID_TIPO_SERVICO<>2)
				{
				$aba2.= "\n".'<td class=white><input type=text name=TxtINSPECAO_SAI value="" maxlength=8 size=8></td>';
				}
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;Apresentação:</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Prevista:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDT_APRES_PREV value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_APRES_PREV value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDT_APRES value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_APRES value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;Dispensa:</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Efetiva:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDT_DISP value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_DISP value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$aba2.= "\n".'<td class=white>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$aba2.= "\n".'</tr>';

			$aba2.= "\n".'<tr>';
				$aba2.= "\n".'<td class=white>&nbsp;Regresso:</td>';
				$aba2.= "\n".'<td class=white>&nbsp;Efetivo:</td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtDT_REGRES value="" maxlength=10 size=10></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtH_REGRES value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white><select name=TxtDESP_REGRES>';
				$strSQL = 'select * from Despachante';
				$smsecurers = mysql_query($strSQL);
				$aba2.= "\n".'<option></option>';
				for ($t = 1; $t <= @mysql_affected_rows(); $t++)
				{
					$row = mysql_fetch_array($smsecurers);
					$aba2.= "\n".'<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
				}
				$aba2.= "\n".'</select></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtODOM_REGRES value="" maxlength=8 size=8></td>';
				$aba2.= "\n".'<td class=white><input type=text name=TxtINSPECAO_REGRES value="" maxlength=8 size=8></td>';

			$aba2.= "\n".'</tr>';

			$aba2.= "\n".$_SESSION['FechaMoldura'];
			$aba2.= "\n".$_SESSION['AbreMoldura'];








				$aba1.= "\n".'<td class=white align=right><input type=Submit name=Submit value=Pesquisar></td>';
				$aba2.= "\n".'<td class=white align=right><input type=Submit name=Submit value=Pesquisar></td>';



			ExibeFormComAbas($Titulo,array("Pedido","Execução"),array($aba1,$aba2),"left",$fimdoform,0);

			echo $_SESSION['FechaMoldura'];

			echo '</form>';
		}
	mysql_close($link) ;
?>
</body>
</HTML>
