<?php
class Api
{
    /*
    Functions in API:
    
    Have:   
        login($username, $password)
        logout()
        registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
        listBooks($userid)
        addBook($title, $author,$publisher,$saletype,$published_date,$edition,$subjectarea,$condition,$askingprice, $description,$bUserId,
                            $category,$uploadtime,$keyword,$image)
        getownerBooks($ownerid)
        addBid($itemid, $buserid, $bidamount)
        getmaxbid ($itemid)
    
    Need:
     * 
       viewbidhistory()
        editbook()
        addhouse()
        edithouse()
        viewhouse()
        recommender()
     *  removeitem()
     *  removebook()
     *  removehouse()
     * 
        
     
    
    */
    
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
    
    public function listBooks($userid)
    {
        //list all books in database
        $sql2 = "SELECT * from book";
        $userBooks = mysql_fetch_array(mysql_query($sql2));
        return Books;     
    }
    
    public function addBook($title, $author,$publisher,$saletype,$published_date,$edition,
                            $subjectarea,$condition,$askingprice, $description,$bUserId,
                            $category,$uploadtime,$keyword,$image)
    {
        
      $title = mysql_real_escape_string($title);
      $author = mysql_real_escape_string ($author);
      $publisher = mysql_real_escape_string($publisher);
      $saletype = mysql_real_escape_string($saletype);
      $published_date =mysql_real_escape_string($published_date);
      $edition = mysql_real_escape_string($edition);
      $subjectarea = mysql_real_escape_string($subjectarea);
      $condition = mysql_real_escape_string($condition);
      $askingprice = mysql_real_escape_string($askingprice);
      $description = mysql_real_escape_string ($description); 
      $bUserId = '1';//mysql_real_escape_string($bUserId);
      $category = mysql_real_escape_string($category);
      $uploadtime = date('Y-m-d H:i:s');
      $keyword = mysql_real_escape_string($keyword);
      $image = mysql_real_escape_string($image);
      
      $sql1 = "INSERT INTO item
               VALUES (null,'$bUserId','$category','$uploadtime','$saletype','$keyword','$image')";
      $result1=mysql_query($sql1);
      
      $sql3 = "SELECT itemid 
               FROM  item
               WHERE uploadtime = '$uploadtime'";
      $itemid2 = mysql_fetch_row(mysql_query($sql3));
      $itemid2 = $itemid2[0];
      $sql2 = "INSERT INTO book 
               VALUES ('$itemid2','$title','$author','$publisher',
                      '$published_date','$edition',
                      '$subjectarea','$condition',
                      '$saletype','$askingprice',
                      '$description')";
      $result = mysql_query($sql2);
      return $result;
    }
    
    public function getownerBooks($ownerid)
    {
        $sql2 = "SELECT * from book JOIN item on book.itemid= item.itemid where bUserid= '".$ownerid."'";
        $bookdetails =  mysql_fetch_array(mysql_query($sql2));
        return $bookdetails;
        
    }
    
    public function addBid($itemid, $buserid, $bidamount)
    {
       $itemid = mysql_real_escape_string( $itemid);
       $buserid = mysql_real_escape_string( $buserid);
       $biddate = date('Y-m-d');
       $bidtime = time('H:i:s');
       $bidamount = mysql_real_escape_string($bidamount);
       $sql="INSERT INTO bid VALUES( $itemid, $buserid,$biddate, $bidtime, $bidamount)";
       $result=mysql_query($sql);
       return $result;
       
    }
    
    public function getmaxbid ($itemid){
        //returns the max bid for an itel
         $itemid = mysql_real_escape_string( $itemid);
        $sql = "SELECT MAX(bidAmount)
             FROM bid 
             WHERE itemid= '$itemid'";
        $bidarray = mysql_fetch_array(mysql_query($sql));
        $bid = $bidarray[0];
        return $bid; 
    }
    
    public function viewbidhistory($searchby,$value)
    {
        //search by will take as input:
        //                               1 for search by userid;
        //                               2 for search by itemid;
        // need to check in html to ensure that search is being passed the right values
        $search= "";
        $a = "bUserid = '$value'";
        $b = "itemid = '$value'";
        $search = ($searchby==1)?$a:$b;
        $value = mysql_real_escape_string( $value);
        $sql = "SELECT *
                FROM bid 
                WHERE  . $search .";
        $bidhistoryarray = mysql_fetch_array(mysql_query($sql));
        $bidhistory =  $bidhistoryarray[0];
        return $bidhistory;
    }
    public function editbook($itemid)
    {
        
    }
    public function addhouse(){
        
    }
    public function edithouse(){
        
    }
    public function viewhouse($itemid){
        
        $itemid = mysql_real_escape_string( $itemid);
        $sql2 = "SELECT * from house 
                 WHERE itemid = '$itemid'";
        $housearray = mysql_fetch_array(mysql_query($sql2));
        $house = $housearray[0];
        return $house;  
    }
    public function recommender(){
        
    }
}
