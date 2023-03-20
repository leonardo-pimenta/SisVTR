<?php

// JGBAIAO@YAHOO.COM
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// todos os direitos reservados a JGBAIAO@YAHOO.COM

/* Formulário adaptado ao módulo "MinfoRelatorio"
 * by Adriano de Oliveira Gonçalves - MicroInfo Processamento de Dados
 * 04/06/2004
 */

session_start();



require("Lib/MinfoRelatorio.php");
include("Lib/MinfoMsg.php");

$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioPreventiva'.date("dmY")."-".rand(1,1000).".rtf";
$MASCARA_RELATORIO='relatorios/RelatorioPreventiva.rel';

$filelevel = 1;
include('utilities/check.php');

$_ENV['Relatorio'] = $_GET['Relatorio'];
$_ENV['NomeFormulario'] = 'FrmPesquisaPreventiva';
require('utilities/MinfoAbas.php');
require('utilities/Cabecalho.php');

if (isset($_POST['TxtTipoFormulario']))
        $TxtTipoFormulario = VerificaInsercoesMaliciosas($_POST['TxtTipoFormulario']);
else
        $TxtTipoFormulario = '';

if (isset($_GET['TxtOpcao']))
        $TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
else
$TxtOpcao = '';



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



    $ag1= new aguarde("Por Favor, Aguarde;<BR>Relatório em Andamento...<BR>");;
    $ag1->abre();    /* Mensagem de "Aguarde..." */

    $smsecurequery = "Select Svc_Preventiva.DESCRICAO AS `SERVICO`,Svc_Preventiva.KILOMETRAGEM AS `KILOMETRAGEM`,Viatura.CODIGO_VIATURA AS `VIATURA`,Viatura.PLACA AS `PLACA`,CONCAT(SUBSTRING(Viatura_Preventiva.DATA,9,2),'-',SUBSTRING(Viatura_Preventiva.DATA,6,2),'-',SUBSTRING(Viatura_Preventiva.DATA,1,4)) AS `ULTIMA_DT`,Viatura.ODOMETRO AS `KM_ATUAL`,Viatura_Preventiva.ODOMETRO AS `EXEC_KM`, ((Viatura.ODOMETRO-Viatura_Preventiva.ODOMETRO)-KILOMETRAGEM) AS `EXCESSO` from  Viatura,Svc_Preventiva,Viatura_Preventiva where 1=1 AND Viatura.ID=Viatura_Preventiva.ID_VIATURA and Svc_Preventiva.ID=Viatura_Preventiva.ID_SVC_PREVENTIVA" . $TxtWhere . " ORDER BY Viatura_Preventiva.ID_VIATURA";
    //echo $smsecurequery;
    //exit;

    $link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die("Não pude conectar");
    MYSQL_SELECT_DB($_ENV['NomeBase']);

    $smsecurers1 = mysql_query($smsecurequery);
    $Registros  = @mysql_num_rows($smsecurers1);

    if ($Registros <= 0)
    {
            echo "Não retornou nenhum registro..." ;
        $ag1->fecha();   /* Fecha janela de "Aguarde" */
            exit;
    }

    /* Neste ponto acontece a geração do relatório. */
    echo "<BR><b>Aguarde...</b>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<cneter><a href=default.php>Voltar</a></center>";
    flush();
    $VARIAVEIS["QUERY1"]        = $smsecurequery;

    $VARIAVEIS["TxtTITULO"]     = "R05 - PROCESSOS POR TIPO DE AÇÃO, por ".ucfirst(strtolower($_GET['TxtORDENAR']));
//    $VARIAVEIS["TxtTITULO"]     = "R05 - PROCESSOS POR TIPO DE AÇÃO";
    $VARIAVEIS["TxtFiltro"]     = $MsgTxtWhere;
    $VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
    $VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];

    if(PreRelat($VARIAVEIS,$MASCARA_RELATORIO,$ARQUIVO_TEMPORARIO))
    {
        echo "<BR><BR><B>Houveram erros na geração do relatório. Favor contactar o administrador do sistema.</B>";
        $ag1->fecha();
        @unlink($ArquivoGravadoX);
        exit;
    }
    $ag1->fecha();   /* Fecha janela de "Aguarde" */
    //RtfToPdf($ARQUIVO_TEMPORARIO);
    echo "<script>window.open('" . $ARQUIVO_TEMPORARIO . "');</script>";

?>
</body>
</HTML>






