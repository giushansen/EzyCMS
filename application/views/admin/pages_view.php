    <div id="container" >

        <h2 id="actionTitle"><?php echo $sActionTitle; ?></h2>

        <div id="left-col" class="ui-corner-all">

            <ul id="menu">
                <?php foreach($aMenu as $name):?>
                <li><?=$name?></li>
                <?php endforeach;?>
            </ul>

        </div>

        <div id="mid-col" class="ui-corner-all">
        <?php if ($bEditMode == true) :?>

            <div>
                <?=form_open('admin/pages/save/'.$id);?>
	          <p>	
		    <textarea name="content" style="width: 690px; height: 800px"><?php echo htmlentities($oPage->body); ?></textarea>
		    <input type="submit" value="Save" />
	          </p>
                <?=form_close();?>
            </div>

        <?php else :?>

            <div id="file-tree">
                <ul id="menu">
                    <?php foreach($aPages as $page): ?>
                    <li><?php echo $page;?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div id="page-details">
                <p> <i>Cliquez sur la page de votre choix pour visionner ses d&eacute;tails.</i> </p>
            </div>

            <div class="clear"></div>

        <?php endif;?>
        </div>

    </div>