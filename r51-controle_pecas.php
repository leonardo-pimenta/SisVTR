<?php

/* Formul�rio adaptado ao m�dulo "MinfoRelatorio"
 * by Adriano de Oliveira Gon�alves - MicroInfo Processamento de Dados
 * 03/06/2004
 */
session_start();

include('utilities/check.php');
include("Lib/MinfoMsg.php");
require("Lib/MinfoRelatorio.php");

$_ENV['Relatorio'] = $_GET['Relatorio'];
$_ENV['NomeFormulario'] = 'r51-controle_pecas';

$ArquivoGravadoX='../Arquivos/r51-controle_pecas.tmp'.date("dmY")."-".rand(1,1000).".rtf";
$ArquivoPadrao = 'relatorios/r51-controle_de_pecas.rel';

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


if ($TxtVIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Controle_Pecas.ID_VIATURA  = '" . $TxtVIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  "Viatura = " . $TxtVIATURA;
	$Argumento = $Argumento . "TxtVIATURA=" . $TxtVIATURA . "&";
}



if ($TxtWhere <> '' or $_GET['TxtOrdenar'] <> '')
{
    $ag1= new aguarde("Por favor, aguarde;<BR>relat�rio em andamento...<BR>");
    $ag1->abre();    // Mensagem de "Aguarde..."

    $smsecurequery = "select Pecas.DESCRICAO AS `PECA`,CONCAT(substring(Controle_Pecas.DATA,9,2),'/',substring(Controle_Pecas.DATA,6,2),'/',substring(Controle_Pecas.DATA,1,4)) AS 'DATA',Controle_Pecas.ODOMETRO as 'ODOMETRO',Situacao_Peca.DESCRICAO AS `SITUACAO` from Pecas,Controle_Pecas,Pecas_Controle,Situacao_Peca where Controle_Pecas.ID=Pecas_Controle.ID_CONTROLE_PECAS and Pecas.ID=Pecas_Controle.ID_PECA and Situacao_Peca.ID=Pecas_Controle.ID_SITUACAO_PECA   " . $TxtWhere . " order by Controle_Pecas.ID";

	$smsecurers1 = mysql_query($smsecurequery);

    $Registros=@mysql_affected_rows();

    if ($Registros <= 0)
    {
            echo "N�o retornou nenhum registro..." ;
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
            $ag1->fecha();   /* Fecha janela de "Aguarde" */
            exit;
    }

    /* Neste ponto acontece a gera��o do relat�rio. */
    echo "<BR><b>Aguarde...</b>";
    flush();

    $VARIAVEIS["QUERY1"]        = $smsecurequery;
    $VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
    $VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];
    $VARIAVEIS["TxtFiltro"]		= $MsgTxtWhere . " ";

    if(PreRelat($VARIAVEIS,$ArquivoPadrao,$ArquivoGravadoX))
    {
        echo "<BR><BR><B>Houveram erros na gera��o do relat�rio. Favor contactar o administrador do sistema.</B>";
        $ag1->fecha();
        @unlink($ArquivoGravadoX);
        exit;
    }
    $ag1->fecha();   /* Fecha janela de "Aguarde" */
    //passthru("/usr/share/ted/Ted/rtf2pdf.sh --paper letter  " . $ArquivoGravadoX . " " . substr($ArquivoGravadoX,0,strlen($ArquivoGravadoX)-4) . ".pdf ");
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
    echo '<form name=r51-controle_pecas method=GET action=r51-controle_pecas.php>';
    ExibeTitulo('R51 - Controle de Pe�as');
    echo '<td align=right width=90%><font face=verdana size=-2>';
    echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>Viatura</b></td>';
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
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white align=center>Ordenar por:<select name=TxtOrdenar>';
	echo '<option value="Viatura.CODIGO_VIATURA">Viatura</option>';
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
