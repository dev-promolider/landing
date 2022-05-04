<?php 

class connBD {



	/*const host = "localhost";
	const bd_user = "root";
	const bd_password = "";
	const bd_name = "promolid_promolider";*/

	const host = "localhost";
	const bd_user = "promolid_oficina";
	const bd_password = "Diciembre123";
	const bd_name = "promolid_alex";


	public $_mysqli = NULL;
	public $_result = NULL;

	function __construct(){

		$this->_mysqli = @new mysqli(self::host, self::bd_user, self::bd_password, self::bd_name);

		if ($this->_mysqli->connect_errno)	
		{
		 	die('Connect Error: ' . $this->_mysqli->connect_errno );		
		}

		$this->_mysqli->set_charset("utf8");
	}

	function doQuery($query){

		$this->_result = $this->_mysqli->query($query);

		if (!$this->_result) 
		{
		    die('Invalid query: ' . $this->_mysqli->error);
		}

		return $this->_result;
	}


	function doSelect($table, $fields, $conditions = "")
	{
		$query = sprintf("SELECT %s FROM %s %s", $this->_mysqli->real_escape_string($fields), $this->_mysqli->real_escape_string($table), $conditions);
		$this->doQuery($query);
	}


	function doInsert($table, array $fields)
	{
		$fieldsData = "";

        $valuesData = "";

        $insert = "INSERT INTO " . $table . " ";

        foreach ($fields as $field => $value) {

            $fieldsData.= $field . ",";

            $value = $this->_mysqli->real_escape_string($value);

            $valuesData.= "'$value',";
        }

        $fieldsData = "(" . substr($fieldsData, 0, -1) . ")";

        $valuesData = "(" . substr($valuesData, 0, -1) . ")";

        $insert.= $fieldsData . " VALUES " . $valuesData;

        $this->doQuery($insert);
	}

	function doUpdate($table, array $fields, $conditions)
	{
		$update = "UPDATE " . $table . " SET ";

        foreach ($fields as $field => $value) {

            $value = $this->_mysqli->real_escape_string($value);

            $update.= "$field = '$value',";
        }

        $update = substr($update, 0, -1) . " WHERE " . $conditions;

        $this->doQuery($update);
	}

	function doDelete($table = null, $conditions = 'FALSE') {
		if ($table===null) return false;
		return $this->doQuery("DELETE FROM $table WHERE $conditions");
	}

	function getQueryCount()
	{
		return $this->_result->num_rows;
	}

	function resultHookBoth()
	{
		return $this->_result->fetch_array(MYSQLI_BOTH);
	}
	
	function resultHookNum()
	{
		return $this->_result->fetch_array(MYSQLI_NUM);
	}

	function resultHookAssoc()
	{
		return $this->_result->fetch_array(MYSQLI_ASSOC);
	}

	function getLastID()
	{
		return $this->_mysqli->insert_id;
	}

}

?>