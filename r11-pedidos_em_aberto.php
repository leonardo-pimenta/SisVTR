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
$_ENV['NomeFormulario'] = 'r11-pedidos_em_aberto';

$ArquivoGravadoX='../Arquivos/r11-pedidos_em_aberto.tmp'.date("dmY")."-".rand(1,1000).".rtf";
$ArquivoPadrao = 'relatorios/r11-pedidos_em_aberto.rel';

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

if (isset($_GET['TxtOM_NOME']))
	$TxtOM_NOME = VerificaInsercoesMaliciosas($_GET['TxtOM_NOME']);
else
	$TxtOM_NOME = '';

if (isset($_GET['TxtOM_SIGLA']))
	$TxtOM_SIGLA = VerificaInsercoesMaliciosas($_GET['TxtOM_SIGLA']);
else
	$TxtOM_SIGLA = '';

if ($TxtOM_NOME <> '')
{
	$TxtWhere = $TxtWhere . " AND Om.DESCRICAO LIKE '%" . $TxtOM_NOME . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  "Nome OM = " . $TxtOM_NOME;
	$Argumento = $Argumento . "TxtOM_NOME=" . $TxtOM_NOME . "&";
}

if ($TxtOM_SIGLA <> '')
{
	$TxtWhere = $TxtWhere . " AND Om.SIGLA LIKE '%" . $TxtOM_SIGLA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  "Sigla OM = " . $TxtOM_SIGLA;
	$Argumento = $Argumento . "TxtOM_SIGLA=" . $TxtOM_SIGLA . "&";
}

if ($TxtWhere <> '' or $_GET['TxtOrdenar'] <> '')
{
    $ag1= new aguarde("Por favor, aguarde;<BR>relatório em andamento...<BR>");
    $ag1->abre();    // Mensagem de "Aguarde..."

    $smsecurequery = "select CONCAT(substring(Pedido.DT_APRES_PREV,9,2),'/',substring(Pedido.DT_APRES_PREV,6,2),'/',substring(Pedido.DT_APRES_PREV,1,4),'-',Pedido.H_APRES_PREV) AS 'DT_APRESENTACAO', Om.SIGLA AS 'OM', Pedido.DESTINO_PED AS 'DESTINO', CONCAT(substring(Pedido.DATA_PED,9,2),'/',substring(Pedido.DATA_PED,6,2),'/',substring(Pedido.DATA_PED,1,4),'-',Pedido.H_PED) AS 'DT_PEDIDO' from Pedido, Om where Pedido.ID_OM = Om.ID and Pedido.DA_SAI = '0000-00-00'" . $TxtWhere . " order by " . VerificaInsercoesMaliciosas($_GET['TxtOrdenar']);

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
    echo '<form name=r11-pedidos_em_aberto method=GET action=r11-pedidos_em_aberto.php>';
    ExibeTitulo('R11 - Pedidos Em Aberto');
    echo '<td align=right width=90%><font face=verdana size=-2>';
    echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>Sigla OM Solicitante</b></td>';
	echo '<td class=ColorFormulario><b>Nome OM Solicitante</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtOM_SIGLA>';
	echo '<option></option>';
	$strSQL = 'select * from Om order by SIGLA';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['SIGLA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white height=32><select name=TxtOM_NOME>';
	echo '<option></option>';
	$strSQL = 'select * from Om order by DESCRICAO';
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
	echo '<td class=white align=center>Ordenar por:<select name=TxtOrdenar>';
	echo '<option value="Pedido.DT_APRES_PREV, Pedido.H_APRES_PREV">Data/Hora Apresentação</option>';
	echo '<option value="Om.SIGLA">OM Solicitante</option>';
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
