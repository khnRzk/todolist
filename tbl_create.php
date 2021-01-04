<?php

class Create_table extends Database
{
	
	public function create_tbl($sql) {
		$query = mysqli_query($this->Con,$sql);
		if ($query) {
			return "Table Created !";
		} else {
			return mysqli_error($this->Con);
		}	
	}
}

$tbl_cre_query = "CREATE TABLE IF NOT EXISTS task_list(
		id INT(11) NOT NULL AUTO_INCREMENT,
		title VARCHAR(255) NOT NULL,
		description VARCHAR(255) NOT NULL,
		t_date DATE NOT NULL,
		status INT(11) NOT NULL DEFAULT '0',
		created_at TIMESTAMP(6) NOT NULL, 
		PRIMARY KEY (`id`)
	)";

$run = new Create_table;
$run->create_tbl($tbl_cre_query);

?>