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
$_ENV['NomeFormulario'] = 'r41-abastecimento_viatura';

$ArquivoGravadoX='../Arquivos/r41-abastecimento_viatura.tmp'.date("dmY")."-".rand(1,1000).".rtf";
$ArquivoPadrao = 'relatorios/r41-abastecimento_viatura.rel';

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

if (isset($_GET['TxtVIATURA']))
	$TxtVIATURA = VerificaInsercoesMaliciosas($_GET['TxtVIATURA']);
else
	$TxtVIATURA = '';
if (isset($_GET['TxtREPARADOR']))
	$TxtREPARADOR= VerificaInsercoesMaliciosas($_GET['TxtREPARADOR']);
else
	$TxtREPARADOR = '';
if (isset($_GET['TxtSITUACAO']))
	$TxtSITUACAO= VerificaInsercoesMaliciosas($_GET['TxtSITUACAO']);
else
	$TxtSITUACAO = '';
if (isset($_GET['TxtDATA1']))
	$TxtDATA1 = VerificaInsercoesMaliciosas($_GET['TxtDATA1']);
else
	$TxtDATA1 = '';
if (isset($_GET['TxtDATA2']))
	$TxtDATA2 = VerificaInsercoesMaliciosas($_GET['TxtDATA2']);
else
	$TxtDATA2 = '';

if ($TxtVIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Viatura.ID = '" . $TxtVIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Viatura = " . $TxtVIATURA;
	$Argumento = $Argumento . "TxtVIATURA=" . $TxtVIATURA . "&";
}

if ($TxtREPARADOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Reparador.ID = '" . $TxtREPARADOR . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Reparador = " . $TxtREPARADOR;
	$Argumento = $Argumento . "TxtREPARADOR=" . $TxtREPARADOR . "&";
}

if ($TxtDATA1 <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.DATA >= '" . substr($TxtDATA1,6,4) . '-' . substr($TxtDATA1,3,2) . '-' . substr($TxtDATA1,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Data = " . $TxtDATA1;
	$Argumento = $Argumento . "TxtDATA1=" . $TxtDATA1 . "&";
}

if ($TxtDATA2 <> '')
{
	$TxtWhere = $TxtWhere . " AND Abastecimento.DATA <= '" . substr($TxtDATA2,6,4) . '-' . substr($TxtDATA2,3,2) . '-' . substr($TxtDATA2,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Data = " . $TxtDATA2;
	$Argumento = $Argumento . "TxtDATA2=" . $TxtDATA2 . "&";
}

if ($TxtWhere <> '' or $_GET['TxtOrdenar'] <> '')
{
    $ag1= new aguarde("Por favor, aguarde;<BR>relatório em andamento...<BR>");
    $ag1->abre();    // Mensagem de "Aguarde..."

    $smsecurequery = "select CONCAT(substring(Abastecimento.DATA,9,2),'/',substring(Abastecimento.DATA,6,2),'/',substring(Abastecimento.DATA,1,4)) AS 'DATA', Viatura.CODIGO_VIATURA as 'VIATURA', Abastecimento.ODOMETRO as 'ODOMETRO', Abastecimento.QTD_COMBUSTIVEL as 'QUANTIDADE', Local_Abastc.DESCRICAO as 'LOCAL', Abastecimento.RESPONSAVEL as 'RESPONSAVEL', Abastecimento.TP_COMBUSTIVEL as 'COMBUSTIVEL' from Abastecimento, Local_Abastc, Viatura where Viatura.ID = Abastecimento.ID_VIATURA and Local_Abastc.ID = Abastecimento.ID_LOCAL_ABASTEC " . $TxtWhere . " order by " . VerificaInsercoesMaliciosas($_GET['TxtOrdenar']);

	$smsecurers1 = mysql_query($smsecurequery);

    $Registros=@mysql_affected_rows();

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
    echo '<form name=r41-abastecimento_viatura method=GET action=r41-abastecimento_viatura.php>';
    ExibeTitulo('R41 - Abastecimento das Viaturas');
    echo '<td align=right width=90%><font face=verdana size=-2>';
    echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>Viatura</b></td>';
	echo '<td class=ColorFormulario><b>Período (dd/mm/aaaa)</b></td>';
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
	echo '<td class=white>de:<input type=text name=TxtDATA1 maxlength=10 size=10>até:<input type=text name=TxtDATA2 maxlength=10 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white align=center>Ordenar por:<select name=TxtOrdenar>';
	echo '<option value="Abastecimento.DATA, Abastecimento.HORA">DATA</option>';
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
