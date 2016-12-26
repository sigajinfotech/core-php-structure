# core-php-structure

# SELECT query execution sample code. 
$sql = "SELECT * FROM users";
$users = $DAO->select($sql);

# INSERT query execution sample code. 
$array = array(
	'table_name' => 'users',
	'values' => array(
		'first_name' => 'Hardik',
		'last_name' => 'Desai',
		'created_at' => date('Y-m-d H:i:s',time())
	)
);
$result = $DAO->insert($array);

# UPDATE query execution sample code. 
$array = array(
	'table_name' => 'users',
	'values' => array(
		'first_name' => 'Hardik123',
		'last_name' => 'Desai123',
	),
	'where' => array(
		array(
			'condition' => '',
			'column_name' => 'id',
			'column_value' => '4',
		), 
    array(
			'condition' => 'AND',
			'column_name' => 'id',
			'column_value' => '4',
		)
	)
);
$result = $DAO->insert($array);
