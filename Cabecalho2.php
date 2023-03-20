

		<script type="text/javascript">

		webfxMenuImagePath	= "Icones/";

		WebFXMenu.prototype.borderWidth		= 4;
		WebFXMenu.prototype.paddingWidth	= 2;
		WebFXMenu.prototype.borderTop		= 2;
		WebFXMenu.prototype.paddingTop		= 1;


<?      $strSQL = 'select * from Menu ORDER BY POSICAO_MENU ';
	$smsecurers = mysql_query($strSQL);
	//echo $strSQL;
        $contador=@mysql_affected_rows();
	for ($s = 1; $s <= $contador; $s++)
	{
		$row = mysql_fetch_array($smsecurers);
?>	

	
		var Menu<?echo $row['MENU_APONTA'];?> = new WebFXMenu;
<?
		$strSQL1 = "select * from SubMenu where ID_MENU='" . $row['ID'] . "'";
		//echo $strSQL1;
		$smsecurers1 = mysql_query($strSQL1);
		for ($u = 1; $u <= @mysql_affected_rows(); $u++)
		{
			$row1 = mysql_fetch_array($smsecurers1);
?>			Menu<?echo $row['NOME_MENU'];?>.add(new WebFXMenuItem("<?echo $row1['NOME'];?>","<?echo $row1['ARQUIVO'];?>"));
<?
        	}
		
?>		
		//Ajustes p/ 800 X 600
		if (screen.height<="600") 
		{
			Menu<?echo $row['MENU_APONTA'];?>.left  = <?echo $row['POSICAO_800X600'];?>;
			Menu<?echo $row['MENU_APONTA'];?>.top   = <?echo $row['ALTURA_CAIXA'];?>;
			Menu<?echo $row['MENU_APONTA'];?>.width = <?echo $row['LARGURA_CAIXA'];?>;
		}
		else
		{	

			Menu<?echo $row['MENU_APONTA'];?>.left  = <?echo $row['POSICAO_1024X768'];?>;
			Menu<?echo $row['MENU_APONTA'];?>.top   = <?echo $row['ALTURA_CAIXA'];?>;
			Menu<?echo $row['MENU_APONTA'];?>.width = <?echo $row['LARGURA_CAIXA'];?>;
		}


<?
	}
?>

	var myBar = new WebFXMenuBar;<?
	$strSQL = 'select * from Menu ORDER BY POSICAO_MENU ';
	$smsecurers = mysql_query($strSQL);
	//echo $strSQL;
	for ($t = 1; $t <= @mysql_affected_rows(); $t++)
	{
		$row = mysql_fetch_array($smsecurers);
?>

		

		myBar.add(new WebFXMenuButton("<?echo $row['NOME_MENU'];?>", null, "<?echo $row['DESCRICAO_MENU'];?>", Menu<?echo $row['MENU_APONTA'];?>));
<?
	}
?>	
	//MenuPedido.add(new WebFXMenuItem("Pedidos","FrmCadastroPedido.php"));
	//MenuPedido.add(new WebFXMenuItem("Inspeção","FrmCadastroInspecao.php"));
	//MenuPedido.add(new WebFXMenuItem("Relatórios","FrmRelatoriosPedido.php"));
	//MenuPedido.add(new WebFXMenuSeparator());
	//MenuPedido.add(new WebFXMenuItem("OM","FrmCadastroOm.php"));
	//MenuPedido.add(new WebFXMenuItem("Despachante","FrmCadastroDespachante.php"));
	//MenuPedido.add(new WebFXMenuItem("Motorista","FrmCadastroMotorista.php"));
	//MenuPedido.add(new WebFXMenuItem("Programador","FrmCadastroProgramador.php"));
	//MenuPedido.add(new WebFXMenuItem("Tipo Pedido","FrmCadastroTipo.php"));
	//MenuPedido.add(new WebFXMenuItem("Avaliação","FrmCadastroAvaliacao.php"));
	//MenuPedido.add(new WebFXMenuSeparator());
	//MenuPedido.add(new WebFXMenuItem("Inspeção de Ítens","FrmCadastroInspecao_Itens.php"));
	//MenuPedido.add(new WebFXMenuItem("Ïtens de Inspeção","FrmCadastroItens_Inspecao.php"));
	//MenuPedido.add(new WebFXMenuItem("Resultados","FrmCadastroResultado.php"));
	
	
	//var MenuReparos = new WebFXMenu;
	//MenuReparos.add(new WebFXMenuItem("Reparos","FrmCadastroReparo.php"));
	//MenuReparos.add(new WebFXMenuItem("Relatórios","FrmRelatoriosReparo.php"));
	//MenuReparos.add(new WebFXMenuSeparator());
	//MenuReparos.add(new WebFXMenuItem("Tipo de Reparo","FrmCadastroTipo_Reparo.php"));
	//MenuReparos.add(new WebFXMenuItem("Motivo do Reparo","FrmCadastroMotivo_Reparo.php"));
	//MenuReparos.add(new WebFXMenuItem("Reparador","FrmCadastroReparador.php"));

	

	
	//var MenuAbastecimento = new WebFXMenu;
	//MenuAbastecimento.add(new WebFXMenuItem("Abastecimento","FrmCadastroAbastecimento.php"));
	//MenuAbastecimento.add(new WebFXMenuItem("Relatórios","FrmRelatoriosAbastecimento.php"));
	//MenuAbastecimento.add(new WebFXMenuSeparator());
	//MenuAbastecimento.add(new WebFXMenuItem("Local do Abastecimento","FrmCadastroLocal_Abastc.php"));
	
	

	//var MenuPecas = new WebFXMenu;
	//MenuPecas.add(new WebFXMenuItem("Controle de Peças","FrmCadastroControle_Pecas.php"));
	//MenuPecas.add(new WebFXMenuItem("Relatórios","FrmRelatoriosPecas.php"));
	//MenuPecas.add(new WebFXMenuSeparator());
	//MenuPecas.add(new WebFXMenuItem("Peças","FrmCadastroPecas.php"));
	//MenuPecas.add(new WebFXMenuItem("Peças Controle","FrmCadastroPecas_Controle.php"));
	//MenuPecas.add(new WebFXMenuItem("Situação das Peças","FrmCadastroSituacao.php"));	
	
	


	//var MenuOcorrencias = new WebFXMenu;
	//MenuOcorrencias.add(new WebFXMenuItem("Ocorrencias","FrmCadastroAcidentes.php"));
	//MenuOcorrencias.add(new WebFXMenuItem("Relatórios","FrmRelatoriosAcidentes.php"));
	//MenuOcorrencias.add(new WebFXMenuSeparator());
	//MenuOcorrencias.add(new WebFXMenuItem("Tipo de Acidente","FrmCadastroTipo_Acidente.php"));

	




	//var MenuAdministracao = new WebFXMenu;
	//MenuAdministracao.add(new WebFXMenuItem("Formulários","FrmCadastroAdm_Formulario.php"));
	//MenuAdministracao.add(new WebFXMenuItem("Usuários","FrmCadastroAdm_Usuario.php"));
	//MenuAdministracao.add(new WebFXMenuSeparator());
	//MenuAdministracao.add(new WebFXMenuItem("Viaturas","FrmCadastroViatura.php"));
	//MenuAdministracao.add(new WebFXMenuItem("Marca","FrmCadastroMarca.php"));
	//MenuAdministracao.add(new WebFXMenuItem("Modelo","FrmCadastroModelo.php"));
	//MenuAdministracao.add(new WebFXMenuItem("Situação","FrmCadastroSituacao.php"));
	//MenuAdministracao.add(new WebFXMenuItem("Encarregado","FrmCadastroEncarregado.php"));
	//MenuAdministracao.add(new WebFXMenuSeparator());
	//MenuAdministracao.add(new WebFXMenuItem("Backup","FrmBackup.php"));
	//MenuAdministracao.add(new WebFXMenuSeparator());
	//MenuAdministracao.add(new WebFXMenuItem("Consulta Log",""));
	
	

	

	//var myBar = new WebFXMenuBar;

	//myBar.add(new WebFXMenuButton("Pedido", null, "Pedido", MenuPedido));
	//myBar.add(new WebFXMenuButton("Reparos", null, "Reparos", MenuReparos));
	//myBar.add(new WebFXMenuButton("Abastecimento", null, "Abastecimento", MenuAbastecimento));
	//myBar.add(new WebFXMenuButton("Peças", null, "Pecas", MenuPecas));
	//myBar.add(new WebFXMenuButton("Ocorrências", null, "Ocorrencias", MenuOcorrencias));
	//myBar.add(new WebFXMenuButton("Administração", null, "Administração", MenuAdministracao));
	//myBar.add(new WebFXMenuButton("Sobre", "sobre.php" , "Sobre", null));
	//myBar.add(new WebFXMenuButton("Logout", "login.php?action=logout" , "Logout do Sistema - Clique aqui para sair do sistema", null));
	

        //Ajustes p/ 800 X 600
	//if (screen.height<="600") 
	//{
	//	MenuPedido.left  = 5;
	//	MenuPedido.top   = 85;
	//	MenuPedido.width = 180;


	//	MenuReparos.left  = 65;
	//	MenuReparos.top   = 85;
	//	MenuReparos.width = 350;

	//	MenuAbastecimento.left  = 140;
	//	MenuAbastecimento.top   = 85;
	//	MenuAbastecimento.width = 200;

	//	MenuPecas.left  = 245;
	//	MenuPecas.top   = 85;
	//	MenuPecas.width = 200;

	//	MenuOcorrencias.left  = 305;
	//	MenuOcorrencias.top   = 85;
	//	MenuOcorrencias.width = 200;

	//	MenuAdministracao.left  = 395;
	//	MenuAdministracao.top   = 85;
	//	MenuAdministracao.width = 180;
	//}
	// Ajustes p/ 1024 X 768
	//else
	//{

		//MenuPedido.left  = 175;
		//MenuPedido.top   = 85;
		//MenuPedido.width = 180;

		//MenuReparos.left  = 245;
		//MenuReparos.top   = 85;
		//MenuReparos.width = 350;

//		MenuAbastecimento.left  = 320;
//		MenuAbastecimento.top   = 85;
//		MenuAbastecimento.width = 200;

//		MenuPecas.left  = 435;
	//	MenuPecas.top   = 85;
		//MenuPecas.width = 200;//

//		MenuOcorrencias.left  = 495;
	//	MenuOcorrencias.top   = 85;
		//MenuOcorrencias.width = 200;

	//	MenuAdministracao.left  = 590;
	//	MenuAdministracao.top   = 85;
	//	MenuAdministracao.width = 180;
//}



	
	

	



	document.write(myBar);
</script>

<div class="menuBottom"></div>
<?php
if ($_ENV['Relatorio']<>0)
{
?>

<!--
<?php

if ($NomeFormulario == "FrmCadastroTab_Protocolo")
{

          if ($_SESSION['NSetorProtocolo']=="1")
	{
		echo '<table ALIGN=CENTER border=0 cellpadding=0 cellspacing=0  width=775>';
		echo '<tr><td class=Branco align="right" >';
		echo '<a href=default.php>Voltar</A></td></tr></table>';
	}

}
else
{
          if ($NomeFormulario <> "FrmCadastroBase" && $NomeFormulario <> "FrmReajuste" && $NomeFormulario <> "FrmConsultaProtocolo" && $NomeFormulario <> "INDIFERENTE" && $_ENV['Relatorio'] <> 0 && $_SESSION['accesslevel'] <= 2)
          {

          	echo "<table ALIGN=CENTER border=0 cellpadding=0 cellspacing=0  width=780>";
          	echo '<tr><td class=Branco align="right" >';
          	//echo "<a href=" . $NomeFormulario . ".php?TxtOpcao=I title='".$_ENV['MsgInclusao']."'>Clique aqui para inserir um registro</A></center></td></tr>";
          	echo "</table>";

          }
}





}



?>
-->
