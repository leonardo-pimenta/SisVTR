<?php
session_start();

if (isset($_GET['action']))
	$action=$_GET['action'];
else
	$action="";

require('utilities/config.php');
require('utilities/Cabecalho.php');

if ($action == "login")
	login();
elseif ($action == "logout")
{
	Redirecionar("default.php","", "default.php","");
	logout();
	login();
}
elseif ($action == "messages")
	messages();
else
  login();

function login() {

if (!isset($_GET['url']))
        $url = "";
else
        $url = $_GET['url'];

if (!isset($_POST['todo']))
        $todo = "" ;
else
        $todo = $_POST['todo'];

if ($todo=="")
{
?>
<form action="<?= $_ENV['smsecurepage']?>?action=login" method=post id=form1 name=form1><center>
<?

echo "<table align=center border=0 cellspacing=0 cellpadding=0 width=300><tr><td class=titulo   height=15 rowspan=2 nowrap><table align=center border=0 cellspacing=0 cellpadding=0 width=135><tr><td width=135></td></tr></table><font face=verdana size=-2 color=white>&nbsp;&nbsp;<b> ";
echo "Login do Sistema";
echo "</b></font></td><td class=titulo style='border-right:none;border-top:none' valign=top><img id=cti1 src=Icones/tr14x15_1.gif width=14 height=15 alt=' '</td>";

echo "<td align=right width=90%><font face=verdana size=-2>";
echo "</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=300 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>";
?>
<tr><td align=right class=Normal width=40%>Login</td><td align=left class=Normal width=40%><input name=todo type=hidden value=login><input name=url type=hidden value="<?=$url?>"><input name=username type=text maxlength=50 size=20></td><td align=center class=Normal width=20%>&nbsp;</td></tr>
<tr><td align=right class=Normal width=40%>Senha</td><td align=left class=Normal width=40%><input name=password type=password maxlength=50 size=20></td><td align=center class=Normal width=20%><font class=tbody><input name=submit type=submit size=10 value=Login></font></td></tr>
</table>
</td></tr>
</table>
</center>
</form>
<?php
}
elseif ($todo == "login") {
        $chkerror="";
        $adderror="";
        if (!isset($_POST['username']))
              $chkerror = "<b>Erros ao logar. Por favor verifique as informações e tente novamente.</b>";
        if (!isset($_POST['password']))
              $chkerror = "<b>Erros ao logar. Por favor verifique as informações e tente novamente.</b>";
        if (!isset($_POST['url']))
              $chkerror = "<b>Erros ao logar. Por favor verifique as informações e tente novamente.</b>";
	if (!$chkerror == "") {
                $adderror = "<b>Erros ao logar. Por favor verifique as informações e tente novamente.</b>";
                $username = "";
                $password = "";
                $url = "";
	}
        else
        {

                $username = fixer($_POST['username']);
                $password = fixer($_POST['password']);
                $url = $_POST['url'];
        }

	if (!$username == "" && !$password == "") {

                $smsecurequery = "select * from Adm_Usuario where LOGIN = '" . $username . "'";
                $smsecurers = mysql_query($smsecurequery);
			if (@mysql_affected_rows() <= 0) {
      	         $adderror = " &#149; " . $_ENV['invalidusername'];
                 echo "<center>Usuário não foi encontrado!</center>";
                 Redirecionar($_ENV['smsecurepage'],"login", $_SERVER['REDIRECT_URL'],"");
			}
			else
			{
				$row = mysql_fetch_array($smsecurers);

				if ($row['SENHA'] == $password)
				{
					if ($row['ADMINISTRADOR'] == "S") {
						$_SESSION['ADMINISTRADOR'] = True;
					}
					else
					{
						$_SESSION['ADMINISTRADOR'] = false;
					}
       	          	if ($row['STATUS'] == 'A') {
						$_SESSION['STATUS'] = True;
					}
					else
					{
						echo "<center> Você está marcado como usuário desativado, contacte um administrador para resolver o problema!</center>";
					    logout();
  			        }

					if ($row['DATA_EXPIRA'] == "0000-00-00")
					{
						$_SESSION['DATA_EXPIRA'] = True;
                    }
					elseif (strftime($row['DATA_EXPIRA']) < date("Y-m-d"))
					{
					          echo " <center>Sua senha expirou, contacte um administrador para resolver o problema!</center>";
							  logout();
					}
					else
					{
					          $_SESSION['DATA_EXPIRA'] = True;
					}


                     $_SESSION['LOGIN'] = $row['LOGIN'];
			         $_SESSION['NOME'] = $row['Firstname'] . " " . $row['Lastname'];
			         $_SESSION['ID'] = $row['ID'];
		}
		else
		{
            $adderror = $adderror . " &#149; " . $_ENV['invalidpassword'];
			echo " <center>Senha/Usuário inválido!</center>";
	        Redirecionar($_ENV['smsecurepage'],"login", $_SERVER['REDIRECT_URL'],"");
            exit;
		}

	}
    }
    else
    $adderror = "<b>Erros ao logar. Por favor verifique as informações e tente novamente.</b>";

if ($adderror == "") {
	if ($url == "") {
                Redirecionar("default.php","", "default.php","");
		}
	else
		{
                Redirecionar($url,"login", $url,"");
		}
}
else
{
logout();
?>
<center>
<form action="<?=$_ENV['smsecurepage']?>?action=login" method=post id=form1 name=form1>
<table cellspacing=0 border=0 cellpadding=0 border=0 width=50% class=black>
<tr><td>
<table cellspacing=1 border=0 cellpadding=5 border=0 width=100% class=black>
<tr><td align=center class=smsecurehlcolor><font class=tbody>&nbsp;&nbsp;<b>Página de Login</b></font></td></tr>
<tr><td align=center class=smsecuresepcolor><font class=tbodysmall><?=$adderror?></font></td></tr>
<tr><td align=center class=Normal>
<table cellspacing=0 border=0 cellpadding=2 border=0 width=100% class=black>
<tr><td align=right class=Normal width=40%><font class="tbody">Login</font></td><td align=left class=Normal width=40%><font class=tbody><input name=todo type=hidden value=login><input name=url type=hidden value="<?=$url?>"><input name=username type=text maxlength=50 size=20 value=<?=$username?>></font></td><td align=center class=Normal width=20%></td></tr>
<tr><td align=right class=Normal width=40%><font class="tbody">Senha</font></td><td align=left class=Normal width=40%><font class=tbody><input name=password type=password maxlength=50 size=20 value=<?=$password?>></font></td><td align=center class=Normal width=20%><font class=tbody><input name=submit type=submit size=10 value=Login></font></td></tr>
</table>
</td></tr>
</table></td></tr>
</table>
</form>
</center>
<?php
}
}
}

function logout() {
// on error resume next
	if ($_ENV['DEBUG']) echo "<br>Username:" . $_SESSION['usernameBeneficio'];


	$_SESSION['ADMINISTRADOR'] = "";
	$_SESSION['STATUS'] = "";
	$_SESSION['LOGIN'] = "";
	$_SESSION['NOME'] = "";
	$_SESSION['ID'] = "";
	$_SESSION['DATA_EXPIRA'] = "";

	unset($_SESSION['ADMINISTRADOR']);
	unset($_SESSION['STATUS']);
	unset($_SESSION['LOGIN']);
	unset($_SESSION['NOME']);
	unset($_SESSION['ID']);
	unset($_SESSION['DATA_EXPIRA']);

	?>
	<form action="<?= $_ENV['smsecurepage']?>?action=login" method=post id=form1 name=form1><center>
	<?php
	echo "<table align=center border=0 cellspacing=0 cellpadding=0 width=300><tr><td class=titulo   height=15 rowspan=2 nowrap><table align=center border=0 cellspacing=0 cellpadding=0 width=135><tr><td width=135></td></tr></table><font face=verdana size=-2 color=white>&nbsp;&nbsp;<b> ";
	echo "Login do Sistema";
	echo "</b></font></td><td class=titulo style='border-right:none;border-top:none' valign=top><img id=cti1 src=Icones/tr14x15_1.gif width=14 height=15 alt=' '</td>";
	echo "<td align=right width=90%><font face=verdana size=-2>";
	echo "</font></td></tr><tr><td bgcolor=4d99e5 colspan=2><table align=center border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table></td></tr></table><table align=center width=300 cellpadding=4 cellspacing=0 border=0 bgcolor=e5f6ff class=yhmpabd>";
	?>
	<tr><td align=right class=Normal width=40%>Login</td><td align=left class=Normal width=40%><input name=todo type=hidden value=login><input name=url type=hidden value="<?=$url?>"><input name=username type=text maxlength=50 size=20></td><td align=center class=Normal width=20%>&nbsp;</td></tr>
	<tr><td align=right class=Normal width=40%>Senha</td><td align=left class=Normal width=40%><input name=password type=password maxlength=50 size=20></td><td align=center class=Normal width=20%><font class=tbody><input name=submit type=submit size=10 value=Login></font></td></tr>
	</table>
	</td></tr>
	</table>
	</center>
	</form>
	<?php
 	exit;
}

function messages() {
	// on error resume next
        $mesid = $_GET['mesid'];

	if ($mesid==1) {
                $currmessage = $_ENV['documentexpired'];}
	elseif ($mesid==2) {
                $currmessage = $_ENV['unauthorised'];}
	elseif ($mesid==3) {
                $currmessage = $_ENV['inactivemember'];}
	elseif ($mesid==4) {
                $currmessage = $_ENV['invalidlevel'];}
	elseif ($mesid==5) {
                $currmessage = $_ENV['memberexpired'];}
	else {
		$currmessage = "";}
	require('utilities/Cabecalho2.php');
?>
<center>
<form action="<?=$smsecurepage?>?action=login" method=post id=form1 name=form1>
<table cellspacing=0 border=0 cellpadding=0 border=0 width=50% class=black>
<tr><td>
<table cellspacing=1 border=0 cellpadding=5 border=0 width=100% class=black>
<tr><td align=center class=smsecurehlcolor><font class=tbody>&nbsp;&nbsp;<b>Erro
    ao processar a requisição</b></font></td></tr>
<tr><td align=center class=smsecuresepcolor><font class=tbodysmall><?=$currmessage;?></font></td></tr>
</table></td></tr>
</table>
</form>
</center>
<?php
}

?>
