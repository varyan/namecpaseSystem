<?php $styleFiles = \System\Core\Asset::getAssets('css');
    for($i = 0; $i < sizeof($styleFiles); $i++) : ?>
        <?php $styleFile = $styleFiles[$i] ?>
    <link rel="stylesheet" href="<?=TEMPLATE.$styleFile?>">
<?php endfor; ?>
