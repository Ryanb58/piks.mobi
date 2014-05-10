<?php

include('/template/header.php');

$page = 0;

if(isset($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = 0;
}

$limit = 1;
$start = $page * $limit;

	$query = "SELECT * FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 WEEK) AND now() ORDER BY uploadedDate DESC LIMIT $start , $limit";
	
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

        ?>
        	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
				<p> Upvotes: 1000 -- Downvotes: 20 </p>
			</section>
        <?php
    }

include('/template/footer.php');
?>

	