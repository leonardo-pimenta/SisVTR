<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();
$fileadmin = true;
$CodigoPagina = 'FrmCadastroAdm_Usuario';
$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["NOME"] 	= "Nome";
$_Mascara["LOGIN"] 	= "Login";
$_Mascara["SENHA"] 	= "Senha";
$_Mascara["DATA_EXPIRA"] 	= "Data Expira";
$_Mascara["ANOTACOES"] 	= "Anotações";
$_Mascara["STATUS"] 	= "Status";
$_Mascara["ADMINISTRADOR"] 	= "Administrador";
$_Mascara["SETOR"] 	= "Setor";

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroAdm_Usuario';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
echo '&nbsp;';
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
		ProcessaAlteracao();
	if ($TxtTipoFormulario == 'D')
		ProcessaExclusao();
	if ($TxtTipoFormulario == 'I')
		ProcessaInclusao();
}
else
{
	if (!$TxtOpcao == '')
	{
		CriaFormulario($_Mascara);
		if ($TxtOpcao == 'A')
			EnviaAlteracao();
		if ($TxtOpcao == 'D')
			EnviaExclusao();
		if ($TxtOpcao == 'I')
			EnviaInclusao();
		sair();
	}
}

if (isset($_GET['TxtNOME']))
	$TxtNOME = VerificaInsercoesMaliciosas($_GET['TxtNOME']);
else
	$TxtNOME = '';

if (isset($_GET['TxtLOGIN']))
	$TxtLOGIN = VerificaInsercoesMaliciosas($_GET['TxtLOGIN']);
else
	$TxtLOGIN = '';

if (isset($_GET['TxtDATA_EXPIRA']))
	$TxtDATA_EXPIRA = VerificaInsercoesMaliciosas($_GET['TxtDATA_EXPIRA']);
else
	$TxtDATA_EXPIRA = '';

if (isset($_GET['TxtSTATUS']))
	$TxtSTATUS = VerificaInsercoesMaliciosas($_GET['TxtSTATUS']);
else
	$TxtSTATUS = '';

if (isset($_GET['TxtADMINISTRADOR']))
	$TxtADMINISTRADOR = VerificaInsercoesMaliciosas($_GET['TxtADMINISTRADOR']);
else
	$TxtADMINISTRADOR = '';

if (isset($_GET['TxtSETOR']))
	$TxtSETOR = VerificaInsercoesMaliciosas($_GET['TxtSETOR']);
else
	$TxtSETOR = '';

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

if ($TxtNOME <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.NOME = '" . $TxtNOME . "'";
	$MsgTxtWhere = $MsgTxtWhere . " NOME = " . $TxtNOME;
	$Argumento = $Argumento . "TxtNOME=".$TxtNOME . "&";
}

if ($TxtLOGIN <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.LOGIN = '" . $TxtLOGIN . "'";
	$MsgTxtWhere = $MsgTxtWhere . " LOGIN = " . $TxtLOGIN;
	$Argumento = $Argumento . "TxtLOGIN=".$TxtLOGIN . "&";
}

if ($TxtDATA_EXPIRA <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.DATA_EXPIRA = '" . $TxtDATA_EXPIRA . "'";
	$MsgTxtWhere = $MsgTxtWhere . " DATA_EXPIRA = " . $TxtDATA_EXPIRA;
	$Argumento = $Argumento . "TxtDATA_EXPIRA=".$TxtDATA_EXPIRA . "&";
}

if ($TxtSTATUS <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.STATUS = '" . $TxtSTATUS . "'";
	$MsgTxtWhere = $MsgTxtWhere . " STATUS = " . $TxtSTATUS;
	$Argumento = $Argumento . "TxtSTATUS=".$TxtSTATUS . "&";
}

if ($TxtADMINISTRADOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.ADMINISTRADOR = '" . $TxtADMINISTRADOR . "'";
	$MsgTxtWhere = $MsgTxtWhere . " ADMINISTRADOR = " . $TxtADMINISTRADOR;
	$Argumento = $Argumento . "TxtADMINISTRADOR=".$TxtADMINISTRADOR . "&";
}

if ($TxtSETOR <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Usuario.SETOR = '" . $TxtSETOR . "'";
	$MsgTxtWhere = $MsgTxtWhere . " SETOR = " . $TxtSETOR;
	$Argumento = $Argumento . "TxtSETOR=".$TxtSETOR . "&";
}

$smsecurequery = "Select ID AS `ID`, NOME AS `" . $_Mascara['NOME'] . "`, LOGIN AS `" . $_Mascara['LOGIN'] . "`, DATA_EXPIRA AS `" . $_Mascara['DATA_EXPIRA'] . "`, STATUS AS `" . $_Mascara['STATUS'] . "`, ADMINISTRADOR AS `" . $_Mascara['ADMINISTRADOR'] . "`, SETOR AS `" . $_Mascara['SETOR'] . "`, concat('<a href=FrmCadastroAdm_Permissao.php?TxtUSUARIO=',ID,'><img src=\"Icones/Edita.gif\" border=0></A>') AS `Permissões`  from  Adm_Usuario where 1=1 " . $TxtWhere ;

if ($_ENV['Relatorio'] == 0)
{
	$Linhas =$_SESSION['LinhasImpressora'];
	$Pagina = 1;
	$Edita = False;
}
else
{
	$Linhas =0;
	$Pagina = 0;
	$Edita = True;
}

FormularioPesquisa($_Mascara);

if ($_ENV['Relatorio'] == 0)
	ExibeDados($smsecurequery,9,"FrmCadastroAdm_Usuario"," Administrador de Usuários ",$Edita, $MsgTxtWhere,$Linhas,$Pagina);
else
	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroAdm_Usuario"," Administrador de Usuários ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas);

sair();

function Critica()
{
	$strSQL = "SELECT NOME,LOGIN,SENHA,DATA_EXPIRA,STATUS,ADMINISTRADOR,SETOR,ANOTACOES  from  Adm_Usuario";
	$NomeForm = "FrmCadastroAdm_Usuario";
	return CriticaDadosPadrao($strSQL,$NomeForm);
}
function ProcessaInclusao() {

	if (Critica()) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtLOGIN 	= VerificaInsercoesMaliciosas($_POST['TxtLOGIN']);
		$TxtSENHA 	= VerificaInsercoesMaliciosas($_POST['TxtSENHA']);
		$TxtDATA_EXPIRA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_EXPIRA']);
		$TxtSTATUS 	= VerificaInsercoesMaliciosas($_POST['TxtSTATUS']);
		$TxtADMINISTRADOR 	= VerificaInsercoesMaliciosas($_POST['TxtADMINISTRADOR']);
		$TxtSETOR 	= VerificaInsercoesMaliciosas($_POST['TxtSETOR']);
		$TxtANOTACOES 	= VerificaInsercoesMaliciosas($_POST['TxtANOTACOES']);

		$smsecurequery = "Select * from Adm_Usuario where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}
		$strSQL = "insert into Adm_Usuario(NOME,LOGIN,SENHA,DATA_EXPIRA,STATUS,ADMINISTRADOR,SETOR,ANOTACOES)
		 VALUES
		 ('" . $TxtNOME ."','" . $TxtLOGIN ."','" . $TxtSENHA ."','" . substr($TxtDATA_EXPIRA,6,4) . "-" . substr($TxtDATA_EXPIRA,3,2) . "-" . substr($TxtDATA_EXPIRA,0,2) ."','" . $TxtSTATUS ."','" . $TxtADMINISTRADOR ."','" . $TxtSETOR ."','" . $TxtANOTACOES ."')";

		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());
	}
}

function ProcessaAlteracao()
{

	if (Critica())
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtNOME 	= VerificaInsercoesMaliciosas($_POST['TxtNOME']);
		$TxtLOGIN 	= VerificaInsercoesMaliciosas($_POST['TxtLOGIN']);
		$TxtSENHA 	= VerificaInsercoesMaliciosas($_POST['TxtSENHA']);
		$TxtDATA_EXPIRA 	= VerificaInsercoesMaliciosas($_POST['TxtDATA_EXPIRA']);
		$TxtSTATUS 	= VerificaInsercoesMaliciosas($_POST['TxtSTATUS']);
		$TxtADMINISTRADOR 	= VerificaInsercoesMaliciosas($_POST['TxtADMINISTRADOR']);
		$TxtSETOR 	= VerificaInsercoesMaliciosas($_POST['TxtSETOR']);
		$TxtANOTACOES 	= VerificaInsercoesMaliciosas($_POST['TxtANOTACOES']);

		$strSQL = "Update  Adm_Usuario set
			NOME			='" . $TxtNOME .
			"',LOGIN			='" . $TxtLOGIN .
			"',SENHA			='" . $TxtSENHA .
			"',DATA_EXPIRA			='" . substr($TxtDATA_EXPIRA,6,4) . "-" . substr($TxtDATA_EXPIRA,3,2) . "-" . substr($TxtDATA_EXPIRA,0,2) .
			"',STATUS			='" . $TxtSTATUS .
			"',ADMINISTRADOR			='" . $TxtADMINISTRADOR .
			"',SETOR			='" . $TxtSETOR .
			"',ANOTACOES			='" . $TxtANOTACOES ."'  where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($strSQL);
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());
	}
	else
	{
		echo '<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>';
	}
}

function ProcessaExclusao()
{

	$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
	$strSQL = "delete from  Adm_Usuario    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroAdm_Usuario.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroAdm_Usuario.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroAdm_Usuario.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,NOME,LOGIN,SENHA,DATA_EXPIRA,STATUS,ADMINISTRADOR,SETOR,ANOTACOES  from  Adm_Usuario  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroAdm_Usuario') ;

	echo '<script>document.FrmCadastroAdm_Usuario.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroAdm_Usuario.TxtNOME.focus();</script>';
	echo '<script>document.FrmCadastroAdm_Usuario.Submit.value="Alterar"</SCRIPT>';
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroAdm_Usuario method=post action=FrmCadastroAdm_Usuario.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Formulário ->Administrador de Usuários';

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
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOGIN"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["SENHA"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtLOGIN maxlength=20 size=20></td>';
	echo '<td class=white><input type=password name=TxtSENHA maxlength=20 size=20></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA_EXPIRA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["STATUS"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ADMINISTRADOR"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["SETOR"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtDATA_EXPIRA maxlength=10 size=10></td>';
	echo '<td class=white><select name=TxtSTATUS>';
	echo '<option value="A">Ativo</option>';
	echo '<option value="I">Inativo</option>';
	echo '</select></td>';
	echo '<td class=white><select name=TxtADMINISTRADOR>';
	echo '<option value="S">Sim</option>';
	echo '<option value="N">Não</option>';
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtSETOR maxlength=20 size=20></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ANOTACOES"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><textarea name=TxtANOTACOES rows=5 cols=50></textarea></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=white>';
	if ($_GET['TxtOpcao'] == "V")
	{
		echo '<input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()>';
	}
	else
	{
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroAdm_Usuario)>';
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
	echo '<form name=FrmCadastroAdm_Usuario method=GET action=FrmCadastroAdm_Usuario.php>';
	ExibeTitulo('Pesquisa ->Administrador de Usuários');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["NOME"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["LOGIN"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtNOME maxlength=50 size=50></td>';
	echo '<td class=white><input type=text name=TxtLOGIN maxlength=20 size=20></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["DATA_EXPIRA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["STATUS"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ADMINISTRADOR"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["SETOR"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtDATA_EXPIRA maxlength=10 size=10></td>';
	echo '<td class=white><input type=text name=TxtSTATUS maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtADMINISTRADOR maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtSETOR maxlength=20 size=20></td>';
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
