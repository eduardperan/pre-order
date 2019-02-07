<?php
class Database{

    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    public $db_con;

    public function __construct(){
        $this->db_host = "localhost";
        $this->db_name = "db_preorder";
        $this->db_user = "root";
        $this->db_pass = "";
    }

    public function connect(){
		try{		
            $this->db_con = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}",$this->db_user,$this->db_pass);
            $this->db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function close(){
		$this->db_con = null;
	}

}
?>