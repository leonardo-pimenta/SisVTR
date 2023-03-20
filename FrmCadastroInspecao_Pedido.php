<?php
// JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// GERADOR DE FORMULARIO - Adaptado Por MICROINFO PROCESSAMENTO DE DADOS LTDA - 12-08-2004
// todos os direitos reservados a JGBAIAO@YAHOO.COM & MINFO@ENDCASE.COM.BR
session_start();

$_Mascara 	= array();
$_Mascara["ID"] 	= "";
$_Mascara["ID_SERVICO"] 	= "Nº do Pedido";
$_Mascara["ID_VIATURA"] 	= "Viatura";
$_Mascara["TIPO_INSPECAO"] 	= "Tipo";
$_Mascara["ID_INSPECAO"] 	= "Ítem de Inspecao";
$_Mascara["ID_RESULTADO"] 	= "Resultado";

$CodigoPagina = 'FrmCadastroInspecao_Pedido';

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmCadastroInspecao_Pedido';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

echo '<table ALIGN=right border=0 cellpadding=0 cellspacing=0  width=200>';
echo '<tr>';
echo '<td class=Branco align="right" >';
if ($_GET['TxtOpcao'] == '' and $_GET['Pesquisa'] == '')
{
	echo '<a href=FrmCadastroInspecao_Pedido.php?Pesquisa=S>Pesquisar</A>';
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

if (isset($_GET['TxtID_SERVICO']))
	$TxtID_SERVICO = VerificaInsercoesMaliciosas($_GET['TxtID_SERVICO']);
else
	$TxtID_SERVICO = '';

if (isset($_GET['TxtID_VIATURA']))
	$TxtID_VIATURA = VerificaInsercoesMaliciosas($_GET['TxtID_VIATURA']);
else
	$TxtID_VIATURA = '';

if (isset($_GET['TxtTIPO_INSPECAO']))
	$TxtTIPO_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtTIPO_INSPECAO']);
else
	$TxtTIPO_INSPECAO = '';

if (isset($_GET['TxtID_INSPECAO']))
	$TxtID_INSPECAO = VerificaInsercoesMaliciosas($_GET['TxtID_INSPECAO']);
else
	$TxtID_INSPECAO = '';

if (isset($_GET['TxtID_RESULTADO']))
	$TxtID_RESULTADO = VerificaInsercoesMaliciosas($_GET['TxtID_RESULTADO']);
else
	$TxtID_RESULTADO = '';

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

if ($TxtID_SERVICO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Pedido.ID_SERVICO = '" . $TxtID_SERVICO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_SERVICO"] . " = " . $TxtID_SERVICO;
	$Argumento = $Argumento . "TxtID_SERVICO=".$TxtID_SERVICO . "&";
}

if ($TxtID_VIATURA <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Pedido.ID_VIATURA = '" . $TxtID_VIATURA . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_VIATURA"] . " = " . $TxtID_VIATURA;
	$Argumento = $Argumento . "TxtID_VIATURA=".$TxtID_VIATURA . "&";
}

if ($TxtTIPO_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Pedido.TIPO_INSPECAO = '" . $TxtTIPO_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["TIPO_INSPECAO"] . " = " . $TxtTIPO_INSPECAO;
	$Argumento = $Argumento . "TxtTIPO_INSPECAO=".$TxtTIPO_INSPECAO . "&";
}

if ($TxtID_INSPECAO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Pedido.ID_INSPECAO = '" . $TxtID_INSPECAO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_INSPECAO"] . " = " . $TxtID_INSPECAO;
	$Argumento = $Argumento . "TxtID_INSPECAO=".$TxtID_INSPECAO . "&";
}

if ($TxtID_RESULTADO <> '')
{
	$TxtWhere = $TxtWhere . " AND Inspecao_Pedido.ID_RESULTADO = '" . $TxtID_RESULTADO . "'";
	$MsgTxtWhere = $MsgTxtWhere .  $_Mascara["ID_RESULTADO"] . " = " . $TxtID_RESULTADO;
	$Argumento = $Argumento . "TxtID_RESULTADO=".$TxtID_RESULTADO . "&";
}

if ($TxtLinhas <> '')
{
	$Argumento = $Argumento . 'TxtLinhas='.$TxtLinhas . '&';
}
$smsecurequery = "Select Inspecao_Pedido.ID AS `ID`, Inspecao_Pedido.ID_SERVICO AS `" . $_Mascara['ID_SERVICO'] . "`, Viatura.CODIGO_VIATURA AS `" . $_Mascara['ID_VIATURA'] . "`, Inspecao_Pedido.TIPO_INSPECAO AS `" . $_Mascara['TIPO_INSPECAO'] . "`, Itens_Inspecao.DESCRICAO AS `" . $_Mascara['ID_INSPECAO'] . "`, Resultado.DESCRICAO AS `" . $_Mascara['ID_RESULTADO'] . "`  from  Inspecao_Pedido,Viatura,Itens_Inspecao,Resultado where 1=1 AND Inspecao_Pedido.ID_VIATURA = Viatura.ID AND Inspecao_Pedido.ID_INSPECAO = Itens_Inspecao.ID AND Inspecao_Pedido.ID_RESULTADO = Resultado.ID " . $TxtWhere ;

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

	ExibeDados_Quebrando($smsecurequery,9,"FrmCadastroInspecao_Pedido"," Inspeção de Viaturas ",$CodigoPagina, $MsgTxtWhere,$Linhas,$Pagina,$Limite,$Argumento,$TotalGeral,$Totalizador,$TxtLinhas,$CodigoPagina);
sair();

function Critica($_Mascara)
{
	$strSQL = "SELECT ID_SERVICO,ID_VIATURA  from  Inspecao_Pedido";
	$NomeForm = "FrmCadastroInspecao_Pedido";
	if(!CriticaDadosPadrao($strSQL,$NomeForm,$_Mascara))
		return false;

	return true;
}
function ProcessaInclusao($_Mascara) {

	if (Critica($_Mascara)) {
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_SERVICO 	= VerificaInsercoesMaliciosas($_POST['TxtID_SERVICO']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtTIPO_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtTIPO_INSPECAO']);
		//$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
		//$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO']);

		$smsecurequery = "Select * from Inspecao_Pedido where ID = '" . $TxtID . "'";
		$smsecurers = mysql_query($smsecurequery);
		if (@mysql_affected_rows()>0)
		{
			echo "<center>Já existe esse registro cadastrado na base!</center>";
			echo "<center><input type=button name=Submit2 value=Voltar onclick=javascript:window.history.go(-1)></center>";
			sair();;
		}


		$strSQL1 = "select DESCRICAO,Itens_Inspecao.ID from Itens_Inspecao,Viatura_Inspecao,Pedido where Itens_Inspecao.ID=Viatura_Inspecao.ID_ITEM_INSPECAO and Pedido.ID_VIATURA=Viatura_Inspecao.ID_VIATURA and Pedido.ID='" .$TxtID_SERVICO . "'";
				$smsecurers1 = mysql_query($strSQL1);
				$n=@mysql_affected_rows();
				for ($g = 1; $g <= $n; $g++)
				{
					$row = mysql_fetch_array($smsecurers1);
					$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO' . $g . '']);
					$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO' . $g . '']);
					$strSQL = "insert into Inspecao_Pedido(ID_SERVICO,ID_VIATURA,TIPO_INSPECAO,ID_INSPECAO,ID_RESULTADO)
							 VALUES
		 					('" . $TxtID_SERVICO ."','" . $TxtID_VIATURA ."','" . $TxtTIPO_INSPECAO ."','" . $TxtID_INSPECAO ."','" . $TxtID_RESULTADO ."')";

					$smsecurers = mysql_query($strSQL);
					//echo $strSQL;
				}




		VerificaInsercaoAlteracaoExclusaoNaBaseDados('I',@mysql_affected_rows());

		//EMISSÃO DO BDT!

					require("Lib/MinfoRelatorio.php");
					include("Lib/MinfoMsg.php");


					$strSQLBDT =  "Select * from Pedido where ID = '" . $TxtID_SERVICO . "'";
						$smsecurersBDT = mysql_query($strSQLBDT);
						for ($t = 1; $t <= @mysql_affected_rows(); $t++)
						{
							$rowBDT = mysql_fetch_array($smsecurersBDT);
							if(($rowBDT['DT_REGRES']=='0000-00-00')&&($rowBDT['H_REGRES']=='00:00:00'))
							{

													?><script>alert("aki!!!");</script><?
													//inseri paradar um reload na pagina após a execução desta função...
													 	echo "<form action=FrmCadastroPedido.php method=get id=Redirecionar name=Redirecionar>";
											  		 	//echo "<input name=TxtOpcao type=hidden value='A'>";
											 		 	//echo "<input name=Codigo type=hidden value='" . $row["ID"] . "'>";
											  		 	echo "<script>";
											  		 	echo "document.Redirecionar.submit()";
		  		 										echo "</script>";


			  	  			}
			  	  			else
			  	  			{
			  	  				$ARQUIVO_TEMPORARIO='../Arquivos/RelatorioBI'.date("dmY")."-".rand(1,1000).".rtf";
								$MASCARA_RELATORIO='relatorios/RelatorioBI.rel';

								$ag1= new aguarde("Por favor, aguarde;<BR>Emitindo BI...<BR>");;
								$ag1->abre();    /* Mensagem de "Aguarde..." */

								$smsecurequery = "Select ID_SERVICO as `npedido`,if(TIPO_INSPECAO='Saida',Itens_Inspecao.DESCRICAO,'ERRO') as `ITEM_SAIDA`,if(TIPO_INSPECAO='Saida',Resultado.DESCRICAO,'ERRO') as `RESULTADO_SAIDA` from Inspecao_Pedido,Itens_Inspecao,Resultado where Itens_Inspecao.ID=Inspecao_Pedido.ID_INSPECAO and Resultado.ID=Inspecao_Pedido.ID_RESULTADO and ID_SERVICO='$TxtID_SERVICO'";
								echo $smsecurequery;
			  	  				//exit;
			  	  			}
			  	  		}

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
			   		// echo "<BR><center><b>Aguarde Emitindo BI...</b></center>";
			    		flush();
			    		$VARIAVEIS["QUERY1"]        = $smsecurequery;

			    		$VARIAVEIS["TxtTITULO"]     = "bdt- Boletim de Inspeção";
				//      $VARIAVEIS["TxtTITULO"]     = "R05 - PROCESSOS POR TIPO DE AÇÃO";
			 	        $VARIAVEIS["TxtFiltro"]     = $MsgTxtWhere;
			    		$VARIAVEIS["DATA_HORA"]     = date('d/m/Y - H:i:s');
			    		$VARIAVEIS["USUARIO"]       = $_SESSION["LOGIN"];
						$VARIAVEIS["npedido"]       = $TxtID_SERVICO;
			    		if(PreRelat($VARIAVEIS,$MASCARA_RELATORIO,$ARQUIVO_TEMPORARIO))
			    		{
			       			 echo "<BR><BR><B>Houveram erros na geração do BDT. Favor contactar o administrador do sistema.</B>";
			        		$ag1->fecha();
			        		@unlink($ArquivoGravadoX);
			        		exit;
			    		}
			    		$ag1->fecha();   /* Fecha janela de "Aguarde" */
			    		//RtfToPdf($ARQUIVO_TEMPORARIO);
			echo "<script>window.open('" . $ARQUIVO_TEMPORARIO . "');</script>";





					//inseri paradar um reload na pagina após a execução desta função...
				 	echo "<form action=FrmCadastroPedido.php method=get id=Redirecionar name=Redirecionar>";
		  		 	//echo "<input name=TxtOpcao type=hidden value='A'>";
		 		 	//echo "<input name=Codigo type=hidden value='" . $row["ID"] . "'>";
		  		 	echo "<script>";
		  		 	echo "document.Redirecionar.submit()";
		  		 	echo "</script>";


	}
}

function ProcessaAlteracao($_Mascara)
{

	if (Critica($_Mascara))
	{
		$TxtID 	= VerificaInsercoesMaliciosas($_POST['TxtID']);
		$TxtID_SERVICO 	= VerificaInsercoesMaliciosas($_POST['TxtID_SERVICO']);
		$TxtID_VIATURA 	= VerificaInsercoesMaliciosas($_POST['TxtID_VIATURA']);
		$TxtTIPO_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtTIPO_INSPECAO']);
		$TxtID_INSPECAO 	= VerificaInsercoesMaliciosas($_POST['TxtID_INSPECAO']);
		$TxtID_RESULTADO 	= VerificaInsercoesMaliciosas($_POST['TxtID_RESULTADO']);

		$strSQL = "Update  Inspecao_Pedido set
			ID_SERVICO			='" . $TxtID_SERVICO .
			"',ID_VIATURA			='" . $TxtID_VIATURA .
			"',TIPO_INSPECAO			='" . $TxtTIPO_INSPECAO .
			"',ID_INSPECAO			='" . $TxtID_INSPECAO .
			"',ID_RESULTADO			='" . $TxtID_RESULTADO ."'  where ID = '" . $TxtID . "'";
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
	$strSQL = "delete from  Inspecao_Pedido    where ID = '" . $TxtID . "'";
	$smsecurers = mysql_query($strSQL);
	VerificaInsercaoAlteracaoExclusaoNaBaseDados('E',@mysql_affected_rows());
}

function EnviaExclusao()
{
	EnviaAlteracao();
	echo '<script>document.FrmCadastroInspecao_Pedido.TxtTipoFormulario.value="D"</SCRIPT>';
	echo '<script>document.FrmCadastroInspecao_Pedido.Submit.value="Excluir"</SCRIPT>';
}
function EnviaInclusao()
{
		echo '<script>document.FrmCadastroInspecao_Pedido.TxtTipoFormulario.value="I"</SCRIPT>';
}
function EnviaAlteracao()
{
	if (isset($_GET['Codigo']))
		$TxtID = VerificaInsercoesMaliciosas($_GET['Codigo']);
	else
		$TxtID = '';

	$strSQL = "SELECT ID,ID_SERVICO,ID_VIATURA,TIPO_INSPECAO,ID_INSPECAO,ID_RESULTADO  from  Inspecao_Pedido  where ID = '" . $TxtID . "'";
	SetaDadosAlteracao($strSQL,'FrmCadastroInspecao_Pedido') ;

	echo '<script>document.FrmCadastroInspecao_Pedido.TxtTipoFormulario.value="A"</SCRIPT>';
	echo '<script>document.FrmCadastroInspecao_Pedido.TxtID_SERVICO.focus();</script>';
	if (!$_GET['TxtOpcao'] == 'V')
	{
		echo '<script>document.FrmCadastroInspecao_Pedido.Submit.value="Alterar"</SCRIPT>';
	}
}

function CriaFormulario($_Mascara)
{

	if (isset($_GET['TxtOpcao']))
		$TxtOpcao = VerificaInsercoesMaliciosas($_GET['TxtOpcao']);
	else
		$TxtOpcao = '';


	echo '<form name=FrmCadastroInspecao_Pedido method=post action=FrmCadastroInspecao_Pedido.php><input type=hidden name=TxtID value=0><input type=hidden name=TxtTipoFormulario>';
	$Titulo = 'Inspeção de Viaturas';

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
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_SERVICO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_VIATURA"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["TIPO_INSPECAO"] . '</b></font></td>';
	echo '</tr>';
	echo '<tr>';

	echo '<td class=white><select name=TxtID_SERVICO>';
		$strSQL = "select * from Pedido where ID='" .VerificaInsercoesMaliciosas($_GET['npedido']) . "'";
		$smsecurers = mysql_query($strSQL);
		for ($t = 1; $t <= @mysql_affected_rows(); $t++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo '<option value='. $row['ID'] . '>' .  $row['ID'] . '</option>';
		}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = "select Viatura.ID,CODIGO_VIATURA,ID_VIATURA from Pedido,Viatura where Pedido.ID_VIATURA=Viatura.ID and Pedido.ID='" .VerificaInsercoesMaliciosas($_GET['npedido']) . "'";

	$smsecurers = mysql_query($strSQL);
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';

	echo '<td class=white height=32><select name=TxtTIPO_INSPECAO>';
	$strSQL = "select * from Inspecao_Pedido where ID_SERVICO='" .VerificaInsercoesMaliciosas($_GET['npedido']) . "'";

		$smsecurers = mysql_query($strSQL);
		if(@mysql_affected_rows()>0)
		{
			echo "<option value='Regresso'>Regresso</option>";
		}
		else
		{
			echo "<option value='Saida'>Saida</option>";
		}


	echo '</select></td>';

	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];

	echo '<tr class=white>';
	echo '<td class=ColorFormulario><font color=000000><b>' . $_Mascara["ID_INSPECAO"] . '</b></font></td>';
	echo '<td class=ColorFormulario><font color=000000><b>Resultado</b></font></td>';
	echo '</tr>';

	echo "<tr class=white>";

		$strSQL = "select DESCRICAO,Itens_Inspecao.ID from Itens_Inspecao,Viatura_Inspecao,Pedido where Itens_Inspecao.ID=Viatura_Inspecao.ID_ITEM_INSPECAO and Pedido.ID_VIATURA=Viatura_Inspecao.ID_VIATURA and Pedido.ID='" .VerificaInsercoesMaliciosas($_GET['npedido']) . "'";
		$smsecurers = mysql_query($strSQL);
		$n=@mysql_affected_rows();
		for ($g = 1; $g <= $n; $g++)
		{
			$row = mysql_fetch_array($smsecurers);
			echo "<tr class=white>";

				echo "<td class=white><b> " . $row['DESCRICAO'] . "</b> <input type=hidden name=TxtID_INSPECAO" . $g . " value='" . $row['ID'] . "' maxlength=2 size=2></td>";
				echo "<td class=white height=32><select name=TxtID_RESULTADO" . $g . ">";
					$strSQL1 = "select Resultado.ID,Resultado.DESCRICAO from Resultado,Itens_Resultados,Itens_Inspecao,Pedido where Itens_Inspecao.ID=Itens_Resultados.ID_ITENS_INSPECAO and Resultado.ID=Itens_Resultados.ID_RESULTADO and Itens_Inspecao.ID='" . $row['ID'] . "' group by Resultado.DESCRICAO";
					$smsecurers1 = mysql_query($strSQL1);
					$n1=@mysql_affected_rows();
					for ($r = 1; $r <= $n1; $r++)
					{
						$row1 = mysql_fetch_array($smsecurers1);
						echo '<option value='. $row1['ID'] . '>' .  $row1['DESCRICAO'] . '</option>';
					}
				echo '</select>';
				//echo '<input type="image" border="0" name="imageField" src="images/fundotd.JPG" width="49" height="12"></td>';

			echo '</tr>';

		}

	echo '</tr>';

	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo "<tr>";
	echo '<td class=white>';
	if ($_GET['TxtOpcao'] == 'V')
	{
		echo '<input type=button name=Submit2 value=Voltar onclick=javascript:Cancelar()>';
	}
	else
	{
		echo '<input type=button name=Submit value=Enviar onClick=javascript:ConfirmaFormulario(FrmCadastroInspecao_Pedido)>';
		echo '<input type=button name=Submit2 value=Cancelar onclick=javascript:window.history.go(-2)>';
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
	echo '<form name=FrmCadastroInspecao_Pedido method=GET action=FrmCadastroInspecao_Pedido.php>';
	ExibeTitulo('Pesquisa ->Inspeção de Viaturas');
	echo '<td align=right width=90%><font face=verdana size=-2>';
	echo '</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=780 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>';
	echo '<tr>';
	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_SERVICO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_VIATURA"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["TIPO_INSPECAO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><input type=text name=TxtID_SERVICO maxlength=11 size=11></td>';
	echo '<td class=white><select name=TxtID_VIATURA>';
	$strSQL = 'select * from Viatura';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['CODIGO_VIATURA'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><input type=text name=TxtTIPO_INSPECAO maxlength=2 size=2></td>';
	echo '</tr>';
	echo $_SESSION['FechaMoldura'];

	echo $_SESSION['AbreMoldura'];
	echo '<tr>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_INSPECAO"] . '</b></td>';
	echo '<td class=ColorFormulario><b>' . $_Mascara["ID_RESULTADO"] . '</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class=white><select name=TxtID_INSPECAO>';
	$strSQL = 'select * from Itens_Inspecao';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
		echo '<option value='. $row['ID'] . '>' .  $row['DESCRICAO'] . '</option>';
	}
	echo '</select></td>';
	echo '<td class=white><select name=TxtID_RESULTADO>';
	$strSQL = 'select * from Resultado';
	$smsecurers = mysql_query($strSQL);
	echo '<option></option>';
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
