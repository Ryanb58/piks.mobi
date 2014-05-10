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
	//Init Photos
	$photos = new Photos();

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 0;
	}

	if(isset($_GET['sort']))
	{
		$policy = strtolower(mysql_real_escape_string($_GET['sort']));
	}
	else
	{
		$policy = 'week';
	}

	$results = $photos->getPhotos($page, $policy);

	//var_dump($results);

	//Fetch each row invidually...
	foreach($results as $row)
	{
	    //print_r($row);
	    //print_r($query);
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
if(!isset($_GET['page']) || $_GET['page'] == 0)
{
	$disabled = "disabled";
	$previousPage = 1;
	if(isset($prevURL))
	{
		$prevURL = $prevURL . $tag . "page=" . $previousPage;
	}
	else
	{
		$prevURL = $tag . "page=" . $previousPage;
	}
}
else
{
	$disabled = "";
	$previousPage = $_GET['page'] + 1;
	$nextPage = $_GET['page'] - 1;

	if(isset($prevURL))
	{
		$prevURL = $prevURL . $tag . "page=" . $previousPage;
	}
	else
	{
		$prevURL = $tag . "page=" . $previousPage;
	}

	if(isset($nextURL))
	{
		$nextURL = $nextURL . $tag . "page=" . $nextPage;
	}
	else
	{
		$nextURL = $tag . "page=" . $nextPage;
	}
}

?>

<ul class="pager">
  <li class="previous"><a href="<?php print $prevURL; ?>">&larr; Older</a></li>
  <li class="next <?php print $disabled; ?>"><a href="<?php print $nextURL; ?>">Newer &rarr;</a></li>
</ul>


<?php

include('/template/footer.php');
?>

	