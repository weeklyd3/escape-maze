<?php 
/*
    PHP Escape Maze
    Copyright (C) 2022 weeklyd3 and idkwutocallmself

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.
*/
session_start();
?><!DOCTYPE html>
<html>
  <head>
    <title>Escape Maze</title>
	  <link rel="stylesheet" href="style.css" />
  </head>
  <body>
	  <style>img{max-width:50%;}</style>
	  <h2>Escape Maze</h2>
	  <p>Hey! The source is <a href="https://github.com/weeklyd3/escape-maze/tree/master">on GitHub</a>.</p>
	  <form action="index.php" method="post">
<?php 
$place = isset($_POST['level']) ? $_POST['level'] : 1;
$place = (int) $place;
?><p>You're looking at level <b><?php echo $place; ?></b></p><?php
switch ($place) {
	case 1:
		?><p>Type the name of the singer in this audio recording:</p>
		  <p>
<figure>
    <figcaption>Play music:</figcaption>
    <audio
        controls="controls"
        src="music.mp3">
            Your browser does not support the
            <code>audio</code> element.
    </audio>
</figure>
		  </p>
	<label>Answer:<br /><input type="text" name="answer" autocomplete="off" /></label>
	<?php
	break;
	case 2:
		if (!(strtolower($_POST['answer']) === 'rick astley')) {
			?><p>You got THAT wrong! Actually, who else COULD it be!?</p>
		  <p>Click below to continue:</p>
		  <input type="hidden" name="level" value="1" />
		  <input type="submit" value="Continue" />
	  </form>
	  <?php exit(0);
		}
	?><p>OK, you're pretty good at this.</p><p>But in order to continue, please point out WHERE this image was taken from.</p><p><img src="Morone-St-PROFILE-PHOTO.png" alt="image" /></p>
	  <label>Answer:
	  <select name="answer" autocomplete="off">
		  <option disabled="disabled" selected="selected" value="">Choose...</option>
		  <?php 
			$places = array(
				'Medford, Oregon',
				'Houston, Texas',
				'Anchorage, Alaska',
				'San Francisco, California',
				'Carson City, Nevada',
				'Yuba City, California',
				'Baked Fart Cloud, California',
				'Reno, Nevada',
				'Santa Clara, California',
				'Salt Lake City, Utah',
				'Cheyenne, Wyoming',
				'Wichita, Kansas',
				'Topeeka, Kansas',
				'Jefferson City, Missouri'
			);
	shuffle($places);
	foreach ($places as $city) {
		?><option value="<?php echo htmlspecialchars($city); ?>"><?php echo htmlspecialchars($city); ?></option>
		  <?php
	}
	?>
	  </select>
	  </label>
			<?php
	break;
	case 3:
		if ($_POST['answer'] !== 'Santa Clara, California') {
			?><p>INCORRECT!!!</p><p>Please start over. Or go <a href="music.mp3">here</a> to get revived.</p>
			<input type="hidden" value="1" name="level" />
		  <input type="submit" value="Continue" />
	  </form><?php
			exit(0);
		} else {
			?><p>Please verify your identity.</p>
	  <p>Or else.</p>
	  <p>It won't help, but here's the HASH of the answer:<br /><code>$2y$10$oDQ1pc35P4jUwZdhhhlAY.PzEAyL.PqpYyiNZgVwlZ9cO5yN7CUWy</code></p>
			<label>Type the name of our main chat group (case-sensitive):
				<input name="answer" autocomplete="off" type="password" /></label>
			<?php
		}
	break;
	case 4:
		if (!password_verify($_POST['answer'], '$2y$10$oDQ1pc35P4jUwZdhhhlAY.PzEAyL.PqpYyiNZgVwlZ9cO5yN7CUWy')) {
			?><p>Wrong, wrong, wrong!</p><p>Click below: <br /><input type="submit" value="Click me" /><br />to continue.</p><?php
			exit(0);
		}
	?><p>Anti-SPAMBOT challenge:</p><p>Click below to show.</p>
	  <?php break; 
	case 5: ?>
			<p>What is...<br /><?php
	$num1 = array_rand(range(1, 100));
	$num2 = array_rand(range(1, 50));
	$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
echo $f->format($num1);
	?> plus <?php
	echo $f->format($num2);
	?>?<br />Number please.</p>
	<input type="hidden" name="num1" value="<?php
	echo str_repeat('a', $num1);
	?>" />
	<input type="hidden" name="num2" value="<?php
	echo str_repeat('a', $num2);
	?>" />
	<label>Answer:
		<input type="text" name="answer" autocomplete="off" /></label>
	<?php
	break;
	case 6:
	if (strlen($_POST['num1'] . $_POST['num2']) != $_POST['answer']) {
		?>No bots allowed. <input type="submit" value="Leave site and start over" /><?php
		exit(0);
	}
	?>The remaining challenges require JavaScript. Click the button below to show that you have enabled JavaScript.
	  <p>They also require cookies, so we're trusting that you have them enabled.</p>
		<p><noscript>You have JavaScript disabled. You can't play the next levels.</noscript>
		<input type="submit" style="display: none;" value="I've enabled JavaScript" id="js-confirm-button" />
			<input type="hidden" name="level" value="7" />
			<script>document.getElementById('js-confirm-button').style.display = 'block';</script>
		</p>
		<?php
	exit(0);
	break;
	case 7:
	?>
	<p>Quick, quick, quick, press the button as many times as you can in 5 seconds!</p>
	  <button onclick="document.getElementById('clicks').value = parseInt(document.getElementById('clicks').value) + 1;" type="button">Click me</button>
	<input type="hidden" id="clicks" name="clicks" value="0" autocomplete="off" />
	  <input type="hidden" value="8" name="level" />
		  <input type="submit" value="Continue" style="display: none;" />
	  <script>
		  setTimeout(function() {
			  document.querySelector('input[type=submit]').click();
		  }, 5000);
	  </script>
	<?php
	exit(0);
		break;
	case 8:
		$clicks = $_POST['clicks'];
		?><p>Let's see. You got...</p>
	  <p><?php echo htmlspecialchars($_POST['clicks']); ?> click<?php echo ((int) $_POST['clicks']) !== 1 ? "s" : ""; ?>!!!</p><?php
	if ($clicks < 5) {
		?><p>Wow, under 5 clicks. You're clicking too slowly. <input type="submit" value="Click here to continue." /></p><?php
		exit(0);
	}
	if ($clicks >= 5 && $clicks < 85) {
		?><p>Meh.</p><?php
	}
	if ($clicks >= 85) {
		?><p>You... You... You... CHEATED!!! <input type="submit" value="Click here to continue." /></p>
	  <?php exit(0);
	}
	break;
	case 9:
	?><p>Some important information (requires JavaScript to show):</p><?php
	$chosenRow = array_rand(range(1, 10));
	$chosenCol = array_rand(range(1, 10));
	for ($i = 0; $i < 10; $i++) {
		for ($j = 0; $j < 10; $j++) {
			if ($i == $chosenRow && $j == $chosenCol) {
				?><span tabindex="0" onclick="document.getElementById('code').style.display = 'block';document.getElementById('wrongbutton').style.display = 'block';">n</span><?php
			} else {
				?><span tabindex="0" onclick="document.getElementById('code').style.display = 'none'; document.getElementById('wrongbutton').style.display = 'block';">h</span><?php
			}
		}
		echo '<br />';
	}
	?>
	<div id="wrongbutton" hidden="hidden"><img src="RickWrongButton.png" alt="You clicked the wrong button, nub!" /></div>
	  <span style="font-size: 5px; display: none;" id="code" class="flashing">Ha, that was a lie. Please save this code: <?php
	$code = array_rand(range(1, 10000));
	echo $code; ?></span><?php
	$_SESSION['code'] = password_hash($code, PASSWORD_DEFAULT);
	break;
	case 10:
	?><p>Enter a note:</p>
	  <label>Note:<br /><input type="text" name="note" autocomplete="off" /></label><?php
		break;
	case 11:
	$_SESSION['note'] = password_hash($_POST['note'], PASSWORD_DEFAULT);
		?><p>Your note has been saved. Now <strong>enter it now here!</strong></p>
	  <label>Note:<br /><input type="text" name="note" autocomplete="off" /></label><?php
	break;
	case 12:
	if (!password_verify($_POST['note'], $_SESSION['note'])) {
		?><p>You FALIURE. You entered it wrong.</p><p>I will send you to Jesus and give you emotional damage.</p><p><input type="submit" value="Click here to continue." /></p>
		<?php
		exit(0);
	}
	?><p>BOSS FIGHT!!!</p>
	  <p>You vs Computer</p>
	  <label>Choose your move:
	  <select name="move">
		  <option value="" disabled="disabled" selected="selected">Choose your move</option>
		  <option value="r">Rock</option>
		  <option value="p">Paper</option>
		  <option value="s">Scissors</option>
	  </select>
	  </label>
	  <?php
	break;
	case 13:
	$moves = array('r', 'p', 's');
	shuffle($moves);
	$move = $moves[0];
	if ($_POST['move'] == '') {
		?><p>Select an option, ya BIG NUB!!!</p>
	  <input type="submit" value="Back" />
	  <?php exit(0);
	}
	while ($move === $_POST['move']) {
shuffle($moves);
		$move = $moves[0];
	}
	$moveWords = array(
		'r' => 'Rock',
		'p' => 'Paper',
		's' => 'Scissors'
	);
	?><p>Computer's move: <?php echo $moveWords[$move]; ?></p><?php
	if ($move === 'r') {
		if ($_POST['move'] == 'p') {
			?><p>You lost. Rock bashes the paper.</p><?php
		} else {
			?><p>You lost. Rock bashes scissors.</p><?php
		}
	}
		if ($move === 'p') {
			if ($_POST['move'] == 's') {
				?><p>You lost. Paper surrounds the scissors.</p><?php
			} else {
				?><p>You lost. The paper engulfed your rock.</p><?php
			}
		}
			if ($move === 's') {
				if ($_POST['move'] === 'r') {
					?><p>You lose. The scissors cut your rock.</p><?php
				} else {
					?><p>You lose. The scissors cut the paper.</p><?php	
				}
			}
		?>
		<p>Do you want to see why you lost?</p>
	  <p>13 is unlucky! Don't be a morone!</p><?php
	break;
	case 14:
	?><p>Remember the code that was given to you on lesson 9? Enter it here!</p>
	  <label>Code:
		  <input type="text" name="code" autocomplete="off" /></label>
	  <?php
	break;
	case 15:
		?><p>Verifying your code...</p>
	  <?php
	$codehash = $_SESSION['code'];
	session_destroy();
	if (!password_verify($_POST['code'], $codehash)) {
		?><p>What part of "ENTER THE CODE" do you not understand!?</p><p>Click <input type="submit" value="here" /> to continue.</p><?php
		exit(0);
	}
	?><p>OK, you're really good at this.</p>
		<p>But what is:<br />
		<img src="https://badhtml.com/pics/captcha.jpg" alt="Captcha" />
		</p>
	  <label>Answer:
		  <input type="text" name="answer" /></label>
		<?php
	break;
	case 16:
	$hash = '$2y$10$4NAPm4yJonn.Ig9L6iAgxee4Y1hw0EO0u7rcaPFLhIfHK7plFWAKG';
	// Try 'illuminati' as the answer
	if (!password_verify(strtolower($_POST['answer']), $hash)) {
		?><p>What part of CALCULUS do you NOT UNDERSTAND<?php echo str_repeat('!?', 30); ?></p>
		<p><input type="submit" value="Click here to continue" /></p>
		<?php
		exit(0);
	}
	?><p>Correct! But that's IT.</p>
	  <?php
	break;
}
?>
<input type="hidden" value="<?php echo $place + 1; ?>" name="level" />
		  <input type="submit" value="Continue" />
	  </form>
  </body>
</html>