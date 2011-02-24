<div class="tBox">
        <div class="boxHead ui-corner-top">
            <h2> <?php echo $header; ?> </h2>
        </div>
        <div class="boxContent">
            <?php if (isset($content)) : ?>
            <?php echo $content; ?>
            <?php else : ?>
            <?php echo $link_url; ?>
            <?php endif; ?>
        </div>
        <div class="boxFooter ui-corner-bottom">
        </div>
</div>