<h4><?php echo $page->title; ?></h4>

<fieldset>
    <legend>D&eacute;tails</legend>
	<p>
		<strong>ID : </strong> #<?php echo $page->id; ?>
	</p>
	<p>
		<strong>Statut : </strong> <?php echo $page->status; ?>
	</p>
	<p>
		<strong>Titre URL :</strong> <?php echo $page->slug; ?>
	</p>
</fieldset>

<fieldset>
    <legend>M&eacute;ta-donn&eacute;es</legend>
	<p>
            <strong> M&eacute;ta titre :</strong> <?php echo $page->meta_title; ?>
	</p>
	<p>
            <strong> M&eacute;ta mots-cl&eacute;s :</strong> <?php echo $page->meta_keywords; ?>
	</p>
	<p>
	    <strong>M&eacute;ta description :</strong> <?php echo $page->meta_description; ?>
	</p>
</fieldset>	