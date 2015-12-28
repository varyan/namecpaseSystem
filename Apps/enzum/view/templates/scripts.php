<?php for($i = 0; $i < sizeof($scriptFiles); $i++) : ?>
    <?php $scriptFile = $scriptFiles[$i] ?>
    <script language="JavaScript" type="text/javascript" src="<?=TEMPLATE.$scriptFile?>"></script>
<?php endfor; ?>