<?php

 function ispisNavigacije($links) {
    $ispis = "";
    foreach($links as $link) {
        $ispis.= "<li class='nav-item'>
        <a class='nav-link' href='".$link['src']."'>".$link['name']."</a>
    </li>";
    }
    return $ispis;
 }
 ?>