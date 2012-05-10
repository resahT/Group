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
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        
        $sql = "SELECT `username` , `password`
                FROM `basicUser`
                WHERE `username` = '$username'
                AND `password` = '$password'";
        
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
            $access = "user";
            $_SESSION['user_info']=$row;
            $isAuthenticated = true;
        }

        if($isAuthenticated)
        {
            return $access;
        }
        else
        {
            return "guest";
        }
    }
    
    public function logout()
    {
        Session.RemoveAll (); //Removes all session variables
    }
    
    public function registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
    {
        //add data to the database
        $sql2= "SELECT userid from basicUser where email= '".$email."' ";
        $alreadyUser = mysql_query($sql2);
        if ($alreadyUser == null){
            
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
                
        }
        else{
          //give an error saying an account is already associated with this email  
        }
        
            
            
        //if successfully added, return the id
        
        //if not successfully added return null
    }
    
    public function listBooks( )
    {
        $userid = $_SESSION['sessionId'];
        $sql2 = "SELECT itemid from book where bUserid= '".$userid."' ";
        $userBooks = mysql_query($sql2);
        if($userBooks==null){
            //user has no books
        }
        else{
            return userBooks;
        }
            
    }
    
    public function addBook($title, $author,$publisher,$saletype,$published_date,$edition,
            $subjectarea,$condition,$askingprice, $description,$bUserId, $category,$uploadtime,$keyword,$image)
    {
        
      $title = mysql_real_escape_string($title);
      $author = mysql_real_escape_string ($author);
      $publisher = mysql_real_escape_string($publisher);
      $saletype = mysql_real_escape_string($saletype);
      $published_date = mysql_real_escape_string($published_date);
      $edition = mysql_real_escape_string($edition);
      $subjectarea = mysql_real_escape_string($subjectarea);
      $condition = mysql_real_escape_string($condition);
      $askingprice = mysql_real_escape_string($askingprice);
      $description = mysql_real_escape_string ($description); 
      $bUserId = mysql_real_escape_string($bUserId);
      $category = mysql_real_escape_string($category);
      $uploadtime = mysql_query(current_timestamp());
      $keyword = mysql_real_escape_string($keyword);
      $image = mysql_real_escape_string($image);
      
      $sql1 = "INSERT INTO item
               VALUES ('$bUserId','$category','$uploadtime','$saletype','$keyword','$image')";
      $result2 = mysql_query($sql1);
      
      $itemid2 = "SELECT itemid 
                  FROM  item
                  WHERE uploadtime = '$uploadtime'";
      
      $sql2 = "INSERT INTO book 
               VALUES ('$itemid2',$title','$author','$publisher',
                      '$published_date','$edition',
                      '$subjectarea','$condition',
                      '$saletype','$askingprice',
                      '$description')";
      $result = mysql_query($sql2);
      return $sql2;
    }
    
    public function getBookDetails($bookId)
    {
        $sql2 = "SELECT * from book where bUserid= '".$bookId."' ";
        $bookdetails = mysql_query($sql2);
        return $bookdetails;
        
    }
    
    public function addBid($bookId)
    {
        
    }
    
}
