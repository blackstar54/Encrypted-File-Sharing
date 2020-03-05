<?php
require_once('config.php');
$io = popen ( '/usr/bin/du -sk ' . $uploads_dir, 'r' );
$size = fgets ( $io, 4096);
$size = substr ( $size, 0, strpos ( $size, "\t" ) );
pclose ( $io );
$gb = $size / 1e+6;
$per = round($gb / $max_gb * 100, 2);
?>
		<hr>
		<div class="field">
		  <label class="label"><?php echo "$per% of $max_gb GB used."; ?></label>
		  <progress class="progress is-link" value="<?php echo $per; ?>" max="100"><?php echo $per."%"; ?></progress>
		</div>
