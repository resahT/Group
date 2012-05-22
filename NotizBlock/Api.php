<?php

@session_start();

class Api
{
    /*
      Functions in API:

      Have:
      login($username, $password)
      logout()
      registerUser($firstName, $lastName,$password,$email,$phone,$personalinfo)
      listItem()
      viewBidHistory()
      getMaxBid()
      addBid($itemid, $buserid, $bidamount)
      getCurrentUserInfo()
        

      addBook($title, $author,$publisher,$saletype,$published_date,$edition,$subjectarea,$condition,$askingprice, $description,$bUserId)
      addItem($category, $keyword, $image)
      addUpload($itemId, $bUserId, $saletype, $uploaddate, $uploadtime)
      
      addItemsViewed($itemid, $bUserid)
      buyItem($bUserid, $itemId, $itemType, $askingPrice)
      changeUploadState($itemId, $state = 'SOLD)
     
      getownerBooks($ownerid)
      

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
        @mysql_close($this->connection);
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

    /*     * ******************************************** */

    //                      ITEM
    /*     * ******************************************** */



    /* adds an item to the database an item need to be added b4 a book or house can be made */
    public function addItem($category, $keyword, $image)
    {

        $category   = mysql_real_escape_string($category);
        $keyword    = mysql_real_escape_string($keyword);
        $image      = mysql_real_escape_string($image);
        
        $sql       = " INSERT INTO item
                        VALUES (null, '$category', '$keyword', '$image')";
        
        mysql_query($sql);
        
        $rowsAffected = mysql_affected_rows();

        if ($rowsAffected == 1)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The item was created successfully',
                'key = ' . mysql_insert_id());

            $response['data']['itemid'] = mysql_insert_id();
        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('The item was not created.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }

        return $response;
                
        
    }

    public function editItem($itemId, $category, $keyword, $image)
    {
        $itemId     = mysql_real_escape_string($itemId);
        $category   = mysql_real_escape_string($category);
        $keyword    = mysql_real_escape_string($keyword);
        $image      = mysql_real_escape_string($image);
        
        $sql        = " UPDATE `notizblock`.`item` 
                        SET 
                            `category` = '$category',
                            `keyword` = '$keyword' 
                        WHERE `item`.`itemid` = $itemId";
        
        mysql_query($sql);
                
        $rowsAffected = mysql_affected_rows();

        if ($rowsAffected == 1)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The item was not updated successfully');
        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The item was not updated.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }

        return $response;
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
    public function addBook($title, $author, $publisher, $saletype, $publishedDate, $edition, $subjectarea, $condition, $askingprice, $description, $bUserId, $category, $uploadtime, $keyword, $image)
    {
        $title = mysql_real_escape_string($title);
        $author = mysql_real_escape_string($author);
        $publisher = mysql_real_escape_string($publisher);

        $saletype = mysql_real_escape_string($saletype);
        $publishedDate = mysql_real_escape_string($publishedDate);

        $edition = mysql_real_escape_string($edition);
        $subjectarea = mysql_real_escape_string($subjectarea);
        $condition = mysql_real_escape_string($condition);
        $description = mysql_real_escape_string($description);


        $saletype = mysql_real_escape_string($saletype);
        $askingprice = mysql_real_escape_string($askingprice);

        $bUserId = mysql_real_escape_string($bUserId); //mysql_real_escape_string($bUserId);
        $category = mysql_real_escape_string($category);
        $uploaddate = date('Y-m-d');
        $uploadtime = date('Y-m-d H:i:s');
        $keyword = mysql_real_escape_string($keyword);
        $image = mysql_real_escape_string($image);

        $api = new Api;
        
        $addItemResult = $api->addItem($category, $keyword, $image);
        
        if($addItemResult['result'] == 'SUCCESS')
        {
            $itemId = $addItemResult['data']['itemid'];
            
            $addUploadResult = $api->addUpload($itemId, $bUserId, $saletype, $uploaddate, $uploadtime); //assume the upload was added successfully, temporarily
            
            $sql = "   INSERT INTO book 
                       VALUES  ('$itemId','$title','$author','$publisher',
                                '$publishedDate','$edition',
                                '$subjectarea','$condition',
                                '$description')";
            
            mysql_query($sql);
            
            $rowsAffected = mysql_affected_rows();
        
            $response = $this->apiResponse;

            if ($rowsAffected == 1)
            {
                $response['result']     = 'SUCCESS';
                $response['messages']   = array('Book was added successfully.');
            }
            else
            {
                $response['result']     = 'FAILURE';
                $response['messages']   = array('The book could not be added');
            }

            return $response;
        }
        else
        {
            $response = $this->apiResponse;
            
            $response['result']     = 'FAILURE';
            $response['messages']   = array('The item could not be added.');
        }
        
        return $response;
    }

    /* update book information */
    public function bck_editbook($itemid, $title, $author, $publisher, $published_date, $edition, $subjectarea, $condition, $saletype, $askingprice, $description)
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
    
    public function editBook($itemId, $title, $author, $publisher, $saletype, $publishedDate, $edition, $subjectarea, $condition, $askingprice, $description, $bUserId, $category, $uploadtime, $keyword, $image)
    {
        $title = mysql_real_escape_string($title);
        $author = mysql_real_escape_string($author);
        $publisher = mysql_real_escape_string($publisher);

        $saletype = mysql_real_escape_string($saletype);
        $publishedDate = mysql_real_escape_string($publishedDate);

        $edition = mysql_real_escape_string($edition);
        $subjectarea = mysql_real_escape_string($subjectarea);
        $condition = mysql_real_escape_string($condition);
        $description = mysql_real_escape_string($description);

        $saletype = mysql_real_escape_string($saletype);
        $askingprice = mysql_real_escape_string($askingprice);

        $bUserId = mysql_real_escape_string($bUserId); //mysql_real_escape_string($bUserId);
        $category = mysql_real_escape_string($category);
        $uploaddate = date('Y-m-d');
        $uploadtime = date('Y-m-d H:i:s');
        $keyword = mysql_real_escape_string($keyword);
        $image = mysql_real_escape_string($image);

        $api = new Api();
        
        $editItemResult = $api->editItem($itemId, $category, $keyword, $image);
        
        if($editItemResult['result'] == 'SUCCESS')
        {
//            $itemId = $editItemResult['data']['itemid'];
            
            $editUploadResult = $api->editUpload($itemId, $bUserId, $saletype, $askingPrice = 0, $uploaddate, $uploadtime); //assume the upload was added successfully, temporarily
                        
            $sql = "    UPDATE `notizblock`.`book` 
                        SET 
                            `title` = '$title',
                            `author` = '$author',
                            `publisher` = '$publisher',
                            `pubYear` = '$publishedDate',
                            `edition` = '$edition',
                            `subarea` = '$subjectarea',
                            `cond` = '$condition',
                            `description` = '$description' 
                        WHERE `book`.`itemid` = $itemId;";
            
            mysql_query($sql);
            
            $rowsAffected = mysql_affected_rows();
        
            $response = $this->apiResponse;

            if ($rowsAffected == 1)
            {
                $response['result']     = 'SUCCESS';
                $response['messages']   = array('Book was updated successfully.');
            }
            else
            {
                $response['result']     = 'FAILURE';
                $response['messages']   = array('The book could not be updated');
            }

            return $response;
        }
        else
        {
            $response = $this->apiResponse;
            
            $response['result']     = 'FAILURE';
            $response['messages']   = array('The item could not be updated.');
        }
        
        return $response;
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

    
    
    public function getItem($itemId, $itemtable)
    {
        $itemId = mysql_real_escape_string(strtolower($itemId));
        $itemtable = mysql_real_escape_string(strtolower($itemtable));
        
        /*get an item with an id form a table*/
        $sql2 = "   SELECT * FROM item 
                    JOIN $itemtable on item.itemid = $itemtable.itemid 
                    JOIN upload on upload.itemid = $itemtable.itemid 
                    WHERE item.itemid = $itemId ";
        
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
        $api->addItem($category, $keyword, $image);
        
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

    /*     * ******************************************** */

    //                      UPLOAD
    /*     * ******************************************** */

    
    public function addUpload($itemId, $bUserId, $saletype, $uploaddate, $uploadtime)
    {        
        $itemId         = mysql_real_escape_string($itemId);
        $bUserId        = mysql_real_escape_string($bUserId);
        $saletype       = mysql_real_escape_string($saletype);
        $uploaddate     = mysql_real_escape_string($uploaddate);
        $uploadtime     = mysql_real_escape_string($uploadtime);
        
        $sql       = " INSERT INTO upload
                        VALUES ('$itemId', '$bUserId', '$saletype', '$uploaddate', '$uploadtime')";
        
        mysql_query($sql);
        
        $rowsAffected = mysql_affected_rows();

        if ($rowsAffected == 1)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The upload was created successfully',
                'key = ' . mysql_insert_id());

            $response['data']['itemid'] = mysql_insert_id();
        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('The upload was not created.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }
        
        return $response;        
    }
    
    /* selects all books in the database */

    public function listItem($item)
    {
        $item = strtolower($item);
        $item = mysql_real_escape_string($item);
        
        if($item=='book'||$item=='house'){
            
            //list all books in database
            $sql2 = "SELECT *
                     FROM item 
                     JOIN $item ON item.itemid = $item.itemid
                     JOIN upload ON item.itemid = upload.itemid
                     WHERE upload.uploadstate = 'AVAILABLE' ";

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
                $response['result'] = 'FAILURE';
                $response['messages'] = array('There is no data to be displayed.');
                $response['data'] = $data;
            }
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('There is no data to be displayed.');
            $response['data'] = $data;
        }
        
        return $response;
    }
    
    public function changeUploadState($itemId, $state = 'SOLD')
    {
        $itemId             = mysql_real_escape_string($itemId);
        $state              = mysql_real_escape_string($state);
        
        $sql                = " UPDATE `notizblock`.`upload` 
                                SET `state` = '$state' 
                                WHERE `upload`.`itemid` = '$itemId' ";
        
        mysql_query($sql);
        
        $rowsAffected = mysql_affected_rows();

        if ($rowsAffected == 1)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The the state was changed successfully.');
        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('The state was not changed.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }
        
        return $response;        
    }
    
    public function buyItem($bUserid, $itemId, $itemType, $askingPrice)
    {
        $bUserid            = mysql_real_escape_string($bUserid);
        $itemId             = mysql_real_escape_string($itemId);
        $itemType           = mysql_real_escape_string($itemType);
        $askingPrice        = mysql_real_escape_string($askingPrice);
        
        $buyDate            = date('Y-m-d');
        
        $sql                = " INSERT INTO `notizblock`.`buy`
                                (`purchaseid`, `itemid`, `bUserid`, `itemPrice`, `buyDate`, `buyTime`) 
                                VALUES  (NULL, '$itemId', '$bUserid', '$askingPrice', '$buyDate', CURRENT_TIMESTAMP);";
        
        mysql_query($sql);
        
        $rowsAffected = mysql_affected_rows();
        
        if ($rowsAffected == 1)
        {
            
            $this->changeUploadState($itemId, 'SOLD');
            
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The the purchase was made successfully.',
                'key = ' . mysql_insert_id());
        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('The purchase was not made.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }
        
        return $response;
    }
    
    public function addItemsViewed($itemid, $bUserid)
    {
        $itemid     = mysql_real_escape_string($itemid);
        $bUserid    = mysql_real_escape_string($bUserid);
        
        $dateViewed    = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `notizblock`.`itemsviewed` 
                        (`itemsviewedid`, `bUserid`, `itemid`, `dateViewed`) 
                VALUES (NULL, '$bUserid', '$itemid', '$dateViewed');";
        
        mysql_query($sql);

        $rowsAffected = mysql_affected_rows();
        
        $response = $this->apiResponse;

        if ($rowsAffected == 1)
        {
            $response['result']     = 'SUCCESS';
            $response['messages']   = array('Item viewed was added successfully.');
        }
        else
        {
            $response['result']     = 'FAILURE';
            $response['messages']   = array('The viewed item could not be added');
        }

        return $response;
    }
    
    public function getRecommendedItems($bUserid, $itemtable, $currentItem = null)
    {
        $currentItem    = mysql_real_escape_string($currentItem);
        $bUserid        = mysql_real_escape_string($bUserid);
        
        $itemtable      = strtolower($itemtable);
        
        if($itemtable == 'book')
        {                    
            //The sql query will select items that 
            //  1) have similar subject areas as recently viewed items
            //  2) have similar keywords as recently viewed items
            //  3) have not been bought by the user
            //
            //more intelligence may be added
            
            
            $sql = "    SELECT * FROM item 
                        JOIN $itemtable on item.itemid = $itemtable.itemid 
                        JOIN upload on upload.itemid = $itemtable.itemid 
                        
                        WHERE 
                        (
                            subarea IN (SELECT subarea 
                                        FROM itemsviewed 
                                        JOIN book ON itemsviewed.itemid = book.itemid 
                                        WHERE itemsviewed.bUserid = $bUserid
                                        ORDER BY itemsviewedid DESC)
                            OR
                            keyword IN (SELECT keyword 
                                        FROM itemsviewed 
                                        JOIN book ON itemsviewed.itemid = book.itemid 
                                        WHERE itemsviewed.bUserid = $bUserid
                                        ORDER BY itemsviewedid DESC )
                        )
                        AND
                        (
                            item.itemid NOT IN (SELECT itemid
                                            FROM buy
                                            WHERE buy.bUserid = $bUserid)
                            AND 
                            upload.uploadstate = 'AVAILABLE'

                        )

                        LIMIT 10";
            
            
            
        }
        else
        {
            //The query below should be modified to do something similar to 
            //what the above does
            $sql = "    SELECT * FROM item 
                        JOIN $itemtable on item.itemid = $itemtable.itemid 
                        JOIN upload on upload.itemid = $itemtable.itemid  
                        LIMIT 10";
        }
        
        $result = mysql_query($sql);
        
        $data = array();

        while ($row = @mysql_fetch_assoc($result))
        {
            $data[] = $row;
        }
        
        $response = $this->apiResponse;

        if (!empty($data))
        {
            $response['result']     = 'SUCCESS';
            $response['messages']   = array('Recommended items identified successfully.');
            $response['data']       = $data;
        }
        else
        {
            $response['result']     = 'FAILURE';
            $response['messages']   = array('No recommended items could be found');
            $response['data']       = array();
        }

        return $response;
    }
    
    public function editUpload($itemId, $bUserId, $saletype, $askingPrice, $uploaddate, $uploadtime)
    {        
        $itemId         = mysql_real_escape_string($itemId);
        $bUserId        = mysql_real_escape_string($bUserId);
        $askingPrice    = mysql_real_escape_string($askingPrice);
        $saletype       = mysql_real_escape_string($saletype);
        $uploaddate     = mysql_real_escape_string($uploaddate);
        $uploadtime     = mysql_real_escape_string($uploadtime);
                
        $sql        = "  UPDATE `notizblock`.`upload` 
                         SET `bUserid` = '$bUserId',
                            `saleType` = '$saletype',
                            `askingPrice` = '$askingPrice',
                            `uploadDate` = '$uploaddate',
                            `uploadTime` = '$uploadtime'
                         WHERE `upload`.`itemid` = $itemId;";

        mysql_query($sql);
        
        $rowsAffected = mysql_affected_rows();

        if ($rowsAffected == 1)
        {
            $response['result'] = 'SUCCESS';
            $response['messages'] = array('The upload was updated successfully');

        }
        elseif ($rowsAffected == 0)
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('The upload was not updated.');
        }
        else
        {
            $response['result'] = 'FAILURE';
            $response['messages'] = array('An unknown error has occurred.');
        }
        
        return $response;        
    }
}

