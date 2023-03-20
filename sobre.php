<?php
session_start();
echo '<center>';
include('utilities/check.php');
$_ENV['Relatorio'] = $_GET['Relatorio'];
$_ENV['NomeFormulario'] = 'Sobre';

require('utilities/Cabecalho.php');
require('utilities/Cabecalho2.php');

?>
<center>
<table border="0" width="50%">
  <tr>
    <td width="29%" rowspan="3"><p align="center"><img border="0" src="images/inicial.jpg" width="120" height="57"></td>
    <td width="71%" bgcolor="#C0C0C0"><b><span style="background-color: #C0C0C0"><font size="2">&nbsp;MICROINFO LTDA.</font></span></b></td>
  </tr>
  <tr>
    <td width="71%" bgcolor="#E4E4E4"><i><font size="2">Av.Afranio de Mello Franco, 333</font></i>
    </td>
  </tr>
  <tr>
    <td width="71%" bgcolor="#E4E4E4"><i><font size="2">Quitandinha - Funpat - Petrópolis</font></i>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan="2" bgcolor="#C0C0C0">
      <p align="center"><b><font size="2">&nbsp;SisVTR - Sistema de Controle de Viaturas</font></b></p>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan="2" bgcolor="#E4E4E4">
            <p align="right">
            <font size="2">&nbsp;Versão
            1.0 16/11/2004</font>
            </p>
    </td>
  </tr>
  <tr>
    <td width="29%" bgcolor="#C0C0C0">
      <p align="center"><b><font size="2">Suporte Técnico</font></b></p>
    </td>
    <td width="71%" bgcolor="#C0C0C0">&nbsp;</td>
  </tr>
  <tr>
    <td width="29%" rowspan="3" bgcolor="#C0C0C0">&nbsp;</td>
    <td width="71%" bgcolor="#E4E4E4"><font size="2">email@dominio.com.br</font></td>
  </tr>
  <tr>
    <td width="71%" bgcolor="#E4E4E4"><font size="2">21-0000-0000</font></td>
  </tr>
  <tr>
    <td width="71%" bgcolor="#E4E4E4"><font size="2"></font></td>
  </tr>
</table>
</center>
<?
echo '<table ALIGN=CENTER border=0 cellpadding=0 cellspacing=0  width=775>';
echo '<tr><td class=Branco align="center" >';
echo '<br><br><br><br><br><br><a href=default.php>Voltar</A></td></tr></table>';
?>

</body>
</HTML>
