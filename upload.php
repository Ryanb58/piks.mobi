<?php

include('/template/header.php');

?>
<?php

/*
	Handle the file upload...
*/

if($_SERVER["REQUEST_METHOD"] == 'POST')
{
	if(empty($_POST["categoryId"]))
	{
		echo "Empty...";
	}
	else
	{
		echo $_POST["categoryId"];		
	}

	
	$rootUploadFolder = "uploads/";

	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 2000000)
		&& in_array($extension, $allowedExts)) 
	{
		if ($_FILES["file"]["error"] > 0) 
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		} 
		else 
		{

			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			//Get the file's new name.
			$filename = $_FILES["file"]["name"];
			$extension = end(explode(".", $filename));
			$newfilename= md5_file($_FILES["file"]["tmp_name"]) . "." . $extension;

			if (file_exists($rootUploadFolder . $newfilename)) 
			{
				echo $newfilename . " already exists. ";
			} 
			else 
			{
				//print "New File Name : " . $newfilename;

				move_uploaded_file($_FILES["file"]["tmp_name"], $rootUploadFolder . $newfilename);
				echo "Stored in: " . $rootUploadFolder . $_FILES["file"]["name"];

				//print "Uploaded MD5: " . md5_file($rootUploadFolder . $_FILES["file"]["name"]);

				$photos = new Photos();
				$photos->addPhoto($newfilename, $_POST["categoryId"]);
			}
		}
	} 
	else 
	{
		echo "Invalid file";
	}
	
}
?>
	
	<form action="upload.php" method="post" enctype="multipart/form-data">
	    
	    <select name="categoryId" class="form-control" >
	    
		<?php
		//Get the options from the database...
			$query = "SELECT * FROM categories ORDER BY categoryName ASC";
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
			    <option value="<?php print $row['categoryId']; ?>"><?php print $row['categoryName']; ?></option>
			    <?php
			}
		?>
		</select>
	    
	    <br>
	    
	    
	    <div class="fileUpload btn btn-primary">
		<span>Upload</span>
		<input type="file" name ="file" class="upload" />
	    </div>
	    <br>
	    <input type="button" class="btn btn-default" name="submit" value="Submit">
	</form>
	

<?php

include('/template/footer.php');

?>