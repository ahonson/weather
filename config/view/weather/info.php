<h1>Väderinfo för <?= $weatherinfo["name"] ?></h1>

<h2>Aktuellt</h2>
<table class="weathertable">
    <tr>
        <th>Datum</th>
        <th>Väder</th>
        <th>Temperatur</th>
        <th>Känns som</th>
        <th>Min</th>
        <th>Max</th>
    </tr>
    <tr>
        <td><?= date("Y-m-d") ?></td>
        <td><?= $weatherinfo["weather"][0]["description"] ?></td>
        <td><?= $weatherinfo["main"]["temp"] ?> °C</td>
        <td><?= $weatherinfo["main"]["feels_like"] ?> °C</td>
        <td><?= $weatherinfo["main"]["temp_min"] ?> °C</td>
        <td><?= $weatherinfo["main"]["temp_max"] ?> °C</td>
    </tr>
</table>

<?php if ($forecast) : ?>
<h2>Prognos</h2>
<table class="weathertable">
    <tr>
        <th>Datum</th>
        <th>Väder</th>
        <th>Temperatur</th>
        <th>Känns som</th>
        <th>Min</th>
        <th>Max</th>
    </tr>
    <?php foreach ($forecast["daily"] as $row) : ?>
        <?php if (date("Y-m-d", $row["dt"]) !== date("Y-m-d")) : ?>
    <tr>
        <td><?= date("Y-m-d", $row["dt"]) ?></td>
        <td><?= $row["weather"][0]["description"] ?></td>
        <td><?= $row["temp"]["day"] ?> °C</td>
        <td><?= $row["feels_like"]["day"] ?> °C</td>
        <td><?= $row["temp"]["min"] ?> °C</td>
        <td><?= $row["temp"]["max"] ?> °C</td>
    </tr>
        <?php endif ?>
    <?php endforeach ?>
</table>
<?php endif ?>

<?php if ($historic) : ?>
<h2>Historik</h2>
<table class="weathertable">
    <tr>
        <th>Datum</th>
        <th>Väder</th>
        <th>Temperatur</th>
        <th>Känns som</th>
        <th>Vind</th>
        <th>Lufttryck</th>
    </tr>
    <?php foreach ($historic as $row) : ?>
    <tr>
        <td><?= date("Y-m-d", $row["current"]["dt"]) ?></td>
        <td><?= $row["current"]["weather"][0]["description"] ?></td>
        <td><?= $row["current"]["temp"] ?> °C</td>
        <td><?= $row["current"]["feels_like"] ?> °C</td>
        <td><?= $row["current"]["wind_speed"] ?> m/s</td>
        <td><?= $row["current"]["pressure"] ?> Pa</td>
    </tr>
    <?php endforeach ?>
</table>
<?php endif ?>

<?php if (!$geoinfo) : ?>
<p><?= $map ?></p>
<?php else : ?>
    <p><?= $geoinfo ?></p>
<?php endif ?>
