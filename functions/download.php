<?php
$pass = $_POST['dpassword'];
$hash = $_POST['hash'];
$target_dir = "../uploads/";

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

$file = glob($target_dir . $hash . ".*.aes", GLOB_ERR);
$fileWithoutGay = str_replace(".aes", "", $file[0]);

//Ensure file does not exist
@unlink($fileWithoutGay);

//Decrypt using same password
try {
	if ($file[0] && $lib->decryptFile($file[0], $pass, $fileWithoutGay) && file_exists($fileWithoutGay)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($fileWithoutGay));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($fileWithoutGay));
		ob_clean();
		flush();
		readfile($fileWithoutGay);
		@unlink($fileWithoutGay);
		exit;
	} else {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Failed!</title>
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
				We couldn't serve the file you was looking for.<br>Either <strong>the decryption key was incorrect</strong> or <strong>the hash doesn't exist</strong>.
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>
<?php }
} catch (Exception $e) { ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Failed!</title>
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
				We couldn't serve the file you was looking for.<br>Either <strong>the decryption key was incorrect</strong> or <strong>the hash doesn't exist</strong>.
			  </div>
			</article>
		</div>
	</form>
    </div>
  </section>
  </body>
</html>
<?php } ?>