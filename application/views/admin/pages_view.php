    <div id="container" >

        <h2 id="actionTitle"><?php echo $sActionTitle; ?></h2>

        <div id="left-col">

            <ul id="menu" class="ui-corner-all">
                <?php foreach($aMenu as $name):?>
                <li><?=$name?></li>
                <?php endforeach;?>
            </ul>

        
<!-- We got to take off this following IF condition once the "Create page" Action is done -->
<?php if (isset($sError)) :?>
        </div>
        <?php echo $sError;?>
<?php else :?>
       
        <?php if ($bEditMode == true) :?>

        <?php if (isset($aMenuPage)) :?>
            <ul id="menu-page" class="ui-corner-left">
                <?php foreach($aMenuPage as $name):?>
                <li><?=$name?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>

        </div>
        <div id="mid-col" class="ui-corner-all">
            <?php form_open('admin/pages/save/'.$id);?>
            <div id="page-info">
                <ul>
                    <li>
                        <label for="title">Titre</label>
                        <input type="text" name="title" value="<?php echo $oPage->title;?>" size="50" maxlength="120"/>
                    </li>
                    <li class="even">
                        <label for="slug">URL</label>
                        <input type="text" name="slug" value="<?php echo $oPage->slug;?>" size="30" maxlength="60"/>
                    </li>
                    <li>
                        <label for="meta-title">Meta-Titre</label>
                        <input type="text" name="meta-title" value="<?php echo $oPage->meta_title;?>" size="60" maxlength="255"/>
                    </li>
                    <li class="even">
                        <label for="meta-keywords">Mots-Clefs</label>
                        <input type="text" name="meta-keywords" value="<?php echo $oPage->meta_keywords;?>" size="60" maxlength="255"/>
                    </li>
                    <li>
                        <label for="meta-description">Description</label>
                        <textarea name="meta-description" cols="62" rows="5"> <?php echo $oPage->meta_description;?> </textarea>
                    </li>
                    <li class="even">
                        <label for="status">Statut</label>
                        <select name="status">
                        <?php switch ($oPage->status):

                            case "live":
                                    echo "<option value=\"draft\">Brouillon</option>
                                    <option value=\"live\" selected=\"selected\">Publié</option>"; break;
                            case "draft":
                                    echo "<option value=\"draft\" selected=\"selected\">Brouillon</option>
                                    <option value=\"live\">Publié</option>"; break;
                            default: exit;
                        endswitch; ?>
                        </select>

                    </li>
                </ul>
            </div>
            <div id="page-content">
	          <p>	
		    <textarea id="body" style="width: 690px; height: 800px"><?php echo htmlentities($oPage->body); ?></textarea>
	          </p>
            </div>
            <input class="button" type="submit" value="Enregistrer" />
            <?php form_close();?>
        <?php else :?>
        </div>
        <div id="mid-col" class="ui-corner-all">
            <div id="file-tree">
                <ul id="menu" class="ui-corner-all">
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

<?php endif;?>
    </div>