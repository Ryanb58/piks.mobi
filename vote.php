<?php


include('/template/header.php');

?>

<?php
if(!isset($_SESSION)){
	session_start();
}

	
	if(isset($_SESSION['views']))
	{
		$_SESSION['views'] = $_SESSION['views'] + 1;
	}
	else
	{
		$_SESSION['views'] = 0;
	}

	$counter = $_SESSION['views'];

	$query = "SELECT * FROM pictures ORDER BY ID DESC LIMIT $counter, 1";
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
	    print_r($row);
	    print_r($query);
            
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


                
            
	    ?>
	    	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
                                <form action="vote.php" method="post" id="picture">
                                <input type="submit" class="btn btn-default" name="<?php print $id;?>" value="Upvote">
                                </form>
				<p> Upvotes: 1000 -- Downvotes: 20 </p>
			</section>
	    <?php
	}



?>	



<?php

include('/template/footer.php');
?>

	