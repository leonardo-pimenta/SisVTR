<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_VIATURA"] 	= "Viatura/Placa";
$_Mascara["DATA"] 	= "Data (dd/mm/aaaa)";
$_Mascara["ODOMETRO"]           = "Odômetro";

$CodigoPagina = 'FrmCadastroControle_Pecas';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroControle_Pecas';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroControle_Pecas.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtDATA']))
	$TxtDATA = VerificaInsercoesMaliciosas($_GET['TxtDATA']);
else
	$TxtDATA = '';

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
	$TxtWhere = $TxtWhere . " AND Controle_Pecas.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtDATA <> '')
{
	$TxtWhere = $TxtWhere . " AND Controle_Pecas.DATA = '" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["DATA"] . " =" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2);
	$Argumento = $Argumento . "TxtDATA=".$TxtDATA . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Controle_Pecas.ID AS `ID`, CONCAT(Viatura.CODIGO_VIATURA,' - ',Viatura.PLACA) AS `" . $_Mascara['ID_VIATURA'] . "`, Controle_Pecas.DATA AS `" . $_Mascara['DATA'] . "`,Controle_Pecas.ODOMETRO AS `Odômetro`  from  Controle_Pecas,Viatura where 1=1 AND Controle_Pecas.ID_VIATURA = Viatura.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroControle_Pecas"," Controle de Peças ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_VIATURA,DATA  from  Controle_Pecas";
	$NomeForm = "FrmCadastroControle_Pecas";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);

		$smsecurequery = "Select * from Controle_Pecas where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Controle_Pecas(ID_VIATURA,DATA,ODOMETRO)
		 VALUES
		 ('" . $TxtID_VIATURA ."','" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) ."','" . $TxtODOMETRO ."')";

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
		$TxtDATA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA']);
		$TxtODOMETRO 	= VerificaInsercoesMaliciosas($_POST['TxtODOMETRO']);

		$strSQL = "Update  Controle_Pecas set
			ID_VIATURA			='" . $TxtID_VIATURA .
			"',ODOMETRO			='" . $TxtODOMETRO .
			"',DATA			='" . substr($TxtDATA,6,4) . "-" . substr($TxtDATA,3,2) . "-" . substr($TxtDATA,0,2) ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Controle_Pecas    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroControle_Pecas.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroControle_Pecas.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroControle_Pecas.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_VIATURA,DATA,ODOMETRO  from  Controle_Pecas  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroControle_Pecas') ;

	echo '<script>document.FrmCadastroControle_Pecas.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroControle_Pecas.TxtID_VIATURA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroControle_Pecas.Submit.value="Alterar"</SCRIPT>';
	}


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
    	   			$Edita = False;
				if ($_ENV['DEBUG']) echo $strSQL;

				$link = mysql_connect($_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha']) or die("Não pude conectar");
				if ($_ENV['DEBUG']) echo "ABRI O BANCO".$_ENV['Servidor'],$_ENV['Usuario'],$_ENV['Senha'];

				MYSQL_SELECT_DB($_ENV['NomeBase']);

				if ($_ENV['DEBUG']) echo "SELECIONEI A BASE:".$_ENV['NomeBase'];

				$smsecurers1 = mysql_query($strSQL);

				$row1 = mysql_fetch_array($smsecurers1);



					$_Mascara1 	= array();
					$_Mascara1["ID"] 	= "";
					$_Mascara1["ID_CONTROLE_PECAS"] 	= "Cod. do Controle";
					$_Mascara1["ID_PECA"] 	= "Peça";
					$_Mascara1["ID_SITUACAO_PECA"] 	= "Situação da Peça";
					$_Mascara1["ID_VIATURA"] 	= "Viatura";


					$smsecurequery1 = "Select Pecas_Controle.ID AS `ID`, Viatura.CODIGO_VIATURA AS `" . $_Mascara1['ID_VIATURA'] . "`, Controle_Pecas.ID AS `" . $_Mascara1['ID_CONTROLE_PECAS'] . "`, Pecas.DESCRICAO AS `" . $_Mascara1['ID_PECA'] . "`, Situacao_Peca.DESCRICAO AS `" . $_Mascara1['ID_SITUACAO_PECA'] . "`  from  Pecas_Controle,Viatura,Controle_Pecas,Pecas,Situacao_Peca where 1=1 AND Pecas_Controle.ID_VIATURA = Viatura.ID AND Pecas_Controle.ID_CONTROLE_PECAS = Controle_Pecas.ID AND Pecas_Controle.ID_PECA = Pecas.ID AND Pecas_Controle.ID_SITUACAO_PECA = Situacao_Peca.ID and Controle_Pecas.ID='" . VerificaInsercoesMaliciosas($_GET['Codigo']) . "' and Viatura.ID=Controle_Pecas.ID_VIATURA";


					//echo $row1["TP_INSPECAO"];
					//echo $smsecurequery1;
					if($TxtOpcao<>"V")
					{
						//echo "<center><a href=FrmCadastroPecas_Controle.php?TxtOpcao=I&TP_INSPECAO='" . $row1["TP_INSPECAO"] . "'&Codigo='" . $row1["ID"] . "' ><b>Inspecionar Ítem</center></b></a>";

						echo "<form name=FrmCadastroInspecao2 method=post action=FrmCadastroPecas_Controle.php?TxtOpcao=I&ID_VIATURA=" . $row1["ID_VIATURA"] . "&Codigo=" . $row1["ID"] . ">";
						echo '<center><input type=Submit name=Submit3 value=Controlar&nbsp;Peça></center></form>';
					}
					ExibeDados($smsecurequery1,9,"FrmCadastroPecas_Controle"," Inspeção de Ítens ",$Edita, $MsgTxtWhere,$Linhas,$Pagina,$row1["ID"],$row1["TP_INSPECAO"]);



}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroControle_Pecas method=post action=FrmCadastroControle_Pecas.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Controle de Peças';

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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["DATA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ODOMETRO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	if($TxtOpcao=="I")
	{
		echo "<td class=white><input type=text name=TxtDATA value='" . date(d) ."/" . date(m) . "/" . date(Y) . "' maxlength=10 size=10></td>";

	}
	else
	{
		echo "<td class=white><input type=text name=TxtDATA value='' maxlength=10 size=10></td>";

	}
	echo"<td class=white><input type=text name=TxtODOMETRO value='' maxlength=8 size=8></td>";
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroControle_Pecas)>';
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
	echo '<form name=FrmCadastroControle_Pecas method=GET action=FrmCadastroControle_Pecas.php>';
	ExibeTitulo('Pesquisa ->Controle de Peças');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '&nbsp;-&nbsp;' .  $row['PLACA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtDATA maxlength=10 size=10></td>';
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
