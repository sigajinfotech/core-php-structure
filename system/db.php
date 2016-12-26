<?php
class DAO{
	public function getConnection() {
		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (mysqli_connect_errno()){
  			die("Failed to connect to Database: " . mysqli_connect_error());
  		}
  		return $conn;
	}

	public function closeConnection($conn) {
		mysqli_close($conn);
	}

	public function select($sql){
		$conn = $this->getConnection();
		$result = $conn->query($sql);
		$array = array();
		$count = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$array[$count] = $row;
				$count++;
			}
			$this->closeConnection($conn);
		}
		return $array;
	}

	public function insert($array){
		$conn = $this->getConnection();
		$sql = "";
		$value_part = " VALUES ( ";
		$column_part = "INSERT INTO ".$array['table_name']." ( ";
		foreach ($array['values'] as $key => $value) {
			$column_part .= "`".$key."`, ";
			$value_part .= "'".$value."', ";
		}
		$column_part = substr($column_part, 0, strlen($column_part)-2)." ) ";
		$value_part = substr($value_part, 0, strlen($value_part)-2)." );";
		$sql = $column_part." ".$value_part;
		if ($conn->query($sql) === TRUE) {
			$result = array('last_inerted_id'=>mysqli_insert_id($conn));
			$this->closeConnection($conn);
			return $result;
		}else{
			die("Error: ".$sql."<br>".$conn->error);
		}
	}

	public function update($array){
		$conn = $this->getConnection();
		$sql = "";
		$set_part = "UPDATE ".$array['table_name']." SET ";
		foreach ($array['values'] as $key => $value) {
			$set_part .= "`".$key."`='".$value."', ";
		}
		$set_part = substr($set_part, 0, strlen($set_part)-2);
		
		$where_part = "";
		if(count($array['where'])>0){
			$where_part .= " WHERE ";
			foreach ($array['where'] as $key => $value) {
				if($value['condition']!=''){
					$where_part .= " ".$value['condition']." ";
				}
				$where_part .= "`".$value['column_name']."`='".$value['column_value']."' ";
			}
		}
		$sql = $set_part." ".$where_part;
		if ($conn->query($sql) === TRUE) {
			$this->closeConnection($conn);
			return true;
		}else{
			die("Error: ".$sql."<br>".$conn->error);
		}
	}

	public function query($sql){
		$conn = $this->getConnection();
		if ($conn->query($sql) === TRUE) {
			$this->closeConnection($conn);
			return true;
		}else{
			die("Error: ".$sql."<br>".$conn->error);
		}
	}
}
?>