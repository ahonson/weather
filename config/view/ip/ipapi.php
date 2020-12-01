<h1>IP-API</h1>
<p>Det här är ett API som validerar IP-adresser, både enligt IPv4 och IPv6, och letar upp det tillhörande domännamnet. API:et klarar av både GET och POST anrop enligt specifikationen nedan.</p>
<p>Förkortade IPv6-adresser omvandlas till det långa formatet ("corrected") innan valideringen utförs.</p>

<h2>GET</h2>
<p><strong>Exempel1</strong>: GET /check?ip=8.8.8.8</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=8.8.8.8">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=8.8.8.8</a>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":true,
    "ip6":false,
    "userinput":"8.8.8.8",
    "corrected":"8.8.8.8",
    "domain":"dns.google",
    "ipmsg":"Den inmatade strängen (8.8.8.8) validerar enligt IPv4.",
    "domainmsg":"Det tillhörande domännamnet är dns.google.",
    "continent": "North America",
    "country": "United States",
    "city": "Mountain View",
    "zip": "94041",
    "language": "English",
    "latitude": "37.388019561768",
    "longitude": "-122.07431030273",
    "map": "https:\/\/www.openstreetmap.org\/?mlat=37.388019561768&mlon=-122.07431030273#map=10\/37.388019561768\/-122.07431030273"
}</pre>

<p><strong>Exempel2</strong>: GET /check?ip=345.213.12.23</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=345.213.12.23">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=345.213.12.23</a>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":false,
    "ip6":false,
    "userinput":"345.213.12.23",
    "corrected":"345.213.12.23",
    "domain":"",
    "ipmsg":"Den inmatade strängen (345.213.12.23) validerar inte.",
    "domainmsg":"Det finns inget domännamn att visa.",
    "continent": "",
    "country": "",
    "city": "",
    "zip": "",
    "language": "",
    "latitude": "",
    "longitude": "",
    "map": ""
}</pre>

<h2>POST</h2>
<p><strong>Exempel1</strong>: POST /check</p>
<p>Body: {"ip": "94.21.49.200"}</p>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":true,
    "ip6":false,
    "userinput":"94.21.49.200",
    "corrected":"94.21.49.200",
    "domain":"94-21-49-200.pool.digikabel.hu",
    "ipmsg":"Den inmatade strängen (94.21.49.200) validerar enligt IPv4.",
    "domainmsg":"Det tillhörande domännamnet är 94-21-49-200.pool.digikabel.hu.",
    "continent": "Europe",
    "country": "Hungary",
    "city": "Budapest",
    "zip": "1191",
    "language": "Hungarian",
    "latitude": "47.4599609375",
    "longitude": "19.14967918396",
    "map": "https:\/\/www.openstreetmap.org\/?mlat=47.4599609375&mlon=19.14967918396#map=10\/47.4599609375\/19.14967918396"
}</pre>

<p><strong>Egna exempel</strong></p>
<form class="" action="ipapi/check" method="post">
    <!-- <input size="40" type="text" name="ip" value="2012::456:567:23"><br><br> -->
    <input size="40" type="text" name="ip" value="<?= $ip ?>"><br><br>
    <input type="submit" name="save" value="Testa">
</form>
