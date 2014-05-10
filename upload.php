<?php

include('/template/header.php');


if($_SERVER["REQUEST_METHOD"] == 'POST')
{

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
	&& ($_FILES["file"]["size"] < 200000)
	&& in_array($extension, $allowedExts)) {
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

				//initial query
				$query = "INSERT INTO pictures ( picName, categoryId, uploadedDate ) VALUES ( :picName, :catId, now() )";

				//Update query
				$query_params = array(
				':picName' => $newfilename,
				':catId' => '0',
				);

				//execute query
				try {
					$stmt   = $db->prepare($query);
					$result = $stmt->execute($query_params);
				}
				catch (PDOException $ex) {
					echo "ERROR with database...";
				}
			}
		}
	} 
	else 
	{
		echo "Invalid file";
	}
}
?>

	<form action="upload.php" method="post"
	    enctype="multipart/form-data">
	    <label for="file">Filename:</label>
	    <input type="file" name="file" id="file"><br>
	    <input type="submit" name="submit" value="Submit">
	</form>

<?php

include('/template/footer.php');

?>