<?php
// JGBAIAO@YAHOO.COM
// GERADOR DE FORMULARIO - BY JGBAIAO@YAHOO.COM - 25-01-2003 - SÁBADO 23:48
// todos os direitos reservados a JGBAIAO@YAHOO.COM
session_start();

$filelevel = 4;

include('utilities/check.php');

$_ENV['NomeFormulario'] = 'FrmRelatoriosAdministrativos';

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

	<b>Relatórios Administrativos</b><hr><br>

	<a href=r71-RelatorioAnaliticoPeriodo.php>R71-Relatório Analítico por Período</a><br>

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











