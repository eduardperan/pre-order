<?php
class Customer extends Database{
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $password;

    public function __construct($email, $password){
        parent::__construct();
        $this->email = $email;
        $this->password= $password;
    }

    public function login(){
        if ($this->connect()) {
            $query = $this->db_con->prepare("SELECT * FROM tblcustomer where email=? AND password=?");
			$query->execute(array($this->email, $this->password));		
			$count = $query->rowCount();                      
            $res = $query->fetch(PDO::FETCH_ASSOC);	
			if ($count === 1) {        
                $this->id = $res['id'];
                $this->fname = $res['fname'];
                $this->lname = $res['lname'];             
                return true;                     
			} else {                        
                return false;                
            }               
        }   
    }

    public function register(){
        if ($this->connect()) {
            $strsql = 'insert into tblcustomer(id,fname,lname,email,password) values(?,?,?,?,?)';
            try{			
                $query = $this->db_con->prepare($strsql);
                $query->execute(array($this->id, $this->fname, $this->lname, $this->email, $this->password));           
                return true;            
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }    
        }
    }
}
?>