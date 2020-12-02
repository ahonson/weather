<?php

namespace Anax\View;

?>

<h1>IP validator</h1>

<p>Den här sidan som är byggd med hjälp av en kontrollerklass (di-style) visar om den inmatade IP-adressen validerar eller ej och enligt vilket format. Även det tillhörande domännamnet visas (om det finns).</p>

<p><a href="ipapi">Klicka här för att komma till IP-API:et.</a></p>

<form class="" action="" method="post">
    <label for="userip">Mata in en IP-adress enligt IPv4 eller IPv6: </label><br><br>
    <input size="40" type="text" name="userip" value="<?= $usergeoinfo["ip"] ?>" autofocus><br><br>
    <input type="submit" name="save" value="Validera">
</form>

<div><?= $ipmsg ?></div>
<p><?= $inputgeoinfo ?></p>
