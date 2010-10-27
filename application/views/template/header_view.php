<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title><?=$aTitle?></title>

    <?php foreach($aMetadata as $row):?>
    <?=$row."\n"?>
    <?php endforeach;?>

    <?php foreach($aJs as $row):?>
    <?=$row."\n"?>
    <?php endforeach;?>  
</head>

<body>
    <div id="container">
        <div id="top" class="ui-corner-top">
            <ul>
                <li><?=anchor('admin', 'Authentification');?></li>
            </ul>
        </div>
        <div id="banner">
            <p> - IT Atom - <i>L'agence Web</i></p>
        </div>
        <div id="navigation" class="ui-corner-bottom">
            <ul>
                <?php foreach($aNav as $name):?>
                <li><?=$name?></li>
                <?php endforeach;?>
            </ul>
        </div>