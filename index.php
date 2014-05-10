<?php

include('/template/header.php');

	$query = "SELECT * FROM pictures";
	
	//execute query
	try {
	    $stmt   = $db->prepare($query);
	    $result = $stmt->execute();
	}
	catch (PDOException $ex) {
		echo 'ERROR: ' . $ex->getMessage();
	}
	
	//Fetch each row invidually...
	while($row = $stmt->fetch()) {
        print_r($row);

        ?>
        	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
				<p> Upvotes: 1000 -- Downvotes: 20 </p>
			</section>
        <?php
    }

include('/template/footer.php');
?>

	