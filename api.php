<?php
require_once "method.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-with, Content_Type,Accept,Authorization");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Request-Headers: Content-Type");

$person = new People();
$request_method=$_SERVER["REQUEST_METHOD"];
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
switch ($request_method) {
	case 'GET':
			if(strpos($actual_link, 'femalechild') !== false){
                $id=intval($_GET["id"]);
				$person->get_femalechild($id);
            }
            elseif(strpos($actual_link, 'malechild') !== false){
                $id=intval($_GET["id"]);
				$person->get_malechild($id);
            }elseif(strpos($actual_link, 'femalegrandchild') !== false){
                $id=intval($_GET["id"]);
				$person->get_femalegrandchild($id);
            }
            elseif(strpos($actual_link, 'malegrandchild') !== false){
                $id=intval($_GET["id"]);
				$person->get_malegrandchild($id);
            }
            elseif(strpos($actual_link, 'grandchild') !== false){
                $id=intval($_GET["id"]);
				$person->get_grandchild($id);
            }
            elseif(strpos($actual_link, 'child') !== false){
                $id=intval($_GET["id"]);
				$person->get_child($id);
            }
			elseif(strpos($actual_link, 'personwithparent') !== false){
                $id=intval($_GET["id"]);
				$person->get_personwithparent($id);
            }
            elseif(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$person->get_person($id);
			}
            
			else
			{
				$person->get_people();
			}
			break;
	case 'POST':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$person->update_person($id);
			}
			else
			{
				$person->insert_person();
			}		
			break; 
    // case 'PUT':
    //         $id=intval($_GET["id"]);
    //         $person->update_person($id);
	// 		break;
	case 'DELETE':
		    $id=intval($_GET["id"]);
            $person->delete_person($id);
            break;
	default:
		// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		break;
}




?>