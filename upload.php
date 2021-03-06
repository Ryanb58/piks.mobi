<?php

include('/template/header.php');

?>



<div id="uploadForm" class="container">
<?php

/*
	Handle the file upload...
*/

if($_SERVER["REQUEST_METHOD"] == 'POST')
{

	$authorEmail = trim($_POST['email']);
	
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
		&& ($_FILES["file"]["size"] < 4000000)
		&& in_array($extension, $allowedExts)) 
	{
		if ($_FILES["file"]["error"] > 0) 
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		} 
		else 
		{

			//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			//cho "Type: " . $_FILES["file"]["type"] . "<br>";
			//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
			print '<div class="alert alert-success"><strong>Well done!</strong> Your upload has completed.</div>';

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
				//echo "Stored in: " . $rootUploadFolder . $_FILES["file"]["name"];

				//print "Uploaded MD5: " . md5_file($rootUploadFolder . $_FILES["file"]["name"]);

				$photos = new Photos();
				$photos->addPhoto($newfilename, $_POST["categoryId"], $authorEmail);
			}
		}
	} 
	else 
	{
		echo "Invalid file";
	}
	
}
?>

<form role="form" action="upload.php" method="post" enctype="multipart/form-data">

	<div id="upFormLeft">
		
	    

		
		<input id="file" type="file" name ="file" class="upload" />

		<br />


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
	</div>

	<div id="upFormRight">
		


		<div class="form-group">
		    <label>Email</label>
		    <input type="email" name="email" class="form-control" id="exampleemail" placeholder="Email">
	    </div>
	    <input type="submit" class="btn btn-default btnUpload" name="submit" value="Submit">

	</div>

	    
	
	</form>

	<p style="text-align:left;font-size:11px;clear:both;padding-top:10px;">
		<strong>*</strong> Giving your email is completely optional. If you do not own this work or just want to stay annonomus, then don't! However, if you are the creator or just want to be known as the contact for this email, provide away! CAUTION: This will make your email publically available. Please contact "mod[at]piks.mobi" for any help.
	</p>
</div>

<?php

include('/template/footer.php');

?>