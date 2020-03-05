<?php
require_once('includes/config.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload!</title>
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
    <div class="container main-container">
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
	<form class="upload-form" action="functions/upload.php" method="post" enctype="multipart/form-data">
		<!--<div class="field">-->
			<!--<label class="label decryption-label">Decryption Key</label>-->
			<!--<div class="control">-->
			<!--<input class="input" type="text" placeholder="lol123" name="password">-->
			<!--</div>-->
		<!--</div>-->
		<div class="field">
			<div class="file has-name">
			  <label class="file-label">
				<input class="file-input" type="file" name="fileToUpload" id="fileToUpload">
				<span class="file-cta">
				  <span class="file-icon">
					<i class="fas fa-upload"></i>
				  </span>
				  <span class="file-label">
					Choose a file...
				  </span>
				</span>
				<span class="file-name">
				  Waiting for choice...
				</span>
			  </label>
			</div>
		</div>
		<div class="field is-grouped">
		  <div class="control">
			<button type="submit" class="button is-link">Upload</button>
			<a href="download.php" class="button">
				Download
			</a>
		  </div>
		</div>
	</form>
			<hr>
		<div class="field">
		  <label class="label">0.01% of 500 GB used.</label>
		  <progress class="progress is-link" value="0.01" max="100">0.01%</progress>
		</div>
    </div>
  </section>
  </body>
  <script>
	document.addEventListener('DOMContentLoaded', () => {
	  // 1. Display file name when select file
	  let fileInputs = document.querySelectorAll('.file.has-name')
	  for (let fileInput of fileInputs) {
		let input = fileInput.querySelector('.file-input')
		let name = fileInput.querySelector('.file-name')
		input.addEventListener('change', () => {
		  let files = input.files
		  if (files.length === 0) {
			name.innerText = 'No file selected'
		  } else {
			name.innerText = files[0].name
		  }
		})
	  }

	  // 2. Remove file name when form reset
	  let forms = document.getElementsByTagName('form')
	  for (let form of forms) {
		form.addEventListener('reset', () => {
		  console.log('a')
		  let names = form.querySelectorAll('.file-name')
		  for (let name of names) {
			name.innerText = 'No file selected'
		  }
		})
	  }
	})
  </script>
</html>
