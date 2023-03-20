<?php

/* Formulário adaptado ao módulo "MinfoRelatorio"
 * by Adriano de Oliveira Gonçalves - MicroInfo Processamento de Dados
 * 03/06/2004
 */
session_start();

include('utilities/check.php');
include("Lib/MinfoMsg.php");
require("Lib/MinfoRelatorio.php");

$_ENV['Relatorio'] = $_GET['Relatorio'];
$_ENV['NomeFormulario'] = 'r71-RelatorioAnaliticoPeriodo';

$ArquivoGravadoX='../Arquivos/r71-relatorio_analitico_periodo.tmp'.date("dmY")."-".rand(1,1000).".rtf";
$ArquivoPadrao = 'relatorios/r71-relatorio_analitico_periodo.rel';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco width=50>';
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

if (isset($_GET['TxtDATAINICIO']))
	$TxtDATAINICIO = VerificaInsercoesmaliciosas($_GET['TxtDATAINICIO']);
else
	$TxtDATAINICIO = '';
if (isset($_GET['TxtDATAFIM']))
	$TxtDATAFIM = VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']);
else
	$TxtDATAFIM = '';
if (isset($_GET['TxtVIATURA']))
	$TxtVIATURA= VerificaInsercoesMaliciosas($_GET['TxtVIATURA']);
else
	$TxtVIATURA = '';

if ($TxtVIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID = '" . $TxtVIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Viatura = " . $TxtVIATURA;
	$Argumento = $Argumento . "TxtVIATURA=" . $TxtVIATURA . "&";
}

if ($TxtDATAINICIO <> '')
{
	$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
	$TxtWhere = $TxtWhere . " AND Atendimento.DATA >= '" . $TxtDATAINICIO1 . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Data Início >= " . $TxtDATAINICIO;
	$Argumento = $Argumento . "TxtDATAINICIO=" . $TxtDATAINICIO . "&";
}
if ($TxtDATAFIM <> '')
{
	$TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
	$TxtWhere = $TxtWhere . " AND Atendimento.DATA <= '" . $TxtDATAFIM1 . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Data Início <= " . $TxtDATAFIM;
	$Argumento = $Argumento . "TxtDATAFIM=" . $TxtDATAFIM . "&";
}
//monto varias variaveis cada uma contendo as condicoes de cada tabela
		$TxtWhere1 = '';
		if ($TxtDATAINICIO <> '')
		{
			$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
			$TxtWhere1 = $TxtWhere1 . " AND Pedido.DATA_PED >= '" . $TxtDATAINICIO1 . "'";
		}
		if ($TxtDATAFIM <> '')
		{
			$TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
			$TxtWhere1 = $TxtWhere1 . " AND Pedido.DATA_PED <= '" . $TxtDATAFIM1 . "'";
		}

		$TxtWhere2 = '';
		if ($TxtDATAINICIO <> '')
		{
			$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
			$TxtWhere2 = $TxtWhere2 . " AND Abastecimento.DATA >= '" . $TxtDATAINICIO1 . "'";
		}
		if ($TxtDATAFIM <> '')
		{
			$TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
			$TxtWhere2 = $TxtWhere2 . " AND Abastecimento.DATA <= '" . $TxtDATAFIM1 . "'";
		}

		$TxtWhere3 = '';
		if ($TxtDATAINICIO <> '')
		{
			$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
			$TxtWhere3 = $TxtWhere3 . " AND Reparo.DATA_INICIO >= '" . $TxtDATAINICIO1 . "'";
		}
		if ($TxtDATAFIM <> '')
		{
			$TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
			$TxtWhere3 = $TxtWhere3 . " AND Reparo.DATA_INICIO <= '" . $TxtDATAFIM1 . "'";
		}

		$TxtWhere4 = '';
		if ($TxtDATAINICIO <> '')
		{
			$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
			$TxtWhere4 = $TxtWhere4 . " AND Viatura_Preventiva.DATA >= '" . $TxtDATAINICIO1 . "'";
		}
		if ($TxtDATAFIM <> '')
		{
			$TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
			$TxtWhere4 = $TxtWhere4 . " AND Viatura_Preventiva.DATA <= '" . $TxtDATAFIM1 . "'";
		}


if ($TxtWhere <> '' or $_GET['TxtOrdenar'] <> '')
{
    $strSQL = 'delete from Temp_R71';
	$smsecurers = mysql_query($strSQL);
	/* Variaves $TxtWhere que serão usadas para as querys em várias tabelas.
	$TxtWhere = $TxtWhere . " AND Viatura.ID = '" . $TxtVIATURA . "'";

	$TxtDATAINICIO1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAINICIO']),0,2);
	$TxtWhere = $TxtWhere . " AND Atendimento.DATA >= '" . $TxtDATAINICIO1 . "'";

    $TxtDATAFIM1 = substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),6,4) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),3,2) . '-' . substr(VerificaInsercoesMaliciosas($_GET['TxtDATAFIM']),0,2);
	$TxtWhere = $TxtWhere . " AND Atendimento.DATA <= '" . $TxtDATAFIM1 . "'";
    */

	if ($TxtVIATURA <> '')
		$TxtWhere = " AND Viatura.ID = '" . $TxtVIATURA . "'";

    $strSQL = 'select * from Viatura where 1=1' . $TxtWhere;
	$smsecurers = mysql_query($strSQL);
	$Contador = @mysql_affected_rows();
	for ($t = 1; $t <= $Contador; $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		//pego a viatura
		$VIATURA = $row['CODIGO_VIATURA'];

		//pego a quantidade de pedidos
		$strSQL1 = 'select sum(1) as PEDIDO from Pedido where ID_VIATURA = ' . $row['ID'] . ' ' . $TxtWhere1;
		$smsecurers1 = mysql_query($strSQL1);
		$row1 = mysql_fetch_array($smsecurers1);
		$PEDIDO = $row1['PEDIDO'];

		//pego a quantidade e o valor de Combustivel
		$strSQL2 = "select QTD_COMBUSTIVEL as 'QUANTIDADE', VALOR_TOTAL as 'VALOR' from Abastecimento where ID_VIATURA = " . $row['ID'] . " " . $TxtWhere2;
		$smsecurers2 = mysql_query($strSQL2);
		$QTD_COMBUSTIVEL = '';
		$VAL_COMBUSTIVEL = '';
		for ($t2 = 1; $t2 <= @mysql_affected_rows(); $t2++)
		{
			$row2 = mysql_fetch_array($smsecurers2);
			$QTD_COMBUSTIVEL = $QTD_COMBUSTIVEL + $row2['QUANTIDADE'];
			$VAL_COMBUSTIVEL = $VAL_COMBUSTIVEL + $row2['VALOR'];
		}

		//pego a quantidade e o valor de Reparos
		$strSQL3 = "select VALOR_REPARO as 'VALOR' from Reparo where ID_VIATURA = " . $row['ID'] . " " . $TxtWhere3;
		$smsecurers3 = mysql_query($strSQL3);
		$QTD_REPAROS = '';
		$VAL_REPAROS = '';
		for ($t3 = 1; $t3 <= @mysql_affected_rows(); $t3++)
		{
			$row3 = mysql_fetch_array($smsecurers3);
			$QTD_REPAROS = @mysql_affected_rows();
			$VAL_REPAROS = $VAL_REPAROS + $row3['VALOR'];
		}

		//pego a quantidade e o valor de preventiva
		$strSQL4 = "select Svc_Preventiva.VALOR as 'VALOR' from Svc_Preventiva, Viatura_Preventiva where Viatura_Preventiva.ID_SVC_PREVENTIVA = Svc_Preventiva.ID and Viatura_Preventiva.ID_VIATURA = " . $row['ID'] . " " . $TxtWhere4;
		$smsecurers4 = mysql_query($strSQL4);
		$QTD_PREVENTIVA = '';
		$VAL_PREVENTIVA = '';
		for ($t4 = 1; $t4 <= @mysql_affected_rows(); $t4++)
		{
			$row4 = mysql_fetch_array($smsecurers4);
			$QTD_PREVENTIVA = @mysql_affected_rows();
			$VAL_PREVENTIVA = $VAL_PREVENTIVA + $row4['VALOR'];
		}
		$TOTAL = $VAL_COMBUSTIVEL + $VAL_REPAROS + $VAL_PREVENTIVA;
		$strSQL5 = "insert into Temp_R71 (VIATURA,PEDIDO,QTD_COMBUSTIVEL,VALOR_COMBUSTIVEL,QTD_REPAROS,VALOR_REPAROS,QTD_PREVENTIVA,VALOR_PREVENTIVA,TOTAL)
					VALUES ('" . $VIATURA . "','" . $PEDIDO . "','" . $QTD_COMBUSTIVEL . "','" . $VAL_COMBUSTIVEL . "','" . $QTD_REPAROS . "','" . $VAL_REPAROS . "','" . $QTD_PREVENTIVA . "','" . $VAL_PREVENTIVA . "','" . $TOTAL . "')";
		$smsecurers5 = mysql_query($strSQL5);
	}



    $ag1= new aguarde("Por favor, aguarde;<BR>relatório em andamento...<BR>");
    $ag1->abre();    // Mensagem de "Aguarde..."

    $smsecurequery = "select VIATURA as 'VIATURA', KILOMETRAGEM AS 'KM', KILOMETRAGEM AS 'KM_MEDIA', QTD_COMBUSTIVEL AS 'QTD_COMB', VALOR_COMBUSTIVEL AS 'VALOR_COMB', VALOR_REPAROS AS 'VALOR_REPAROS', VALOR_PREVENTIVA AS 'VALOR_PREVENTIVA', TOTAL AS 'TOTAL' FROM Temp_R71 order by " . VerificaInsercoesMaliciosas($_GET['TxtOrdenar']);

	$smsecurers1 = mysql_query($smsecurequery);

    $Registros=@mysql_affected_rows();
	$TOTAL_GERAL = '';
	for ($t4 = 1; $t4 <= $Registros; $t4++)
	{
		$row4 = mysql_fetch_array($smsecurers1);
		$TOTAL_GERAL = $TOTAL_GERAL + $row4['TOTAL'];
	}

    if ($Registros <= 0)
    {
            echo "Não retornou nenhum registro..." ;
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
            $ag1->fecha();   /* Fecha janela de "Aguarde" */
            exit;
    }

    /* Neste ponto acontece a geração do relatório. */
    echo "<BR><b>Aguarde...</b>";
    flush();

    $VARIAVEIS["QUERY1"]        = $smsecurequery;
    $VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
    $VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];
    $VARIAVEIS["TxtFiltro"]		= $MsgTxtWhere . " ";
    $VARIAVEIS["TOTAL_GERAL"]   = $TOTAL_GERAL;

    if(PreRelat($VARIAVEIS,$ArquivoPadrao,$ArquivoGravadoX))
    {
        echo "<BR><BR><B>Houveram erros na geração do relatório. Favor contactar o administrador do sistema.</B>";
        $ag1->fecha();
        @unlink($ArquivoGravadoX);
        exit;
    }
    $ag1->fecha();   /* Fecha janela de "Aguarde" */
    passthru("/usr/share/ted/Ted/rtf2pdf.sh --paper letter  " . $ArquivoGravadoX . " " . substr($ArquivoGravadoX,0,strlen($ArquivoGravadoX)-4) . ".pdf ");
    //unlink($ArquivoGravadoX);
    echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
    echo "<script>window.open('" .  $ArquivoGravadoX . "');</script>";
}
else
{
        FormularioPesquisa();
}


function FormularioPesquisa()
{
    echo '<form name=r71-RelatorioAnaliticoPeriodo method=GET action=r71-RelatorioAnaliticoPeriodo.php>';
    ExibeTitulo('R71 - Relatório Analítico por Período');
    echo '<td align=right width=90%><font face=verdana size=-2>';
    echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>Viatura</b></td>';
	echo '<td class=ColorFormulario><b>Período de (dd/mm/aaaa) até (dd/mm/aaaa)</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtVIATURA>';
	echo '<option></option>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type="text" name="TxtDATAINICIO" maxlength="10" size="10" />';
	echo '<input type="text" name="TxtDATAFIM" maxlength="10" size="10" /></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white align=center>Ordenar por:<select name=TxtOrdenar>';
	echo '<option value="Temp_R71.VIATURA">Viatura</option>';
	echo '<option value="Temp_R71.TOTAL">Total</option>';
	echo '</select></td>';
	echo '<td class=white align=center>';
	echo '<input type=Submit name=Submit value=Pesquisar>';
	echo '</td></tr>';
	echo $_SESSION['FechaMoldura'];
        echo '</form>';
}
?>
</body>
</HTML>
