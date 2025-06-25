<HTML><HEAD>
<style> table { border-collapse: collapse; width: 100%; }
th, td { text-align: left; padding: 8px; }
tr:nth-child(even)
{ background-color: Lightgreen; }</style>
</HEAD>
<BODY><h1>Welcome to Ontario Computers!</h1>
<table><tr><th>Item #</th><th>Name</th><th>Description</th><th>Price</th></tr>
<?PHP
$search = isset($_GET['search'])?" WHERE item_name LIKE ('%".$_GET['search']."%')":"";
$dsn = 'mysql:dbname=ontario_computers;host=localhost';
$dbUser = 'appuser';
$password = 'Testing!';
$db = new PDO($dsn,$dbUser,$password);
$query_string = "SELECT * FROM items".$search;
print($query_string);
$cursor = $db->query($query_string);
while ( $data = $cursor->fetchObject() ) {
	printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%.2f</td></tr>",$data->item_id,$data->item_name,$data->item_description,$data->price);
	
	}  
?></table></BODY></HTML>
