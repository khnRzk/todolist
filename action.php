<?php 


include "db.php";

/**
 * Data processing
 */
class Processing extends Database
{
	public function insert_data($input) {
		$sql ="";
		$sql .= "INSERT INTO task_list";
		$sql .= "(".implode(",", array_keys($input)).") VALUES";
		$sql .= "('".implode("','", array_values($input))."')";
		$run = mysqli_query($this->Con,$sql);
		if ($run) {
			return true;
		} else {
			return false;
		}
	}

	public function fetch_data() {
		$array = array();
		$sql = "SELECT * FROM task_list ORDER BY created_at DESC";
		$run = mysqli_query($this->Con,$sql);
		while ($row = mysqli_fetch_assoc($run)) {
			$array[] = $row;
		}
		return $array;
	}

	public function edit_fetch($input) {
		$array = array();
		$sql = "SELECT * FROM task_list WHERE id='$input'";
		$run = mysqli_query($this->Con,$sql);
		while ($row = mysqli_fetch_assoc($run)) {
			$array[] = $row;
		}
		return $array;
	}

	public function update_data($title,$des,$date,$id) {
		$sql ="";
		$sql .= "UPDATE task_list SET ";
		$sql .= "title ='$title', description = '$des', t_date = '$date' WHERE id=$id;";
		$run = mysqli_query($this->Con,$sql);
		if ($run) {
				return true;
		}
	}

	public function delete_rec($id) {
		$sql ="";
		$sql .= "DELETE FROM task_list WHERE id=$id;";
		$run = mysqli_query($this->Con,$sql);
		if ($run) {
			return true;
		}
	}
	public function drag($stat,$value) {
		$sql ="";
     	$sql .= "UPDATE task_list SET status = $stat WHERE id IN ";
     	$sql .= "($value)";
     	$run = mysqli_query($this->Con,$sql);
		if ($run) {
				return true;
		}
	}
}

$pro = new Processing;

/*Insert*/
if (isset($_POST["toDotitle"])) {
	
	$data_array = array(
		'title' => $_POST["toDotitle"],
		'description' => $_POST["toDoDes"],
		't_date' => $_POST["toDoDate"]
		);

	$pro->insert_data($data_array);
}

/*Fetch*/
if (isset($_POST['stat'])) {
	$data = $pro->fetch_data();
	echo json_encode($data);
}

/*Edit*/
if (isset($_POST['val'])) {
	$editID = $_POST['val'];

	$data = $pro->edit_fetch($editID);
	echo json_encode($data);
}

/*Update*/
if (isset($_POST['updateTitle'])) {
	$hid = $_POST["hiddID"];
	$title = $_POST["updateTitle"];
	$des = $_POST["toDoDes"];
	$date =$_POST["toDoDate"];

	$data = $pro->update_data($title,$des,$date,$hid);
	echo json_encode($data);

}

/*Delete*/
if (isset($_POST['st'])) {
	$delVal = $_POST['st'];

	$data = $pro->delete_rec($delVal);
	echo json_encode($data);
}

if (isset($_POST['item'])) {
		$values = json_encode($_POST['item']);
		$valuess = trim($values,'[]');
		$value = str_replace('"', '', $valuess);

		$data = $pro->drag('1',$value);
		echo json_encode($data);
		
}

if (isset($_POST['listing_id'])) {
		$values = json_encode($_POST['item']);
		$valuess = trim($values,'[]');
		$value = str_replace('"', '', $valuess);

		$data = $pro->drag('2',$value);
		echo json_encode($data);
		
}

?>