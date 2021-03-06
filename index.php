<?php

include('/template/header.php');

//Init Photos
$photos = new Photos();

?>


<!-- Nav tabs -->
<ul id="tabs" class="nav nav-tabs">
	<li><a href="?sort=day">Day</a></li>
	<li><a href="?sort=week">Week</a></li>
	<li class="dropdown">
    	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Category:<span class="caret"></span></a>
    	<ul class="dropdown-menu">
			<?php
				$results = $photos->getPhotoCategories();
				//Fetch each row invidually...
				foreach($results as $row)
				{
					?>
				    <li id="cat<?php print $row['categoryId']; ?>"><a href="?cat=<?php print $row['categoryId']; ?>"><?php print $row['categoryName']; ?></a></li>
				    <?php
				}
			?>
    	</ul>
  	</li>
</ul>
<?php
	

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

	if(isset($_GET['cat']))
	{
		$cat = $_GET['cat'];
	}
	else
	{
		$cat = null;
	}


	$results = $photos->getPhotos($page, $policy, $cat);

	//var_dump($results);

	//Fetch each row invidually...
	foreach($results as $row)
	{
	    //print_r($row);
	    //print_r($query);
	    ?>
	    	<section>
				<img src="uploads/<?php print $row['picName']; ?>" class="mainImg" />
				<p> Ups: <?php print $row['upVotes']; ?> -- Downs: <?php print $row['downVotes']; ?></p>
				<p>
				<?php
				if(!empty($row['authorEmail'])){
				?>
					<a href="mailto:<?php print $row['authorEmail']; ?>"><img src="imgs/icon_email.png" style="width:30px;height:30px"/></a> 
				<?php } ?>
				</p>
			</section>
	    <?php
	}

?>	


<?php

//Get the current page(if one).. if page = 0 or null then disable newer button... Else enable it.. 

$queryNext = $_GET;
$queryPrev = $_GET;

if(isset($queryNext['page']))
{
	foreach($queryNext as $key => $value)
	{
		if($key == 'page')
		{
			if($value-1 == -1)
			{
				$queryNext[$key] = "#";
				$disabled = "disabled";
			}
			else
			{
				$queryNext[$key] = $value-1;
				$disabled = "";
			}

		}
	}

	foreach($queryPrev as $key => $value)
	{
		if($key == 'page')
		{
			$queryPrev[$key] = $value+1;
		}
	}
}
else
{
	$queryNext['page'] = '#';
	$queryPrev['page'] = '1';
}
?>


<ul class="pager">
  <li class="previous"><a href="?<?php print http_build_query($queryPrev);; ?>">&larr; Older</a></li>
  <li class="next <?php print $disabled; ?>"><a href="?<?php print http_build_query($queryNext);; ?>">Newer &rarr;</a></li>
</ul>


<?php

include('/template/footer.php');
?>

	