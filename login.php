<?PHP
$authenticated = False;
$auth_fail = False;
$create_fail = True;
$session = isset($_COOKIE['session'])?$_COOKIE['session']:False;
$username = isset($_POST['username'])?$_POST['username']:False;
$password = isset($_POST['password'])?$_POST['password']:False;
$function = isset($_POST['function'])?$_POST['function']:False;
$dsn = 'mysql:dbname=ontario_computers;host=localhost'; 
$dbUser = 'appuser';
$dbPassword = 'Testing!'; 
$db = new PDO($dsn,$dbUser,$dbPassword); 
if ( $function === 'Create Account' and $username !== False and $password !== False ) {
	$query =  sprintf("SELECT count(*) FROM authentication WHERE username = '%s';",$username);
	$cursor = $db->query($query);
	$count = $cursor->fetchColumn();
	if ( $count == 0 ) {
		$sql = sprintf("INSERT INTO authentication (username,password) VALUES ('%s',md5('%s'));",$username,$password);
		$db->exec($sql);
		$create_fail = False;
	} 
} else { 
if ( $username !== False and $password !== False ) { 
	$query = sprintf ("SELECT count(*) from authentication WHERE username = '%s' AND password = md5('%s');",$username,$password);
	$cursor = $db->query($query);
	$count = $cursor->fetchColumn();
	if ( $count > 0 ) {
		$session_id = (string) rand(1,1000);
		$sql = sprintf("INSERT INTO sessions (username,session_id) VALUES ('%s',md5('%s'));",$username,$session_id);
		$db->exec($sql);
		setcookie('session',$session_id);
		$authenticated = True;
	} else {
		$auth_fail = True;
	}
} elseif ( $session !== False ) {
	$session_exists = False;
	$query = sprintf ("SELECT username from sessions where session_id = md5('%s') order by issue_date;",$_COOKIE['session']);
	$cursor = $db->query($query);
	$fetchedName = $cursor->fetchObject();
	if ($fetchedName->username == Null ) {
		$auth_fail = True;
	} else {
		$username = $fetchedName->username;	
		$authenticated = True;
	}
}
}
?>
<HTML><BODY><h1>Welcome to Ontario Computers</h1>
<div style="height:100px;border:2px solid black;text-align:center;position:relative;">
<?PHP
if ( !$authenticated ) {
?>
<form method="POST">
<div style='margin-top:10px;'>Username: <input type="text" name="username">
Password: <input type="password" name="password">
<input type="submit" name='function' value="Login"><input type="submit" name="function" value="Create Account" />
</div></form>
<?PHP
if ( !$create_fail ) { printf("<span style='color:green;'>Account %s created!</span>",$username); }
elseif ( $auth_fail ) { printf("<span style='color:red;'>Authentication failed</span>"); }
} else {
?>
<span style='color:green;'>Thank you for logging in <?=$username?>!</span>
<?PHP } ?>
</div>
</BODY></HTML>
