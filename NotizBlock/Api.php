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
        
        mysql_select_db("notizblock", $this->connection);
    }
    
    function __destruct()
    {
        mysql_close($this->connection);
    }
    
    public function login($username, $password)
    {   
        $sql = "SELECT idnumber, userAccess FROM idpasswords WHERE idnumber='" .  mysql_real_escape_string($username) . "' and idpassword='" .  mysql_real_escape_string($password) . "'";
        
        $result = mysql_query($sql);
        
        if(!$result)
        {
            $err = mysql_error();
            print $err;
            exit();
        }

        $isAuthenticated = false;

        while($row = mysql_fetch_array($result))
        {
            //echo $row['username'];
            $access = $row['userAccess'];
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
        Session.RemoveAll (); //Removes all session variables
    }
    
    public function registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
    {
        //add data to the database
        $sql2= "SELECT userid from basic User where email= '".$email."' ";
        $alreadyUser = mysql_query($sql2);
        if ($alreadyUser==null){
            $sql = "INSERT INTO basicUser VALUES '". mysql_real_escape_string($firstName)."'
                        , '".mysql_real_escape_string($lastName)."'
                        , '".mysql_real_escape_string($password)."'
                        , '".mysql_real_escape_string($email)."'
                        , '". mysql_real_escape_string($phone)."'
                        , '". mysql_real_escape_string($personalinfo)."'";
                $result = mysql_query($sql);
                if(!$result)
                {
                    $err = mysql_error();
                    print $err;
                    exit();
                }

                while($row = mysql_fetch_array($result))
                {
                    //echo $row['username'];
                    if ($row['email'] == $email)
                    {
                        $_SESSION['sessionId'] = mysql_query($sql2);//SETTING SESSION ID TO USERID
                    }
                }
                
        }
        else{
          //give an error saying an account is already associated with this email  
        }
        
            
            
        //if successfully added, return the id
        
        //if not successfully added return null
    }
    
    public function listBooks($filter = array())
    {
        $userid = $_SESSION['sessionId'];
        $sql2 = "SELECT itemid from book User where bUserid= '".$userid."' ";
        $userBooks = mysql_query($sql2);
        if(userBooks==null){
            //user has no books
        }
        else{
            return userBooks;
        }
            
    }
    
    public function addBook($title, $author,$publisher,$saletype,$published_date,$edition,$subjectarea,$condition,$askingprice, $description, $image)
    {
     
    }
    
    public function getBookDetails($bookId)
    {
        
    }
    
    public function addBid($bookId)
    {
        
    }
    
}
