<?php


include('/template/header.php');

?>

<?php
if(!isset($_SESSION)){
	session_start();
}
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$query = "Update votes SET upVotes=upVotes+1 WHERE voteID = $id";
		try {
		    $stmt2   = $db->prepare($query);
		    //$stmt->bindParam(':start', $start);
		    //$stmt->bindParam(':lim', $limit);

		    $result = $stmt2->execute();
		}
		catch (PDOException $ex) {
			echo 'ERROR: ' . $ex->getMessage();
		}



	}
	
	//Get the total count of pics taken in last week... blablabla
	$query = "SELECT COUNT(*) FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 WEEK ) AND now() ORDER BY uploadedDate DESC";
	//execute query
	try {
	    $stmt   = $db->prepare($query);
	    //$stmt->bindParam(':start', $start);
	    //$stmt->bindParam(':lim', $limit);

	    $result = $stmt->execute();
	    $maxCount = $stmt->fetch()['COUNT(*)'];
	    //print "max: " . $maxCount . "\n";
	}
	catch (PDOException $ex) {
		echo 'ERROR: ' . $ex->getMessage();
	}


	//Get the total count of pics taken in last week... blablabla
	$query = "SELECT COUNT(*) FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 WEEK ) AND now() ORDER BY uploadedDate DESC";
	//execute query
	try {
	    $stmt   = $db->prepare($query);
	    //$stmt->bindParam(':start', $start);
	    //$stmt->bindParam(':lim', $limit);

	    $result = $stmt->execute();
	    $maxCount = $stmt->fetch()['COUNT(*)'];
	    //print "max: " . $maxCount . "\n";
	}
	catch (PDOException $ex) {
		echo 'ERROR: ' . $ex->getMessage();
	}


	if(isset($_SESSION['views']))
	{
		$_SESSION['views'] = ($_SESSION['views'] + 1) % $maxCount;	
	}
	else
	{
		$_SESSION['views'] = 0;
	}

	//print "SESSION: " . $_SESSION['views'] . "\n";


	$counter = $_SESSION['views'];
	//print "Counter: " . $counter . "\n";

	$query = "SELECT * FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 WEEK ) AND now() ORDER BY ID DESC LIMIT $counter, 1";
	$counter+=1;
	//execute query
	try {
	    $stmt   = $db->prepare($query);
	    //$stmt->bindParam(':start', $start);
	    //$stmt->bindParam(':lim', $limit);

	    $result = $stmt->execute();
	}
	catch (PDOException $ex) {
		echo 'ERROR: ' . $ex->getMessage();
	}



	//Fetch each row invidually...
	while($row = $stmt->fetch()) {
<<<<<<< HEAD
=======
	    //print_r($row);
	    //print_r($query);
            
            $id = $row['ID'];
            if(isset($_POST[$id])){

				$query = "Update votes SET upVotes=upVotes+1 WHERE voteID = $id";
				try {
				    $stmt2   = $db->prepare($query);
				    //$stmt->bindParam(':start', $start);
				    //$stmt->bindParam(':lim', $limit);

				    $result = $stmt2->execute();
				}
				catch (PDOException $ex) {
					echo 'ERROR: ' . $ex->getMessage();
				}


    
    		}


                
>>>>>>> 1fc1b96822a244c8a82d73c57a4f01f8cf946f63
            
        $id = $row['ID'];
                  
	    ?>
	    	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
                    <form action="vote.php" method="post" id="picture">
                    	<input type="submit" class="btn btn-default" name="id" value="Upvote" />
                    	<input type="hidden" name="id" value="<?php echo $id;?>" />
                    </form>
				<p> Upvotes: 1000 -- Downvotes: 20 </p>
			</section>
	    <?php
	}



?>	



<?php

include('/template/footer.php');
?>
