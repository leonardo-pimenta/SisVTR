<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_VIATURA"] 	= "Viatura";
$_Mascara["ID_ITENS_PARA_INSPECAO"] 	= "Itens";

$CodigoPagina = 'FrmCadastroItens_inspecao_viaturas';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroItens_inspecao_viaturas';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroItens_inspecao_viaturas.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_ITENS_PARA_INSPECAO']))
	$TxtID_ITENS_PARA_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtID_ITENS_PARA_INSPECAO']);
else
	$TxtID_ITENS_PARA_INSPECAO = '';

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
	$TxtWhere = $TxtWhere . " AND Itens_inspecao_viaturas.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtID_ITENS_PARA_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO = '" . $TxtID_ITENS_PARA_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_ITENS_PARA_INSPECAO"] . " = " . $TxtID_ITENS_PARA_INSPECAO;
	$Argumento = $Argumento . "TxtID_ITENS_PARA_INSPECAO=".$TxtID_ITENS_PARA_INSPECAO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Itens_inspecao_viaturas.ID AS `ID`, Viatura.PLACA AS `" . $_Mascara['ID_VIATURA'] . "`, Itens_para_inspecao.DESCRICAO AS `" . $_Mascara['ID_ITENS_PARA_INSPECAO'] . "`  from  Itens_inspecao_viaturas, Viatura, Itens_para_inspecao WHERE Viatura.ID = Itens_inspecao_viaturas.ID_VIATURA and Itens_para_inspecao.ID = Itens_inspecao_viaturas.ID_ITENS_PARA_INSPECAO" . $TxtWhere ." order by placa";

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroItens_inspecao_viaturas"," Itens de Inspeção das Viaturas ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT ID_VIATURA,ID_ITENS_PARA_INSPECAO  from  Itens_inspecao_viaturas";
	$NomeForm = "FrmCadastroItens_inspecao_viaturas";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
        $strSQL = "delete from `Itens_inspecao_viaturas` where ID_VIATURA='" . $TxtID_VIATURA . "'";
	    $smsecurers = mysql_query($strSQL);
        $strSQL1 = "select ID from `Itens_para_inspecao`";
	    $smsecurers1 = mysql_query($strSQL1);
	    $columns = mysql_num_rows($smsecurers1);

        for ($i = 0; $i <= $columns ; $i++)
	        {

            $row = mysql_fetch_array($smsecurers1);
	        
		    $TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO'.$row['ID']]);
            $TxtCONFIRMA = VerificaInsercoesMaliciosas($_POST['TxtCONFIRMA'.$i]);
            $smsecurequery = "Select * from Itens_inspecao_viaturas where ID = '" . $TxtID . "'";
		    $smsecurers = mysql_query($smsecurequery);
		    if (@mysql_affected_rows()>0)
		    {
			    echo "<center>Já existe esse registro cadastrado na base!</center>";
			    echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			    sair();;
             }

             if ($TxtCONFIRMA != "0")
             {
                $strSQL = "insert into Itens_inspecao_viaturas(ID_VIATURA,ID_ITENS_PARA_INSPECAO)
		        VALUES
		        ('" . $TxtID_VIATURA ."','" . $TxtID_ITENS_PARA_INSPECAO .$row['ID']."')";
                $smsecurers = mysql_query($strSQL);
             }

             }
	         VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtID_ITENS_PARA_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_ITENS_PARA_INSPECAO']);

		$strSQL = "Update  Itens_inspecao_viaturas set 
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',ID_ITENS_PARA_INSPECAO			='" . $TxtID_ITENS_PARA_INSPECAO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Itens_inspecao_viaturas    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroItens_inspecao_viaturas.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_inspecao_viaturas.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroItens_inspecao_viaturas.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,ID_ITENS_PARA_INSPECAO  from  Itens_inspecao_viaturas  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroItens_inspecao_viaturas') ;

	echo '<script>document.FrmCadastroItens_inspecao_viaturas.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroItens_inspecao_viaturas.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroItens_inspecao_viaturas.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	echo '<form name=FrmCadastroItens_inspecao_viaturas method=post action=FrmCadastroItens_inspecao_viaturas.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Itens de Inspeção das Viaturas';
	
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
	echo '<td colspan=2 class=ColorFormulario><font color=000000><b>Placa</b></font>' ;
    echo '&nbsp;<select name=TxtID_VIATURA>';

	$strSQL = 'select ID,PLACA from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] ;
        echo '>' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td></tr>';

	$strSQL1 = 'select * from `Itens_para_inspecao`';
	$smsecurers1 = mysql_query($strSQL1);
	for ($ts = 1; $ts <= @mysql_affected_rows(); $ts++)
    {
    echo '<tr>';
    echo '<td class=white height=32>' ;
   	$row1 = mysql_fetch_array($smsecurers1);
	echo '<SPAN>' .  $row1['DESCRICAO'] . '</SPAN>';
    echo '<input type=hidden name=TxtID_ITENS_PARA_INSPECAO value="' . $row['ID'] . '">';
    echo '</td>';
    echo '<td class=white height=32><select name=TxtCONFIRMA'.$ts.'>';
	echo '<option value="1">Sim</option>';
	echo '<option value="0">Nao</option>';
 	echo '</select></td>';
	echo '</tr>';
	}
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroItens_inspecao_viaturas)>';
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
	echo '<form name=FrmCadastroItens_inspecao_viaturas method=GET action=FrmCadastroItens_inspecao_viaturas.php>';
	ExibeTitulo('Pesquisa ->Itens de Inspeção das Viaturas');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_ITENS_PARA_INSPECAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white height=32><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
    echo '<option value =>Todos</option>';
    for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white height=32><select name=TxtID_ITENS_PARA_INSPECAO>';
	$strSQL = 'select * from Itens_para_inspecao';
	$smsecurers = mysql_query($strSQL);
    echo '<option value =>Todos</option>';
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
