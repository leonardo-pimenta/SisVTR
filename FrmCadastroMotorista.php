<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["MATRICULA"] 	= "Matrícula";
$_Mascara["GRADUACAO"] 	= "Graduação";
$_Mascara["ESPECIALIDADE"] 	= "Especialiadade";
$_Mascara["NOME"] 	= "Nome";
$_Mascara["NOME_GUERRA"] 	= "Nome de Guerra";
$_Mascara["F_CELULAR"] 	= "Telefone Celular";
$_Mascara["F_RESIDENCIA"] 	= "Telefone Residencial";
$_Mascara["ENDERECO"] 	= "Endereço";
$_Mascara["COMPLEMENTO"] 	= "Complemento";
$_Mascara["VALIDADE_HAB"] 	= "Validade CNH";
$_Mascara["TIPO_HAB"] 	= "Tipo de Habilitação";

$CodigoPagina = 'FrmCadastroMotorista';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroMotorista';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroMotorista.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtMATRICULA']))
	$TxtMATRICULA = VerificaInsercoesMaliciosas($_GET['TxtMATRICULA']);
else
	$TxtMATRICULA = '';

if (isset($_GET['TxtGRADUACAO']))
	$TxtGRADUACAO = VerificaInsercoesMaliciosas($_GET['TxtGRADUACAO']);
else
	$TxtGRADUACAO = '';

if (isset($_GET['TxtESPECIALIDADE']))
	$TxtESPECIALIDADE = VerificaInsercoesMaliciosas($_GET['TxtESPECIALIDADE']);
else
	$TxtESPECIALIDADE = '';

if (isset($_GET['TxtNOME']))
	$TxtNOME = VerificaInsercoesMaliciosas($_GET['TxtNOME']);
else
	$TxtNOME = '';

if (isset($_GET['TxtNOME_GUERRA']))
	$TxtNOME_GUERRA = VerificaInsercoesMaliciosas($_GET['TxtNOME_GUERRA']);
else
	$TxtNOME_GUERRA = '';

if (isset($_GET['TxtF_CELULAR']))
	$TxtF_CELULAR = VerificaInsercoesMaliciosas($_GET['TxtF_CELULAR']);
else
	$TxtF_CELULAR = '';

if (isset($_GET['TxtF_RESIDENCIA']))
	$TxtF_RESIDENCIA = VerificaInsercoesMaliciosas($_GET['TxtF_RESIDENCIA']);
else
	$TxtF_RESIDENCIA = '';

if (isset($_GET['TxtENDERECO']))
	$TxtENDERECO = VerificaInsercoesMaliciosas($_GET['TxtENDERECO']);
else
	$TxtENDERECO = '';

if (isset($_GET['TxtCOMPLEMENTO']))
	$TxtCOMPLEMENTO = VerificaInsercoesMaliciosas($_GET['TxtCOMPLEMENTO']);
else
	$TxtCOMPLEMENTO = '';

if (isset($_GET['TxtVALIDADE_HAB']))
	$TxtVALIDADE_HAB = VerificaInsercoesMaliciosas($_GET['TxtVALIDADE_HAB']);
else
	$TxtVALIDADE_HAB = '';

if (isset($_GET['TxtTIPO_HAB']))
	$TxtTIPO_HAB = VerificaInsercoesMaliciosas($_GET['TxtTIPO_HAB']);
else
	$TxtTIPO_HAB = '';

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

if ($TxtMATRICULA <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.MATRICULA LIKE '%" . $TxtMATRICULA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["MATRICULA"] . " = " . $TxtMATRICULA;
	$Argumento = $Argumento . "TxtMATRICULA=".$TxtMATRICULA . "&";
}

if ($TxtGRADUACAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.GRADUACAO LIKE '%" . $TxtGRADUACAO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["GRADUACAO"] . " = " . $TxtGRADUACAO;
	$Argumento = $Argumento . "TxtGRADUACAO=".$TxtGRADUACAO . "&";
}

if ($TxtESPECIALIDADE <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.ESPECIALIDADE LIKE '%" . $TxtESPECIALIDADE . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ESPECIALIDADE"] . " = " . $TxtESPECIALIDADE;
	$Argumento = $Argumento . "TxtESPECIALIDADE=".$TxtESPECIALIDADE . "&";
}

if ($TxtNOME <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.NOME LIKE '%" . $TxtNOME . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NOME"] . " = " . $TxtNOME;
	$Argumento = $Argumento . "TxtNOME=".$TxtNOME . "&";
}

if ($TxtNOME_GUERRA <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.NOME_GUERRA LIKE '%" . $TxtNOME_GUERRA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["NOME_GUERRA"] . " = " . $TxtNOME_GUERRA;
	$Argumento = $Argumento . "TxtNOME_GUERRA=".$TxtNOME_GUERRA . "&";
}

if ($TxtF_CELULAR <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.F_CELULAR LIKE '%" . $TxtF_CELULAR . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["F_CELULAR"] . " = " . $TxtF_CELULAR;
	$Argumento = $Argumento . "TxtF_CELULAR=".$TxtF_CELULAR . "&";
}

if ($TxtF_RESIDENCIA <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.F_RESIDENCIA LIKE '%" . $TxtF_RESIDENCIA . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["F_RESIDENCIA"] . " = " . $TxtF_RESIDENCIA;
	$Argumento = $Argumento . "TxtF_RESIDENCIA=".$TxtF_RESIDENCIA . "&";
}

if ($TxtENDERECO <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.ENDERECO LIKE '%" . $TxtENDERECO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ENDERECO"] . " = " . $TxtENDERECO;
	$Argumento = $Argumento . "TxtENDERECO=".$TxtENDERECO . "&";
}

if ($TxtCOMPLEMENTO <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.COMPLEMENTO LIKE '%" . $TxtCOMPLEMENTO . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["COMPLEMENTO"] . " = " . $TxtCOMPLEMENTO;
	$Argumento = $Argumento . "TxtCOMPLEMENTO=".$TxtCOMPLEMENTO . "&";
}

if ($TxtVALIDADE_HAB <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.VALIDADE_HAB LIKE '%" . $TxtVALIDADE_HAB . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["VALIDADE_HAB"] . " = " . $TxtVALIDADE_HAB;
	$Argumento = $Argumento . "TxtVALIDADE_HAB=".$TxtVALIDADE_HAB . "&";
}

if ($TxtTIPO_HAB <> '')
{
	$TxtWhere = $TxtWhere . " AND Motorista.TIPO_HAB LIKE '%" . $TxtTIPO_HAB . "%'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["TIPO_HAB"] . " = " . $TxtTIPO_HAB;
	$Argumento = $Argumento . "TxtTIPO_HAB=".$TxtTIPO_HAB . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Motorista.ID AS `ID`, Motorista.MATRICULA AS `" . $_Mascara['MATRICULA'] . "`, Motorista.GRADUACAO AS `" . $_Mascara['GRADUACAO'] . "`, Motorista.ESPECIALIDADE AS `" . $_Mascara['ESPECIALIDADE'] . "`, Motorista.NOME AS `" . $_Mascara['NOME'] . "`, Motorista.NOME_GUERRA AS `" . $_Mascara['NOME_GUERRA'] . "`, Motorista.VALIDADE_HAB AS `" . $_Mascara['VALIDADE_HAB'] . "`, Motorista.TIPO_HAB AS `" . $_Mascara['TIPO_HAB'] . "`  from  Motorista where 1=1 " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroMotorista"," Motorista ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara) 
{
	$strSQL = "SELECT MATRICULA,GRADUACAO,ESPECIALIDADE,NOME,NOME_GUERRA,F_CELULAR,F_RESIDENCIA,ENDERECO,COMPLEMENTO,VALIDADE_HAB,TIPO_HAB  from  Motorista";
	$NomeForm = "FrmCadastroMotorista";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtMATRICULA 	= VerificaInsercoesMaliciosas($_POST['TxtMATRICULA']);
		$TxtGRADUACAO 	= VerificaInsercoesMaliciosas($_POST['TxtGRADUACAO']);
		$TxtESPECIALIDADE 	= VerificaInsercoesMaliciosas($_POST['TxtESPECIALIDADE']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtNOME_GUERRA 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_GUERRA']);
		$TxtF_CELULAR 	= VerificaInsercoesMaliciosas($_POST['TxtF_CELULAR']);
		$TxtF_RESIDENCIA 	= VerificaInsercoesMaliciosas($_POST['TxtF_RESIDENCIA']);
		$TxtENDERECO 	= VerificaInsercoesMaliciosas($_POST['TxtENDERECO']);
		$TxtCOMPLEMENTO 	= VerificaInsercoesMaliciosas($_POST['TxtCOMPLEMENTO']);
		$TxtVALIDADE_HAB 	= VerificaInsercoesMaliciosas($_POST['TxtVALIDADE_HAB']);
		$TxtTIPO_HAB 	= VerificaInsercoesMaliciosas($_POST['TxtTIPO_HAB']);

		$smsecurequery = "Select * from Motorista where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Motorista(MATRICULA,GRADUACAO,ESPECIALIDADE,NOME,NOME_GUERRA,F_CELULAR,F_RESIDENCIA,ENDERECO,COMPLEMENTO,VALIDADE_HAB,TIPO_HAB)
		 VALUES
		 ('" . $TxtMATRICULA ."','" . $TxtGRADUACAO ."','" . $TxtESPECIALIDADE ."','" . $TxtNOME ."','" . $TxtNOME_GUERRA ."','" . $TxtF_CELULAR ."','" . $TxtF_RESIDENCIA ."','" . $TxtENDERECO ."','" . $TxtCOMPLEMENTO ."','" . substr($TxtVALIDADE_HAB,6,4) . "-" . substr($TxtVALIDADE_HAB,3,2) . "-" . substr($TxtVALIDADE_HAB,0,2) ."','" . $TxtTIPO_HAB ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtMATRICULA 	= VerificaInsercoesMaliciosas($_POST['TxtMATRICULA']);
		$TxtGRADUACAO 	= VerificaInsercoesMaliciosas($_POST['TxtGRADUACAO']);
		$TxtESPECIALIDADE 	= VerificaInsercoesMaliciosas($_POST['TxtESPECIALIDADE']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtNOME_GUERRA 	= VerificaInsercoesMaliciosas($_POST['TxtNOME_GUERRA']);
		$TxtF_CELULAR 	= VerificaInsercoesMaliciosas($_POST['TxtF_CELULAR']);
		$TxtF_RESIDENCIA 	= VerificaInsercoesMaliciosas($_POST['TxtF_RESIDENCIA']);
		$TxtENDERECO 	= VerificaInsercoesMaliciosas($_POST['TxtENDERECO']);
		$TxtCOMPLEMENTO 	= VerificaInsercoesMaliciosas($_POST['TxtCOMPLEMENTO']);
		$TxtVALIDADE_HAB 	= VerificaInsercoesMaliciosas($_POST['TxtVALIDADE_HAB']);
		$TxtTIPO_HAB 	= VerificaInsercoesMaliciosas($_POST['TxtTIPO_HAB']);

		$strSQL = "Update  Motorista set 
			MATRICULA			='" . $TxtMATRICULA .
			"',GRADUACAO			='" . $TxtGRADUACAO .
			"',ESPECIALIDADE			='" . $TxtESPECIALIDADE .
			"',NOME			='" . $TxtNOME .
			"',NOME_GUERRA			='" . $TxtNOME_GUERRA .
			"',F_CELULAR			='" . $TxtF_CELULAR .
			"',F_RESIDENCIA			='" . $TxtF_RESIDENCIA .
			"',ENDERECO			='" . $TxtENDERECO .
			"',COMPLEMENTO			='" . $TxtCOMPLEMENTO .
			"',VALIDADE_HAB			='" . substr($TxtVALIDADE_HAB,6,4) . "-" . substr($TxtVALIDADE_HAB,3,2) . "-" . substr($TxtVALIDADE_HAB,0,2) .
			"',TIPO_HAB			='" . $TxtTIPO_HAB ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Motorista    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroMotorista.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroMotorista.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroMotorista.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,MATRICULA,GRADUACAO,ESPECIALIDADE,NOME,NOME_GUERRA,F_CELULAR,F_RESIDENCIA,ENDERECO,COMPLEMENTO,VALIDADE_HAB,TIPO_HAB  from  Motorista  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroMotorista') ;

	echo '<script>document.FrmCadastroMotorista.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroMotorista.TxtMATRICULA.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroMotorista.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';
	
	
	echo '<form name=FrmCadastroMotorista method=post action=FrmCadastroMotorista.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Motorista';
	
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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["MATRICULA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["GRADUACAO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ESPECIALIDADE"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtMATRICULA value="" maxlength=9 size=9></td>';
	echo '<td class=white><input type=text name=TxtGRADUACAO value="" maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtESPECIALIDADE value="" maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["NOME_GUERRA"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME value="" maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtNOME_GUERRA value="" maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["F_CELULAR"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["F_RESIDENCIA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ENDERECO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["COMPLEMENTO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtF_CELULAR value="" maxlength=13 size=13></td>';
	echo '<td class=white><input type=text name=TxtF_RESIDENCIA value="" maxlength=13 size=13></td>';
	echo '<td class=white><input type=text name=TxtENDERECO value="" maxlength=50 size=30></td>';
	echo '<td class=white><input type=text name=TxtCOMPLEMENTO value="" maxlength=50 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["VALIDADE_HAB"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["TIPO_HAB"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtVALIDADE_HAB value="" maxlength=10 size=10></td>';
	echo '<td class=white><select name=TxtTIPO_HAB >';
	echo '<option value="A">A</option>';
	echo '<option value="B">B</option>';
	echo '<option value="C">C</option>';
	echo '<option value="D">D</option>';
	echo '<option value="E">E</option>';
	echo '<option value="AB">AB</option>';
	echo '<option value="AC">AC</option>';
	echo '<option value="AD">AD</option>';
	echo '<option value="AE">AE</option>';
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
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroMotorista)>';
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
	echo '<form name=FrmCadastroMotorista method=GET action=FrmCadastroMotorista.php>';
	ExibeTitulo('Pesquisa ->Motorista');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["MATRICULA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["GRADUACAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ESPECIALIDADE"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtMATRICULA maxlength=9 size=9></td>';
	echo '<td class=white><input type=text name=TxtGRADUACAO maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtESPECIALIDADE maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME_GUERRA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtNOME_GUERRA maxlength=30 size=30></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["F_CELULAR"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["F_RESIDENCIA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ENDERECO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["COMPLEMENTO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtF_CELULAR maxlength=13 size=13></td>';
	echo '<td class=white><input type=text name=TxtF_RESIDENCIA maxlength=13 size=13></td>';
	echo '<td class=white><input type=text name=TxtENDERECO maxlength=50 size=30></td>';
	echo '<td class=white><input type=text name=TxtCOMPLEMENTO maxlength=50 size=10></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["VALIDADE_HAB"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["TIPO_HAB"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtVALIDADE_HAB maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtTIPO_HAB maxlength=10 size=3></td>';
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
