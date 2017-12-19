<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
require_once("check.php");
?>
<div id="mt">后台管理 - 管理员密码修改</div>
<div id="nei">

<form method="post" action="passtj.php">
<input type="hidden" name="action" value="1" />
<table>

<tr>
<td>原密码:</td><td><input type="password" name="pass" style="width: 250px; height: 25px;" /></td>
</tr>
<tr>
<tr>
<td>新密码:</td><td><input type="password" name="newpass" style="width: 250px; height: 25px;" /></td>
</tr>
<tr>
<tr>
<td>确认新密码:</td><td><input type="password" name="nnewpass" style="width: 250px; height: 25px;" /></td>
</tr>
<tr>

<tr><td></td><td><input type="submit" style="width:150px; height: 35px; " value="确认修改" /></td></tr>
</table>

</form>

</div>