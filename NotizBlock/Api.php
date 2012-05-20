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
        $result_row=  mysql_fetch_array($result);
        $isAuthenticated = false;

        if ($result_row!=null)
        {
            //echo $row['username'];
            $access = "user";
            $_SESSION['user_info']=$result_row;
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
    
    /***********************************************/
    //                      USER
    /***********************************************/
    
    
    /*regstering a user. Checks to ensure user is not already registered via same email.*/
    public function registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
    {
       
        $sql2= "SELECT userid from basicUser where email= '".$email."' ";
        $alreadyUser = mysql_fetch_array(mysql_query($sql2));
        var_dump($alreadyUser);
        die();
        $alreadyUser = $alreadyUser[0];
        
        if ($alreadyUser == null){
            
            $sql = "INSERT INTO basicUser VALUES '". mysql_real_escape_string($firstName)."'
                        , '".mysql_real_escape_string($lastName)."'
                        , '".mysql_real_escape_string($password)."'
                        , '".mysql_real_escape_string($email)."'
                        , '". mysql_real_escape_string($phone)."'
                        , '". mysql_real_escape_string($personalinfo)."'";
            
            mysql_query($sql); 
            return "Sucess User registered";
        }
        else{
          //give an error saying an account is already associated with this email  
          return "failure: There is an account associated with this email";
        }
    }
   
   
    /***********************************************/
    //                      ITEM
    /***********************************************/
    
    
    
    /* adds an item to the database an item need to be added b4 a book or house can be made*/
    public function additem($bUserId,$category,$uploadtime,$keyword,$image,$saletype){
        
        $bUserId =  mysql_real_escape_string($bUserId);//mysql_real_escape_string($bUserId);
        $category = mysql_real_escape_string($category);
        $uploadtime = date('Y-m-d H:i:s');
        $keyword = mysql_real_escape_string($keyword);
        $saletype = mysql_real_escape_string($saletype);
        $image = mysql_real_escape_string($image);
        $sql1 = "INSERT INTO item
               VALUES (null,'$bUserId','$category','$uploadtime','$saletype','$keyword','$image')";
        mysql_query($sql1);
        
        
    }
    public function edititem(){
        
    }
    
    /*remove item with a particual item id*/
    public function rmitem($itemid){
        $itemid = mysql_real_escape_string( $itemid);
        $sql = "delete FROM item where itemid='$itemid'";
        mysql_query($sql);
    }
    
    /***********************************************/
    //                      BOOK
    /***********************************************/
    
    /*add a book to the database*/
    public function addBook($title, $author,$publisher,$saletype,$published_date,$edition,
                            $subjectarea,$condition,$askingprice, $description,$bUserId,$category,$uploadtime,$keyword,$image)
    {
        
      $title = mysql_real_escape_string($title);
      $author = mysql_real_escape_string ($author);
      $publisher = mysql_real_escape_string($publisher);
      $published_date =mysql_real_escape_string($published_date);
      $edition = mysql_real_escape_string($edition);
      $subjectarea = mysql_real_escape_string($subjectarea);
      $condition = mysql_real_escape_string($condition);
      $description = mysql_real_escape_string ($description); 
      
      
      $saletype = mysql_real_escape_string($saletype);
      $askingprice = mysql_real_escape_string($askingprice);
      
      $bUserId =  mysql_real_escape_string($bUserId);//mysql_real_escape_string($bUserId);
      $category = mysql_real_escape_string($category);
      $uploadtime = date('Y-m-d H:i:s');
      $keyword = mysql_real_escape_string($keyword);
      $image = mysql_real_escape_string($image);
      
      $api= new Api;
      $api->additem($bUserId, $category, $uploadtime, $keyword, $image, $saletype);
      
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
    
    /*update book information*/
    public function editbook($itemid,$title,$author,$publisher, $published_date,$edition,$subjectarea,$condition, $saletype, $askingprice, $description)
    {
      $itemid =  mysql_real_escape_string($itemid);
      $title = mysql_real_escape_string($title);
      $author = mysql_real_escape_string ($author);
      $publisher = mysql_real_escape_string($publisher);
      $published_date =mysql_real_escape_string($published_date);     
      $edition = mysql_real_escape_string($edition);
      $subjectarea = mysql_real_escape_string($subjectarea);
      $condition = mysql_real_escape_string($condition);
      $saletype = mysql_real_escape_string($saletype);
      $askingprice = mysql_real_escape_string($askingprice);
      $description = mysql_real_escape_string ($description); 
      
      $sql="update book ('$itemid','$title','$author','$publisher', '$published_date','$edition','$subjectarea','$condition', '$saletype', '$askingprice', '$description') where itemid= '$itemid'";
      $result = mysql_query($sql);
      return $result;
    }
    /*remove book with a specific id*/
    public function  rmbook($itemid){
     
        $api = new Api();
        $api->rmitem($itemid);
        $itemid = mysql_real_escape_string( $itemid);
        $sql = "delete FROM book where itemid='$itemid'";
        mysql_query($sql);
        
    }
    
    
    /*retrieve all books that a specific user uploaded*/
    public function getownerBooks($ownerid)
    {
        $sql2 = "SELECT * from book JOIN item on book.itemid= item.itemid where bUserid= '".$ownerid."'";
        $bookdetails =  mysql_fetch_array(mysql_query($sql2));
        return $bookdetails;
        
    }
     /* selects all books in the database*/
     public function listBooks()
    {
        //list all books in database
        $sql2 = "SELECT * from book";
        $userBooks = mysql_fetch_array(mysql_query($sql2));
        return $userBooks;     
    }
    
    /***********************************************/
    //                      BID
    /***********************************************/
    
    /*add a new bid for an item by a specific user*/
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
    /*FIND THE MAXIMUM BID FROM ALL bid history for a particular item*/
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
    
    
    /* search by userid or itemid or all to view bid history*/
    public function viewbidhistory($searchby,$value)
    {
        //search by will take as input:
        //                               1 for search by userid;
        //                               2 for search by itemid;
        //                               3 for all
        // need to check in html to ensure that search is being passed the right values
        $search= "";
        $a = "WHERE bUserid = '$value'";
        $b = "WHERE itemid = '$value'";
        $c = " ";
        $search = ($searchby==1)?$a:($searchby==2)?$b:$c;
        $value = mysql_real_escape_string( $value);
        $sql = "SELECT *
                FROM bid 
                . $search .";
        $bidhistoryarray = mysql_fetch_array(mysql_query($sql));
        $bidhistory =  $bidhistoryarray[0];
        return $bidhistory;
    }
    
    /***********************************************/
    //                      HOUSE
    /***********************************************/
    
    /*add house to database by first adding it as an item(foreign key constraint)*/
    public function addhouse($itemid,$bedrooms,$bathrooms, $facilities, $price,$locatedNear , $description,
                             $bUserId,$category,$saletype,$uploadtime,$keyword,$image){
        $itemid = mysql_real_escape_string($itemid);
        $bedrooms = mysql_real_escape_string($bedrooms);
        $bathrooms = mysql_real_escape_string($bathrooms);
        $facilities = mysql_real_escape_string($facilities);
        $price = mysql_real_escape_string( $price);
        $locatedNear = mysql_real_escape_string( $locatedNear);
        $description = mysql_real_escape_string($description);
        
        $api = new Api();
        $api->additem($bUserId, $category,$saletype, $uploadtime, $keyword, $image);
        $sql="INSERT INTO house VALUES( $itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description)";
        $result = mysql_query($sql);
        return $result;
    }
    
    /*edit house datails*/
    public function edithouse($itemid,$bedrooms,$bathrooms, $facilities, $price,$locatedNear , $description){
        $itemid = mysql_real_escape_string($itemid);
        $bedrooms = mysql_real_escape_string($bedrooms);
        $bathrooms = mysql_real_escape_string($bathrooms);
        $facilities = mysql_real_escape_string($facilities);
        $price = mysql_real_escape_string( $price);
        $locatedNear = mysql_real_escape_string( $locatedNear);
        $description = mysql_real_escape_string($description);
        
        $sql="update house VALUES( $itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description)";
        $result = mysql_query($sql);
        return $result;
    }
    
    /*remove house with a particual item id*/
    public function rmhouse($itemid){
        $api = new Api();
        $api->rmitem($itemid);
        $itemid = mysql_real_escape_string( $itemid);
        $sql = "delete FROM house where itemid='$itemid'";
        mysql_query($sql);
    }
    
    /* Get all house with specific item id*/
    public function viewhouse($itemid){
        
        $itemid = mysql_real_escape_string( $itemid);
        $sql2 = "SELECT * from house 
                 WHERE itemid = '$itemid'";
        $housearray = mysql_fetch_array(mysql_query($sql2));
        $house = $housearray[0];
        return $house;  
    }
    
    
    
    /***********************************************/
    //                      Recommender
    /***********************************************/
    public function recommender(){
        
    }
}
