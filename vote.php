<?php
require_once("config.inc.php");

$query = "SELECT * FROM pictures WHERE uploadedDate between date_sub(now(),INTERVAL 1 WEEK) and now()"




//initial query
if (isset($_POST['send'])) {
    $query = "UPDATE votes set upvotes = upvotes+1 WHERE  ( picName, categoryId ) VALUES ( :picName, :catId ) ";

}
?>


<!DOCTYPE html>
<html>
<body>



	<form action="upload.php" method="post"
	    <button type="button" name="send">Submit</button>
	</form>
 
</body>
</html>