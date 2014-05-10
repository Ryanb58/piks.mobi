<?php

include('/template/header.php');

?>



<!-- Nav tabs -->
<ul id="tabs" class="nav nav-tabs">
	<li><a href="?sort=day">Day</a></li>
	<li><a href="?sort=week">Week</a></li>
<!--
	<li><a href="#" data-toggle="tab">Month</a></li>
	<li><a href="#" data-toggle="tab">Year</a></li>
	<li><a href="#" data-toggle="tab">All</a></li>
-->
</ul>
<?php

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

	if(isset($_GET['sort']))
	{
		$policy = strtolower(mysql_real_escape_string($_GET['sort']));
	}
	else
	{
		$policy = 'week';
	}

	switch($policy)
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

	$query = "SELECT * FROM pictures WHERE uploadedDate BETWEEN date_sub(now(),INTERVAL 1 $sortBy) AND now() ORDER BY uploadedDate DESC LIMIT $start , $limit";

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

	    ?>
	    	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
				<p> Upvotes: 1000 -- Downvotes: 20 </p>
			</section>
	    <?php
	}

?>	

<?php

include('/template/footer.php');
?>

	