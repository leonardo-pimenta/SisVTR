<?php
// JGBAIAO@YAHOO.COM
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// todos os direitos reservados a JGBAIAO@YAHOO.COM
session_start();

$filelevel = 4;

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmRelatoriosPedido';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');
?><br>



<table valign=baseline align=center border="0" >

<tr>

   <td valign=baseline>

	<br><br>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

   </td>


   <td valign=baseline colspan=>

	<b>Relatórios de Peças</b><hr><br>

	<a href=r51-controle_pecas.php>R51- Controle de Peças</a><br>

   </td>



   <td valign=baseline>

	<br><br>


	<br>



   </td>
</tr>

</table>
<?
echo '<table ALIGN=CENTER border=0 cellpadding=0 cellspacing=0  width=775>';
echo '<tr><td class=Branco align="center" >';
echo '<br><br><br><br><br><br><a href=default.php>Voltar</A></td></tr></table>';
?>











