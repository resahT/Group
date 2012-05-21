<?php

class Api
{
    /*
      Functions in API:

      Have:
      login($username, $password)
      logout()
      registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
      listBooks()
      viewBidHistory()
      getMaxBid()

      addBook($title, $author,$publisher,$saletype,$published_date,$edition,$subjectarea,$condition,$askingprice, $description,$bUserId,
      $category,$uploadtime,$keyword,$image)
      getownerBooks($ownerid)
      addBid($itemid, $buserid, $bidamount)

      Need:
     * 

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
    //This is the api response structure. Every api call should return it with the relevant values
    private $apiResponse = array(
        'result' => 'FAILURE', // set to either SUCCESS or FAILURE

        'messages' => array(
            'Unknown error occurred.' // list the error messages or success messages here
        )
    );

    public function __construct()
    {
        $this->connection = mysql_connect("localhost", "root", "");

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

        $sql = "SELECT `bUserid`, `username` , `password`
                FROM `basicUser`
                WHERE `username` = '$username'
                AND `password` = '$password'";

        $result = mysql_query($sql);
        $result_row = mysql_fetch_array($result);
        $isAuthenticated = false;

        if ($result_row != null)
        {
            $isAuthenticated = true;
        }

        $response = $this->apiResponse;

        if ($isAuthenticated)
        {
            $_SESSION['user_info'] = $result_row;
            $_SESSION['userType'] = 'user';

            $response['result'] = 'SUCCESS';
            $response['messages'] = array('User was successfully logged in.');
        }
        else
        {
            $_SESSION['user_info'] = array();
            $_SESSION['userType'] = 'guest';

            $response['result'] = 'FAILURE';
            $response['messages'] = array('User was NOT successfully logged in. Check the username and password that were supplied.');
        }

        return $response;
    }

    public function logout()
    {
        $_SESSION = array(); //Removes all session variables
    }

    /*     * ******************************************** */

    //                      USER
    /*     * ******************************************** */


    /* regstering a user. Checks to ensure user is not already registered via same email. */
    public function registerUser($fname, $lname, $username, $password, $dept, $email, $phone, $dateofRegistry, $personalinfo, $uimage)
    {
        $fname = mysql_real_escape_string($fname);
        $lname = mysql_real_escape_string($lname);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        $dept = mysql_real_escape_string($dept);
        $email = mysql_real_escape_string($email);
        $phone = mysql_real_escape_string($phone);
        $dateofRegistry = mysql_real_escape_string($dateofRegistry);
        $personalinfo = mysql_real_escape_string($personalinfo);
        $uimage = mysql_real_escape_string($uimage);

        $sql2 = "SELECT bUserid FROM basicuser WHERE email= '$email' ";

        $alreadyUser = mysql_fetch_array(mysql_query($sql2));

        $response = $this->apiResponse;

        if ($alreadyUser === null || $alreadyUser === false)
        {

            $sql = "INSERT INTO basicuser VALUES (null, '$fname', '$lname', '$username', '$password', '$dept', '$email', '$phone', '$dateofRegistry', '$personalinfo', '$uimage')";

            mysql_query($sql);

            $rowsAffected = mysql_affected_rows();

            if ($rowsAffected == 1)
            {
                $response['result'] = 'SUCCESS';
                $response['messages'] = array('The user was registered successfully',
                    'key = ' . mysql_insert_id());
            }
            elseif ($rowsAffected == 0)
            {
                $response['result'] = 'FAILURE';
                $response['messages'] = array('The user was not created.');
            }
            else
            {
                $response['result'] = 'FAILURE';
                $response['messages'] = array('An unknown error has occurred.');
            }

            return $response;
        }
        else
        {
            //give an error saying an account is already associated with this email
            $response['result'] = 'FAILURE';
            $response['messages'] = array('There is already an account associated with this email address.');

            return $response;
        }
    }

    /*     * ******************************************** */

    //                      ITEM
    /*     * ******************************************** */



    /* adds an item to the database an item need to be added b4 a book or house can be made */
    public function additem($bUserId, $category, $uploadtime, $keyword, $image, $saletype)
    {

        $bUserId = mysql_real_escape_string($bUserId); //mysql_real_escape_string($bUserId);
        $category = mysql_real_escape_string($category);
        $uploadtime = date('Y-m-d H:i:s');
        $keyword = mysql_real_escape_string($keyword);
        $saletype = mysql_real_escape_string($saletype);
        $image = mysql_real_escape_string($image);
        $sql1 = "INSERT INTO item
               VALUES (null,'$bUserId','$category','$uploadtime','$saletype','$keyword','$image')";
        mysql_query($sql1);
    }

    public function edititem()
    {
        
    }

    /* remove item with a particual item id */

    public function rmitem($itemid)
    {
        $itemid = mysql_real_escape_string($itemid);
        $sql = "delete FROM item where itemid='$itemid'";
        mysql_query($sql);
    }

    /*     * ******************************************** */

    //                      BOOK
    /*     * ******************************************** */

    /* add a book to the database */
    public function addBook($title, $author, $publisher, $saletype, $published_date, $edition, $subjectarea, $condition, $askingprice, $description, $bUserId, $category, $uploadtime, $keyword, $image)
    {

        $title = mysql_real_escape_string($title);
        $author = mysql_real_escape_string($author);
        $publisher = mysql_real_escape_string($publisher);

        $saletype = mysql_real_escape_string($saletype);
        $published_date = mysql_real_escape_string($published_date);

        $edition = mysql_real_escape_string($edition);
        $subjectarea = mysql_real_escape_string($subjectarea);
        $condition = mysql_real_escape_string($condition);
        $description = mysql_real_escape_string($description);


        $saletype = mysql_real_escape_string($saletype);
        $askingprice = mysql_real_escape_string($askingprice);

        $bUserId = mysql_real_escape_string($bUserId); //mysql_real_escape_string($bUserId);
        $category = mysql_real_escape_string($category);
        $uploadtime = date('Y-m-d H:i:s');
        $keyword = mysql_real_escape_string($keyword);
        $image = mysql_real_escape_string($image);

        $api = new Api;
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

    /* update book information */

    public function editbook($itemid, $title, $author, $publisher, $published_date, $edition, $subjectarea, $condition, $saletype, $askingprice, $description)
    {
        $itemid = mysql_real_escape_string($itemid);
        $title = mysql_real_escape_string($title);
        $author = mysql_real_escape_string($author);
        $publisher = mysql_real_escape_string($publisher);
        $published_date = mysql_real_escape_string($published_date);
        $edition = mysql_real_escape_string($edition);
        $subjectarea = mysql_real_escape_string($subjectarea);
        $condition = mysql_real_escape_string($condition);
        $saletype = mysql_real_escape_string($saletype);
        $askingprice = mysql_real_escape_string($askingprice);
        $description = mysql_real_escape_string($description);

        $sql = "update book ('$itemid','$title','$author','$publisher', '$published_date','$edition','$subjectarea','$condition', '$saletype', '$askingprice', '$description') where itemid= '$itemid'";
        $result = mysql_query($sql);
        return $result;
    }

    /* remove book with a specific id */

    public function rmbook($itemid)
    {

        $api = new Api();
        $api->rmitem($itemid);
        $itemid = mysql_real_escape_string($itemid);
        $sql = "delete FROM book where itemid='$itemid'";
        mysql_query($sql);
    }

    /* retrieve all books that a specific user uploaded */

    public function getownerBooks($ownerid)
    {
        $sql2 = "SELECT * from book JOIN item on book.itemid= item.itemid where bUserid= '" . $ownerid . "'";
        $bookdetails = mysql_fetch_array(mysql_query($sql2));
        return $bookdetails;
    }

    /* selects all books in the database */

    public function listBooks()
    {
        //list all books in database
        $sql2 = "SELECT * FROM book";

        $result = mysql_query($sql2);

        $data = array();

        while ($row = mysql_fetch_assoc($result))
        {
            $data[] = $row;
        }

        $response = $this->apiResponse;

        if (!empty($data))
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('Data was retrieved successfully.');
            $response['data'] = $data;
        }
        else
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('There is no data to be displayed.');
            $response['data'] = $data;
        }

        return $response;
    }

    /*     * ******************************************** */

    //                      BID
    /*     * ******************************************** */

    /* add a new bid for an item by a specific user */
    public function addBid($itemid, $buserid, $bidamount)
    {
        $itemid     = mysql_real_escape_string($itemid);
        $buserid    = mysql_real_escape_string($buserid);
        $biddate    = date('Y-m-d 00:00:00');
        $bidtime    = time( '0000-00-00 H:i:s' );
        $bidamount  = mysql_real_escape_string($bidamount);

        $sql = "INSERT INTO bids VALUES(null, $itemid, $buserid, '$biddate', '$bidtime', $bidamount)";
        
        mysql_query($sql);

        $rowsAffected = mysql_affected_rows();
        
        $response = $this->apiResponse;

        if ($rowsAffected == 1)
        {
            $response['result']     = 'SUCCESS';
            $response['messages']   = array('Bid was added successfully.');
        }
        else
        {
            $response['result']     = 'FAILURE';
            $response['messages']   = array('The bid could not be added');
        }

        return $response;
    }

    /* FIND THE MAXIMUM BID FROM ALL bid history for a particular item */

    public function getMaxBidAmount($itemid)
    {
        //returns the max bid for an item
        $itemid = mysql_real_escape_string($itemid);

        $sql = "SELECT MAX(bidAmount) as maxBidAmount
                FROM bids
                WHERE itemid = '$itemid'";

        $result = mysql_query($sql);

        $data = array();

        while ($row = mysql_fetch_assoc($result))
        {
            $data = $row;

            break;
        }

        $response = $this->apiResponse;

        if (!empty($data))
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('Data was retrieved successfully.');
            $response['data'] = $data;
        }
        else
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('There is no data to be displayed.');
            $response['data'] = $data;
        }

        return $response;
    }

    /* search by userid or itemid or all to view bid history */

    public function viewBidHistory($searchby, $value)
    {
        //search by will take as input:
        //                               1 for search by userid;
        //                               2 for search by itemid;
        //                               3 for all
        // need to check in html to ensure that search is being passed the right values

        $search = "";

        $a = " WHERE bUserid = '$value' ";
        $b = " WHERE itemid = '$value' ";
        $c = " ";

        $search = ($searchby == 1) ? $a : ($searchby == 2) ? $b : $c;

        $value = mysql_real_escape_string($value);

        $sql = "SELECT *
                FROM bids 
                $search";

        $result = mysql_query($sql);

        $data = array();

        while ($row = mysql_fetch_assoc($result))
        {
            $data[] = $row;
        }

        $response = $this->apiResponse;

        if (!empty($data))
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('Data was retrieved successfully.');
            $response['data'] = $data;
        }
        else
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('There is no data to be displayed.');
            $response['data'] = $data;
        }

        return $response;
    }

    /*     * ******************************************** */

    //                      HOUSE
    /*     * ******************************************** */

    /* add house to database by first adding it as an item(foreign key constraint) */
    public function addhouse($itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description, $bUserId, $category, $saletype, $uploadtime, $keyword, $image)
    {
        $itemid = mysql_real_escape_string($itemid);
        $bedrooms = mysql_real_escape_string($bedrooms);
        $bathrooms = mysql_real_escape_string($bathrooms);
        $facilities = mysql_real_escape_string($facilities);
        $price = mysql_real_escape_string($price);
        $locatedNear = mysql_real_escape_string($locatedNear);
        $description = mysql_real_escape_string($description);

        $api = new Api();
        $api->additem($bUserId, $category, $saletype, $uploadtime, $keyword, $image);
        $sql = "INSERT INTO house VALUES( $itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description)";
        $result = mysql_query($sql);
        return $result;
    }

    /* edit house datails */

    public function edithouse($itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description)
    {
        $itemid = mysql_real_escape_string($itemid);
        $bedrooms = mysql_real_escape_string($bedrooms);
        $bathrooms = mysql_real_escape_string($bathrooms);
        $facilities = mysql_real_escape_string($facilities);
        $price = mysql_real_escape_string($price);
        $locatedNear = mysql_real_escape_string($locatedNear);
        $description = mysql_real_escape_string($description);

        $sql = "update house VALUES( $itemid, $bedrooms, $bathrooms, $facilities, $price, $locatedNear, $description)";
        $result = mysql_query($sql);
        return $result;
    }

    /* remove house with a particual item id */

    public function rmhouse($itemid)
    {
        $api = new Api();
        $api->rmitem($itemid);
        $itemid = mysql_real_escape_string($itemid);
        $sql = "delete FROM house where itemid='$itemid'";
        mysql_query($sql);
    }

    /* Get all house with specific item id */

    public function viewhouse($itemid)
    {

        $itemid = mysql_real_escape_string($itemid);
        $sql2 = "SELECT * from house 
                 WHERE itemid = '$itemid'";
        $housearray = mysql_fetch_array(mysql_query($sql2));
        $house = $housearray[0];
        return $house;
    }

    /*     * ******************************************** */

    //                      Recommender
    /*     * ******************************************** */
    public function recommender()
    {
        
    }

    /* selects specific book from the database */

    public function getBook($bookId)
    {
        $bookId = mysql_real_escape_string($bookId);

        //list all books in database
        $sql2 = "SELECT * FROM book WHERE itemid = '$bookId' ";

        $result = mysql_query($sql2);

        $data = array();

        while ($row = mysql_fetch_assoc($result))
        {
            $data = $row;

            break;
        }

        $response = $this->apiResponse;

        if (!empty($data))
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('Data was retrieved successfully.');
            $response['data'] = $data;
        }
        else
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('There is no data to be displayed.');
            $response['data'] = $data;
        }

        return $response;
    }

    public function getCurrentUserInfo()
    {
        $response = $this->apiResponse;
        
        if (isset($_SESSION['user_info']) && !empty($_SESSION['user_info']))
        {
            $response['result']     = 'SUCCESS';

            $response['data']       = $_SESSION['user_info'];

            $response['messages']   = array('Data was retrieved successfully.');
        }
        else
        {
            $response['result'] = 'FAILURE';

            $response['data'] = array();

            $response['messages'] = array('No user is logged in.');
        }

        return $response;
    }

}

