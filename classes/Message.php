<?php 
include_once 'config/config.php';
include_once 'libs/Database.php';
?>


<?php 

class Message{

	private $db;

	public function __construct(){
		$this->db=new Database();
	}

	public function totalMsg($sender,$receiver){
		$sql="SELECT * FROM tbl_chat 
			  WHERE
			  (sender_info='$sender' AND receiver_info='$receiver')
			  OR 
			  (sender_info='$receiver' AND receiver_info='$sender')";
		$result=$this->db->rownumbers($sql);
		return $result;
	}

	public function upadteMsgStatus($sender,$receiver){
		$sql="UPDATE
			  tbl_chat
			  SET
			  msg_status = 'read'
              WHERE
              sender_info = '$sender'
              AND
              receiver_info ='$receiver';";
        $result=$this->db->update($sql);
	}

	public function getMsg($sender,$receiver){
		$sql="SELECT * FROM tbl_chat 
			  WHERE
			  (sender_info='$sender' AND receiver_info='$receiver')
			  OR 
			  (sender_info='$receiver' AND receiver_info='$sender')
			  ";
		$result=$this->db->select($sql);
		return $result;
	}

	public function msgInsert($sender,$receiver,$content){
		$content;
		$sql="INSERT INTO 
			 tbl_chat 
			 (sender_info, receiver_info, content, msg_status, msg_date)
			 VALUES
			 ('$sender', '$receiver', '$content', 'unread', NOW());";

		$inserted_rows = $this->db->insert($sql);
		
		/*if ($inserted_rows) {
		 return true;
		}else {
		 return false;
		}*/
	}

}







 ?>