
<?php

class Photos
{
    // property declaration
    public $var = 'a default value';
    private $db;

    public function __construct()
    {
    	//echo "Constructed..";
    	$this->dbCon();
    }

    private function dbCon()
    {
    	// These variables define the connection information for your MySQL database 
		$username = "root"; 
		$password = "password"; 
		$host = "localhost"; 
		$dbname = "piks_mobile"; 

		// UTF-8 is a character encoding scheme that allows you to conveniently store 
		// a wide varienty of special characters, like ¢ or €, in your database. 
		// By passing the following $options array to the database connection code we 
		// are telling the MySQL server that we want to communicate with it using UTF-8 
		// See Wikipedia for more information on UTF-8: 
		// http://en.wikipedia.org/wiki/UTF-8 
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
		 
		// A try/catch statement is a common method of error handling in object oriented code. 
		// First, PHP executes the code within the try block.  If at any time it encounters an 
		// error while executing that code, it stops immediately and jumps down to the 
		// catch block.  For more detailed information on exceptions and try/catch blocks: 
		// http://us2.php.net/manual/en/language.exceptions.php 
		try 
		{ 
		    // This statement opens a connection to your database using the PDO library 
		    // PDO is designed to provide a flexible interface between PHP and many 
		    // different types of database servers.  For more information on PDO: 
		    // http://us2.php.net/manual/en/class.pdo.php 
		    $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
		} 
		catch(PDOException $ex) 
		{ 
		    // If an error occurs while opening a connection to your database, it will 
		    // be trapped here.  The script will output an error and stop executing. 
		    // Note: On a production website, you should not output $ex->getMessage(). 
		    // It may provide an attacker with helpful information about your code 
		    // (like your database username and password). 
		    die("Failed to connect to the database: " . $ex->getMessage()); 
		} 
		 
		// This statement configures PDO to throw an exception when it encounters 
		// an error.  This allows us to use try/catch blocks to trap database errors. 
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		 
		// This statement configures PDO to return database rows from your database using an associative 
		// array.  This means the array will have string indexes, where the string value 
		// represents the name of the column in your database. 
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
		 
		// This block of code is used to undo magic quotes.  Magic quotes are a terrible 
		// feature that was removed from PHP as of PHP 5.4.  However, older installations 
		// of PHP may still have magic quotes enabled and this code is necessary to 
		// prevent them from causing problems.  For more information on magic quotes: 
		// http://php.net/manual/en/security.magicquotes.php 
		if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
		{ 
		    function undo_magic_quotes_gpc(&$array) 
		    { 
		        foreach($array as &$value) 
		        { 
		            if(is_array($value)) 
		            { 
		                undo_magic_quotes_gpc($value); 
		            } 
		            else 
		            { 
		                $value = stripslashes($value); 
		            } 
		        } 
		    } 
		 
		    undo_magic_quotes_gpc($_POST); 
		    undo_magic_quotes_gpc($_GET); 
		    undo_magic_quotes_gpc($_COOKIE); 
		} 
    }

    // Returns Photos
    public function getPhotos($page=0, $sort='week', $catId=None) {
        //Get images from database

		$limit = 3;
		$start = $page * $limit;

		switch($sort)
		{
			case 'day':
				$sortBy = 'DAY';
				break;
			case 'week':
				$sortBy = 'WEEK';
				break;
			default:
				$sortBy = 'WEEK';
				break;
		}

		if(empty($catId) || $catId == None)
		{
			//do nothing...
			$catQuery = "";
		}
		else
		{
			$catQuery = "AND (categoryID = " . $catId . ")";
		}

		$query = "SELECT * FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 $sortBy ) AND now() $catQuery ORDER BY uploadedDate DESC LIMIT $start , $limit";

		//execute query
		try {
		    $stmt = $this->db->prepare($query);
		    //$stmt->bindParam(':start', $start);
		    //$stmt->bindParam(':lim', $limit);

		    $result = $stmt->execute();
		    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    return $results;
		}
		catch (PDOException $ex) {
			echo 'ERROR: ' . $ex->getMessage();
		}
    }

    // Adds new images to database..
    public function addPhoto($newfilename, $catId)
    {
    	//initial query
		$query = "INSERT INTO pictures ( picName, categoryId, uploadedDate ) VALUES ( :picName, :catId, now() )";

		//Update query
		$query_params = array(
		':picName' => $newfilename,
		':catId' => $catId,
		);

		//execute query
		try {
			$stmt   = $this->db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch (PDOException $ex) {
			echo "ERROR with database...";
		}
    }

    public function getPhotoCategories()
    {
    	//Get the options from the database...
		$query = "SELECT * FROM categories ORDER BY categoryName ASC";
		//execute query
		try {
		    $stmt   = $this->db->prepare($query);
		    $result = $stmt->execute();

		    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    		return $results;
		}
		catch (PDOException $ex) {
			echo 'ERROR: ' . $ex->getMessage();
		}
	}
}
?>
