<?php
    class DBConnection
	{
		public  $con;
		public function __construct()
		{
			$host = 'localhost';
            $dbname = 'childcare';
            $user = 'root';
            $pass = '';
			//$conn = null;

            try 
			{				
				$this->con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);				
                $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//return $conn;
            }
            catch(PDOException $e) 
			{

                echo 'ERROR: ' . $e->getMessage();
            }

        } // function ends

    }// class ends
?>