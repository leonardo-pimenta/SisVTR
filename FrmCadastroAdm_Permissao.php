<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();
$fileadmin = true;
$CodigoPagina = 'FrmCadastroAdm_Permissao';
$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_USUARIO"] 	= "Usuário";
$_Mascara["CODIGO_FORMULARIO"] 	= "Formulário";
$_Mascara["INCLUSAO"] 	= "Inclusão";
$_Mascara["ALTERACAO"] 	= "Alteração";
$_Mascara["EXCLUSAO"] 	= "Exclusão";
$_Mascara["VIZUALIZACAO"] 	= "Vizualização";
$_Mascara["IMPRESSAO"] 	= "Impressão";

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroAdm_Permissao';

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
		ProcessaInclusao();
	if ($TxtTipoFormulario == 'D')
		ProcessaInclusao();
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

if (isset($_GET['TxtID_USUARIO']))
	$TxtID_USUARIO = VerificaInsercoesMaliciosas($_GET['TxtID_USUARIO']);
else
	$TxtID_USUARIO = '';

if (isset($_GET['TxtCODIGO_FORMULARIO']))
	$TxtCODIGO_FORMULARIO = VerificaInsercoesMaliciosas($_GET['TxtCODIGO_FORMULARIO']);
else
	$TxtCODIGO_FORMULARIO = '';

if (isset($_GET['TxtINCLUSAO']))
	$TxtINCLUSAO = VerificaInsercoesMaliciosas($_GET['TxtINCLUSAO']);
else
	$TxtINCLUSAO = '';

if (isset($_GET['TxtALTERACAO']))
	$TxtALTERACAO = VerificaInsercoesMaliciosas($_GET['TxtALTERACAO']);
else
	$TxtALTERACAO = '';

if (isset($_GET['TxtEXCLUSAO']))
	$TxtEXCLUSAO = VerificaInsercoesMaliciosas($_GET['TxtEXCLUSAO']);
else
	$TxtEXCLUSAO = '';

if (isset($_GET['TxtVIZUALIZACAO']))
	$TxtVIZUALIZACAO = VerificaInsercoesMaliciosas($_GET['TxtVIZUALIZACAO']);
else
	$TxtVIZUALIZACAO = '';

if (isset($_GET['TxtIMPRESSAO']))
	$TxtIMPRESSAO = VerificaInsercoesMaliciosas($_GET['TxtIMPRESSAO']);
else
	$TxtIMPRESSAO = '';

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
if (isset($_GET['TxtUSUARIO']))
	$TxtUSUARIO = VerificaInsercoesMaliciosas($_GET['TxtUSUARIO']);
else
	$TxtUSUARIO = '';

$MsgTxtWhere = '';
$TxtWhere = '';
$Argumento = '';

if ($TxtID_USUARIO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.ID_USUARIO = '" . $TxtID_USUARIO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " ID_USUARIO = " . $TxtID_USUARIO;
	$Argumento = $Argumento . "TxtID_USUARIO=".$TxtID_USUARIO . "&";
}

if ($TxtCODIGO_FORMULARIO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.CODIGO_FORMULARIO = '" . $TxtCODIGO_FORMULARIO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " CODIGO_FORMULARIO = " . $TxtCODIGO_FORMULARIO;
	$Argumento = $Argumento . "TxtCODIGO_FORMULARIO=".$TxtCODIGO_FORMULARIO . "&";
}

if ($TxtINCLUSAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.INCLUSAO = '" . $TxtINCLUSAO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " INCLUSAO = " . $TxtINCLUSAO;
	$Argumento = $Argumento . "TxtINCLUSAO=".$TxtINCLUSAO . "&";
}

if ($TxtALTERACAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.ALTERACAO = '" . $TxtALTERACAO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " ALTERACAO = " . $TxtALTERACAO;
	$Argumento = $Argumento . "TxtALTERACAO=".$TxtALTERACAO . "&";
}

if ($TxtEXCLUSAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.EXCLUSAO = '" . $TxtEXCLUSAO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " EXCLUSAO = " . $TxtEXCLUSAO;
	$Argumento = $Argumento . "TxtEXCLUSAO=".$TxtEXCLUSAO . "&";
}

if ($TxtVIZUALIZACAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.VIZUALIZACAO = '" . $TxtVIZUALIZACAO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " VIZUALIZACAO = " . $TxtVIZUALIZACAO;
	$Argumento = $Argumento . "TxtVIZUALIZACAO=".$TxtVIZUALIZACAO . "&";
}

if ($TxtIMPRESSAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Adm_Permissao.IMPRESSAO = '" . $TxtIMPRESSAO . "'";
	$MsgTxtWhere = $MsgTxtWhere . " IMPRESSAO = " . $TxtIMPRESSAO;
	$Argumento = $Argumento . "TxtIMPRESSAO=".$TxtIMPRESSAO . "&";
}

if (!$TxtUSUARIO == '')
{
	CriaFormulario($_Mascara);
	EnviaAlteracao();
	sair();
}

$smsecurequery = "Select ID AS `ID`, ID_USUARIO AS `" . $_Mascara['ID_USUARIO'] . "`, CODIGO_FORMULARIO AS `" . $_Mascara['CODIGO_FORMULARIO'] . "`, INCLUSAO AS `" . $_Mascara['INCLUSAO'] . "`, ALTERACAO AS `" . $_Mascara['ALTERACAO'] . "`, EXCLUSAO AS `" . $_Mascara['EXCLUSAO'] . "`, VIZUALIZACAO AS `" . $_Mascara['VIZUALIZACAO'] . "`, IMPRESSAO AS `" . $_Mascara['IMPRESSAO'] . "`  from  Adm_Permissao where 1=1 " . $TxtWhere ;

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
	ExibeDados($smsecurequery,9,"FrmCadastroAdm_Permissao"," Administrador de Permissões ",$Edita, $MsgTxtWhere,$Linhas,$Pagina);
else
	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroAdm_Permissao"," Administrador de Permissões ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas);

sair();

function Critica() 
{
	$strSQL = "SELECT ID_USUARIO,CODIGO_FORMULARIO,INCLUSAO,ALTERACAO,EXCLUSAO,VIZUALIZACAO,IMPRESSAO  from  Adm_Permissao";
	$NomeForm = "FrmCadastroAdm_Permissao";
	return CriticaDadosPadrao($strSQL,$NomeForm);
}
function ProcessaInclusao() {

	$TxtUSUARIO 	= VerificaInsercoesMaliciosas($_POST['TxtUSUARIO']);
	$strSQL = "delete from Adm_Permissao where ID_USUARIO='" . $_POST['TxtUSUARIO'] . "'";
	$smsecurers = mysql_query($strSQL);
 $strSQL1 = "select * from Adm_Formulario order by ID";
	$smsecurers1 = mysql_query($strSQL1);
	$columns = mysql_num_rows($smsecurers1);
	for ($i = 0; $i < $columns ; $i++)
	{
		$row = mysql_fetch_array($smsecurers1);

		$TxtNOME 	= $row['NOME'];
		$TxtINCLUSAO  	= VerificaInsercoesMaliciosas($_POST['TxtINCLUSAO' .$row['ID']]);
		$TxtALTERACAO 	= VerificaInsercoesMaliciosas($_POST['TxtALTERACAO' . $row['ID']]);
		$TxtEXCLUSAO 	= VerificaInsercoesMaliciosas($_POST['TxtEXCLUSAO' . $row['ID']]);
		$TxtVIZUALIZACAO 	= VerificaInsercoesMaliciosas($_POST['TxtVIZUALIZACAO' . $row['ID']]);
		$TxtIMPRESSAO 	= VerificaInsercoesMaliciosas($_POST['TxtIMPRESSAO' . $row['ID']]);

		$strSQL = "insert into Adm_Permissao(ID_USUARIO,CODIGO_FORMULARIO,INCLUSAO,ALTERACAO,EXCLUSAO,VIZUALIZACAO,IMPRESSAO)
		 VALUES
		 ('" . $TxtUSUARIO ."','" . $TxtNOME ."','" . $TxtINCLUSAO ."','" . $TxtALTERACAO ."','" . $TxtEXCLUSAO ."','" . $TxtVIZUALIZACAO ."','" . $TxtIMPRESSAO ."')";
		$smsecurers = mysql_query($strSQL);
	}
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());

	echo "<form action='FrmCadastroAdm_Usuario.php' method=get id=Redirecionar name=Redirecionar>";
	//echo "<input name=Codigo type=hidden value=".$TxtID.">";
	//echo "<input name=TxtOpcao type=hidden value='A'>";
	echo "<script>";
	echo "document.Redirecionar.submit()";
	echo "</script>";
	echo "</form>";
	exit;
}

function ProcessaAlteracao()
{

	$strSQL1 = "select * from Adm_Formulario order by ID";
	$smsecurers1 = mysql_query($strSQL1);
	$columns = mysql_num_rows($smsecurers1);
	for ($i = 0; $i < $columns ; $i++)
	{
		$row = mysql_fetch_array($smsecurers1);

		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_USUARIO 	= VerificaInsercoesMaliciosas($_POST['TxtUSUARIO']);
		$TxtCODIGO_FORMULARIO 	= $row['CODIGO'];
		$TxtINCLUSAO  	= VerificaInsercoesMaliciosas($_POST['TxtINCLUSAO' .$row['ID']]);
		$TxtALTERACAO 	= VerificaInsercoesMaliciosas($_POST['TxtALTERACAO' . $row['ID']]);
		$TxtEXCLUSAO 	= VerificaInsercoesMaliciosas($_POST['TxtEXCLUSAO' . $row['ID']]);
		$TxtVIZUALIZACAO 	= VerificaInsercoesMaliciosas($_POST['TxtVIZUALIZACAO' . $row['ID']]);
		$TxtIMPRESSAO 	= VerificaInsercoesMaliciosas($_POST['TxtIMPRESSAO' . $row['ID']]);

		$strSQL = "Update  Adm_Permissao set
			ID_USUARIO			='" . $TxtID_USUARIO .
			"',CODIGO_FORMULARIO			='" . $TxtCODIGO_FORMULARIO .
			"',INCLUSAO			='" . $TxtINCLUSAO .
			"',ALTERACAO			='" . $TxtALTERACAO .
			"',EXCLUSAO			='" . $TxtEXCLUSAO .
			"',VIZUALIZACAO			='" . $TxtVIZUALIZACAO .
			"',IMPRESSAO			='" . $TxtIMPRESSAO ."'  where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($strSQL);
	}
		VerificaInsercaoAlteracaoExclusaoNaBaseDados('A',@mysql_affected_rows());
}

function ProcessaExclusao()
{

	$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
	$strSQL = "delete from  Adm_Permissao    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroAdm_Permissao.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroAdm_Permissao.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroAdm_Permissao.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

//	if (isset($_GET['ID_USUARIO']))
//		$TxtID_USUARIO = VerificaInsercoesMaliciosas($_GET['USUARIO']);
//	else

	$strSQL = "select * from Adm_Formulario order by ID";
	$smsecurers = mysql_query($strSQL);
	$columns = mysql_num_rows($smsecurers);
	//echo $strSQL;
	for ($i = 0; $i < $columns ; $i++)
	{
		$row = mysql_fetch_array($smsecurers);
 		$strSQL = "SELECT ID,INCLUSAO AS 'INCLUSAO" . $row['ID'] . "',ALTERACAO AS 'ALTERACAO" . $row['ID'] . "',EXCLUSAO AS 'EXCLUSAO" . $row['ID'] . "',VIZUALIZACAO AS 'VIZUALIZACAO" . $row['ID'] . "',IMPRESSAO AS 'IMPRESSAO" . $row['ID'] . "'  from  Adm_Permissao  where ID_USUARIO = '" . $_GET['TxtUSUARIO'] . "' order by ID limit " . $i . ",1";
		//echo $strSQL . '<br>';
		SetaDadosAlteracao($strSQL,'FrmCadastroAdm_Permissao') ;
	}

	echo '<script>document.FrmCadastroAdm_Permissao.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroAdm_Permissao.TxtUSUARIO.focus();</script>';
	echo '<script>document.FrmCadastroAdm_Permissao.Submit.value="Alterar"</SCRIPT>';
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroAdm_Permissao method=post action=FrmCadastroAdm_Permissao.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Formulário ->Administrador de Permissões';

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

		$strSQL = "select * from Adm_Formulario order by DESCRICAO";
		$smsecurers = mysql_query($strSQL);
		$columns = mysql_num_rows($smsecurers);
		//echo $strSQL;
		echo '<table width=780 align=center><tr>';
		if (isset($_GET["TxtUSUARIO"]))
			echo '<input type=hidden name=TxtUSUARIO value="' . $_GET['TxtUSUARIO'] . '">';
		else
			echo '<input type=hidden name=TxtUSUARIO>';

		echo '<td class=white height=25>' . $_Mascara["CODIGO_FORMULARIO"] . '</td>';
		echo '<td class=white height=25>' . $_Mascara["INCLUSAO"] . '</td>';
		echo '<td class=white height=25>' . $_Mascara["ALTERACAO"] . '</td>';
		echo '<td class=white height=25>' . $_Mascara["EXCLUSAO"] . '</td>';
		echo '<td class=white height=25>' . $_Mascara["VIZUALIZACAO"] . '</td>';
		echo '<td class=white height=25>' . $_Mascara["IMPRESSAO"] . '</td>';
		echo '</tr>';
		echo "<input type=hidden name=TxtID>";
		for ($i = 0; $i < $columns ; $i++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo '<tr>';
			echo '<td class=ColorFormulario height=25>' . $row["DESCRICAO"] . '</td>';
			echo '<td class=white height=25><select name=TxtINCLUSAO' . $row["ID"] . '>';
				echo '<option value="N">Não</option>';
				echo '<option value="S">Sim</option>';
			echo '</select></td>';
			echo '<td class=white height=25><select name=TxtALTERACAO' . $row["ID"] . '>';
				echo '<option value="N">Não</option>';
				echo '<option value="S">Sim</option>';
			echo '</select></td>';
			echo '<td class=white height=25><select name=TxtEXCLUSAO' . $row["ID"] . '>';
				echo '<option value="N">Não</option>';
				echo '<option value="S">Sim</option>';
			echo '</select></td>';
			echo '<td class=white height=25><select name=TxtVIZUALIZACAO' . $row["ID"] . '>';
				echo '<option value="N">Não</option>';
				echo '<option value="S">Sim</option>';
			echo '</select></td>';
			echo '<td class=white height=25><select name=TxtIMPRESSAO' . $row["ID"] . '>';
				echo '<option value="N">Não</option>';
				echo '<option value="S">Sim</option>';
			echo '</select></td>';
			echo '</tr>';
		}
		echo '</table><table width=780 align=center>';
		echo '<tr>';
		echo '<td class=white align=right>';
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroAdm_Permissao)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:Cancelar()>';
		echo '</td></tr></table>';
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
	echo "<form action='FrmCadastroAdm_Usuario.php' method=get id=Redirecionar name=Redirecionar>";
	//echo "<input name=Codigo type=hidden value=".$TxtID.">";
	//echo "<input name=TxtOpcao type=hidden value='A'>";
	echo "<script>";
	echo "document.Redirecionar.submit()";
	echo "</script>";
	echo "</form>";

	echo '<form name=FrmCadastroAdm_Permissao method=GET action=FrmCadastroAdm_Permissao.php>';
	ExibeTitulo('Pesquisa ->Administrador de Permissões');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_USUARIO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["CODIGO_FORMULARIO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["INCLUSAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ALTERACAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["EXCLUSAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["VIZUALIZACAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["IMPRESSAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_USUARIO>';
	$strSQL = 'select * from Adm_Usuario';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtCODIGO_FORMULARIO>';
	$strSQL = 'select * from Adm_Formulario';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['NOME'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtINCLUSAO maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtALTERACAO maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtEXCLUSAO maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtVIZUALIZACAO maxlength=1 size=1></td>';
	echo '<td class=white><input type=text name=TxtIMPRESSAO maxlength=1 size=1></td>';
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
