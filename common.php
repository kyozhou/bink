<?php
$seo = getConfig();
$sql = "SELECT c.name, c.id, COUNT( a.id ) AS num
    FROM bink_article AS a
    LEFT JOIN bink_articlecls AS c ON a.classes = c.id
    GROUP BY c.name";
$articlecls = queryArray($sql);