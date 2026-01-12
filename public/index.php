<?php
// On récupère l'URL, si elle n'existe pas (racine), on met '/' par défaut
$url = $_GET['url'] ?? '/';

echo "URL demandée : " . $url;