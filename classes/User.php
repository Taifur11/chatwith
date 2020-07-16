<?php 
include_once 'config/config.php';
include_once 'libs/Database.php';
?>


<?php 

class User{

	private $db;

	public function __construct(){
		$this->db=new Database();
	}

	public function emailcheck($email){
		$sql="SELECT * FROM tbl_user WHERE email='$email';";
		$result=$this->db->rownumbers($sql);
		if($result>0){
			return true;
		}
		else {
			return false;
		}
	}


	public function insertuser($username, $email, $password, $profile_pic, $country, $gender){

		$sql="INSERT INTO 
			 tbl_user 
			 (username, email, password, profile_pic, country, gender)
			 VALUES
			 ('$username', '$email', '$password', '$profile_pic', '$country', '$gender');";

		$inserted_rows = $this->db->insert($sql);
		
		if ($inserted_rows) {
		 return true;
		}else {
		 return false;
		}
	}



	public function userlogin($postdata){
		$email=$postdata['email'];
		$password=$postdata['password'];

		$sql="SELECT * FROM tbl_user WHERE email='$email' AND password='$password';";
		$row=$this->db->rownumbers($sql);
		if($row==1){
			$query="SELECT * FROM tbl_user WHERE email='$email' LIMIT 1;";
			$result=$this->db->select1($query);
			return $result;
		}
		else{
			return false;
		}
	}

	public function updatestatus($email){
		$sql="UPDATE tbl_user
			  SET status = 'online'
              WHERE email = '$email';";
        return $this->db->update($sql);
	}


}










 ?>