<?php
require_once "koneksi.php";

class People 
{
	public function get_people()
	{
		global $mysqli;
		$query  = "SELECT id, name, gender FROM people ";
		$data   = array();
		$result = $mysqli->query($query);

		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}


		$response=$data;
						

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_person($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people";
		if($id != 0){
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function get_personwithparent($id=0)
	{
		global $mysqli;
		$query="SELECT * FROM people";
		if($id != 0){
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function insert_person()
		{
			global $mysqli;
			$arrcheckpost = array('name' => '', 'gender' => '', 'parent' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == count($arrcheckpost)){
			
					$result = mysqli_query($mysqli, "INSERT INTO people SET
					name    = '$_POST[name]',
					gender  = '$_POST[gender]',
					parent  = '$_POST[parent]'");
					
					if($result)
					{
						$response=array(
							'status' => 1,
							'message' =>'Added Successfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'message' =>'Addition Failed.'
						);
					}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}

	function update_person($id)
		{
			global $mysqli;
			$arrcheckpost = array('name' => '', 'gender' => '', 'parent' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == count($arrcheckpost)){
			
		        $result = mysqli_query($mysqli, "UPDATE people SET
		        name    = '$_POST[name]',
                gender  = '$_POST[gender]',
                parent  = '$_POST[parent]'
		        WHERE id='$id'");
		   
				if($result)
				{
					$response=array(
						'status' => 1,
						'message' =>'Updated Successfully.'
					);
				}
				else
				{
					$response=array(
						'status' => 0,
						'message' =>'Updation Failed.'
					);
				}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}

	function delete_person($id)
	{
		global $mysqli;
		$query="DELETE FROM people WHERE id=".$id;
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public function get_child($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent = '$id'";
		
		$data=array();
		$result=$mysqli->query($query);
        
		while($row=mysqli_fetch_object($result)){
            
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

    public function get_femalechild($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent = '$id' AND gender='female'";
		
		$data=array();
		$result=$mysqli->query($query);
        
		while($row=mysqli_fetch_object($result)){
            
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

    public function get_malechild($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent = '$id' AND gender='male'";
		
		$data=array();
		$result=$mysqli->query($query);
        
		while($row=mysqli_fetch_object($result)){
            
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

    public function get_grandchild($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent IN (SELECT id FROM people WHERE parent = '$id')";
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);		 
	}

    public function get_malegrandchild($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent IN (SELECT id FROM people WHERE parent = '$id') AND gender='male'";
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);		 
	}

    public function get_femalegrandchild($id=0)
	{
		global $mysqli;
		$query="SELECT id, name, gender FROM people WHERE parent IN (SELECT id FROM people WHERE parent = '$id') AND gender='female'";
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result)){
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);		 
	}


}

 ?>