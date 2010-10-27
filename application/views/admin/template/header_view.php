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

    <div id="wrapper">

        <div id="top-section" class="ui-corner-all">

            <?php if ($user) : ?>
            <div id="connection">
                <p>Bonjour <?=$user?> !</p>
            </div>
            <?php endif; ?>

            <div id="navigation">
                <ul>
                    <?php foreach($aNav as $name):?>
                    <li><?=$name?></li>
                    <?php endforeach;?>
                </ul>
            </div>
            
        </div>