<?php include("inc/header.inc.tmpl.php");?>

<? if($arResult['ACT']=='list'):?>
    <? include("inc/locations.list.inc.php")?>
<? elseif($arResult['ACT']=='add'):?>
    <? include("inc/locations.add.inc.php")?>
<? elseif($arResult['ACT']=='edit'):?>
    <? include("inc/locations.edit.inc.php")?>
<? elseif($arResult['ACT']=='info'):?>
    <? include("inc/locations.info.inc.php")?>
<? endif ?>

<?php include("inc/footer.inc.tmpl.php");?>
