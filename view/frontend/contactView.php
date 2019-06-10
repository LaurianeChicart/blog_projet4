<?php $title = 'Contact';
?>
<section class="article bg-light container">
	<h3>Me contacter</h3>
	<form action="send-mail.html" method="post">
<?php
if(isset($errorMessage))
{
?>
			<p class="alert alert-danger" role="alert"><?= $errorMessage ?></p>
<?php
}
?>
		<div class="form-group">
<?php
if(isset($name))
{
?>
			<label for="name">Nom</label><input type="text" name="name" id="name" class="form-control" required value="<?= $name ?>">
<?php
}
else
{
?>
			<label for="name">Nom</label><input type="text" name="name" id="name" class="form-control" required>
<?php
}
?>
		</div>
		<div class="form-group">
<?php
if(isset($mail))
{
?>
			<label for="mail">Mail</label><input type="mail" name="mail" id="mail" class="form-control" required placeholder="nom@example.com" value="<?= $mail ?>">
<?php
}
else
{
?>
			<label for="mail">Mail</label><input type="mail" name="mail" id="mail" class="form-control" required placeholder="nom@example.com">
<?php
}
?>
		</div>
		<div class="form-group">
<?php
if(isset($subject))
{
?>
			<label for="subject">Objet</label><input type="text" name="subject" id="subject" class="form-control" required value="<?= $subject ?>">
<?php
}
else
{
?>
			<label for="subject">Objet</label><input type="text" name="subject" id="subject" class="form-control" required>
<?php
}
?>	
		</div>
		<div class="form-group">
<?php
if(isset($message))
{
?>
			<label for="message">Message</label><textarea name="message" id="message" class="form-control" required rows="7"><?= $message ?></textarea>
<?php
}
else
{
?>
			<label for="message">Message</label><textarea name="message" id="message" class="form-control" required rows="7"></textarea>
<?php
}
?>
		</div>	
		<div class="d-flex justify-content-end">
			<button type="submit"class="btn btn-primary"><span class="fas fa-envelope"> </span> Envoyer</button>
		</div>
		
	</form>
</section>
		
		