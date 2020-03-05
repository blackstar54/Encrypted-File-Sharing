<?php
require_once('includes/config.php');
$hash = $_GET['hash'];
$pass = $_GET['dec_key'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="main1.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <meta property="og:title" content="Flout | Fully encrypted temp file container" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://flout.is" />
    <meta property="og:description" content="Share your files in complete privacy with flout.is, the leading encrypted file container solution for you." /> 
    <meta name="keywords" content="File Sharing, File Storage, Cloud Storage, Encrypted File Storage, Encryption">
  </head>
  <body>
  <section class="section main">
    <div class="main-container">
      <h1 class="title">
	<img src="<?php echo $logo; ?>" width="150px" height="150px"/><br><br>
        Welcome to Flout!
      </h1>
      <p class="subtitle">
        Experience private yet perfect file sharing.
      </p>
	<article class="message is-success">
	  <div class="message-body">
		We now have a Discord community. Join us <a href="https://discord.gg/gtMtG99" target="_blank">here</a>!
	  </div>
	</article>
	<form action="functions/download.php" method="post" enctype="multipart/form-data">
		<div class="field">
		  <label class="label decryption-label">Hash</label>
		  <div class="control">
			<input class="input" type="text" placeholder="1A9YxlSVtYHSZ3NhCm4r0GVo9WKHbX9cxib4E4083H12LOjoboPc4LAeHlVTi46QniV2mVapDcso1MMcaCpfn0t5lpYEu5uSnpUKl5aYhCmio9vzLUO9UiefHdTbjo3G" value="<?php echo $hash; ?>" name="hash">
		  </div>
		</div>
		<div class="field">
		  <label class="label decryption-label" style="padding-top: 0px !important;">Decryption Key</label>
		  <div class="control">
			<input class="input" type="text" placeholder="PQv8yx0FCn5wjyP3R4o5vyrNGs9ttPq4K7BKDDWW2OiBxLKzuxX5yOn273U6StS0" value="<?php echo $pass; ?>" name="dpassword">
		  </div>
		</div>
		<div class="field is-grouped">
		  <div class="control">
			<button type="submit" class="button is-link">Download</button>
			<a href="index.php" class="button">
				Upload
			</a>
		  </div>
		  
		</div>
	</form>
	<?php include('includes/footer.php'); ?>
    </div>
  </section>
  </body>
</html>

<!--
<hr>

<form action="download.php" method="post" enctype="multipart/form-data">
	Hash:<br>
	<input type="text" name="hash" id="hash"><br>
    Select image to upload:<br>
	<input type="text" name="dpassword" id="dpassword"><br>
    <input type="submit" value="Download File" name="submit">
</form>

</body>
</html>
-->