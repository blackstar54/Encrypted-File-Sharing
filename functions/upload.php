<?php
require_once('../includes/config.php');

 // create new directory with 744 permissions if it does not exist yet
 // owner will be the user/group the PHP script is run under
 if (!file_exists($uploads_dir)) {
    mkdir ($uploads_dir, 0744);
}

$io = popen ( '/usr/bin/du -sk ' . $uploads_dir, 'r' );
$size = fgets ( $io, 4096);
$size = substr ( $size, 0, strpos ( $size, "\t" ) );
pclose ( $io );

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

error_reporting(0);
ini_set("display_errors", 0);

//Include the library
require_once '../lib/AESCryptFileLib.php';

//Include an AES256 Implementation
require_once '../lib/aes256/MCryptAES256Implementation.php';

//Construct the implementation
$mcrypt = new MCryptAES256Implementation();

//Use this to instantiate the encryption library class
$lib = new AESCryptFileLib($mcrypt);

//syadsasd

$target_dir = "../uploads/";
$pass = generateRandomString(64);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ext = pathinfo($target_file, PATHINFO_EXTENSION);
$unique_hash = generateRandomString(128);
$encrypted_file = $target_dir . "$unique_hash.$ext.aes";

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) { ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAIL!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<form action="functions/upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<article class="message is-danger">
			  <div class="message-header">
				<p>Fail</p>
			  </div>
			  <div class="message-body">
				The file was too big to upload. (MAX 500 MB)
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>

<?php die(); }

if ($per == 100) { ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAIL!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<form action="functions/upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<article class="message is-danger">
			  <div class="message-header">
				<p>Fail</p>
			  </div>
			  <div class="message-body">
				The container is now full. Please wait until the next wipe!
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html> <?php die(); } 
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) { ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAIL!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<form action="functions/upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<article class="message is-danger">
			  <div class="message-header">
				<p>Fail</p>
			  </div>
			  <div class="message-body">
				Unknown Error
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>
<?php } else {
	@unlink($encrypted_file);
    if ($lib->encryptFile($_FILES["fileToUpload"]["tmp_name"], $pass, $encrypted_file)) { ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YAY!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<form action="functions/upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<article class="message is-success">
			  <div class="message-header">
				<p>Success</p>
			  </div>
			  <div class="message-body">
				Direct link to download: <pre>https://flout.is/download.php?hash=<?php echo $unique_hash; ?>&dec_key=<?php echo $pass; ?></pre><br>
				<strong>OR</strong><br>
				Link to download page: <pre>https://flout.is/download.php</pre><br>
				Unique hash to the file: <pre><?php echo $unique_hash; ?></pre><br>
				Password to download & decrypt: <pre><?php echo $pass; ?></pre>
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>
<?php } else { ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAIL!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<form action="functions/upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<article class="message is-danger">
			  <div class="message-header">
				<p>Fail</p>
			  </div>
			  <div class="message-body">
				We could not encrypt the file.
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>
    <?php }
}
?>
