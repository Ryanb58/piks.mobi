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

	$limit = 3;
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

//Get the current page(if one).. if page = 0 or null then disable newer button... Else enable it.. 

$tag = '?';
if(isset($_GET['sort']))
{
	$prevURL = "?sort=" . $_GET['sort'];
	$nextURL = "?sort=" . $_GET['sort'];
	$tag = '&';
}
if(!isset($_GET['page']))
{
	$disabled = "disabled";
	$previousPage = 1;
	$prevURL = $prevURL . $tag . "page=" . $previousPage;
}
else
{
	$disabled = "";
	$previousPage = $_GET['page'] + 1;
	$nextPage = $_GET['page'] - 1;

	$prevURL = $prevURL . $tag . "page=" . $previousPage;
	$nextURL = $nextURL . $tag . "page=" . $nextPage;
}

?>

<ul class="pager">
  <li class="previous"><a href="<?php print $prevURL; ?>">&larr; Older</a></li>
  <li class="next <?php print $disabled; ?>"><a href="<?php print $nextURL; ?>">Newer &rarr;</a></li>
</ul>


<?php

include('/template/footer.php');
?>

	