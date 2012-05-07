<?php
class Api
{
    private $connection = null;
    
    public function __construct()
    {
        $this->connection = mysql_connect("localhost","root","");
        
        if (!$this->connection)
        {
            die('Could not connect: ' . mysql_error());
        }
        
        mysql_select_db("db", $this->connection);
    }
    
    function __destruct()
    {
        mysql_close($this->connection);
    }
    
    public function login($username, $password)
    {
        $sql = "SELECT idnumber, userAccess FROM idpasswords WHERE idnumber='" .  mysql_real_escape_string($username) . "' and idpassword='" .  mysql_real_escape_string($password) . "'";
        
        $r = mysql_query($sql);
        
        if(!$r)
        {
            $err = mysql_error();
            print $err;
            exit();
        }

        $isAuthenticated = false;

        while($row = mysql_fetch_array($r))
        {
            //echo $row['username'];
            $accessd = $row['userAccess'];
            $isAuthenticated = true;
        }

        if($isAuthenticated)
        {
            return $access;
        }
        else
        {
            return false;
        }
    }
    
    public function logout()
    {
        
    }
    
    public function registerUser($firstName, $lastName)
    {
        //add data to the database
        
        //if successfully added, return the id
        
        //if not successfully added return null
    }
    
    public function listBooks($filter = array())
    {
        // check for the relevant keys and add them to the sql query to return 
        // the books
    }
    
    public function addBook($title, $isbn)
    {
        
    }
    
    public function getBookDetails($bookId)
    {
        
    }
    
    public function addBid($bookId)
    {
        
    }
    
}
