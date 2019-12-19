<?php

function getCurrentURL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else
        $link = "http";
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['REQUEST_URI'];
    return $link;
}

function stars($stop)
{

    ?>
    <span style="color: green; font-size: 17.5px">
    <?php
    for ($nr = 1; $nr < $stop; $nr = $nr + 2): ?>
        <i class="fas fa-star"></i>
    <?php
    endfor;
    if (($nr < 10)) {
        if (($nr - $stop) == 0):?>
            <i class="fas fa-star-half-alt"></i>
            <?php
            $nr++;
        endif;
    }
    $stop = ceil((10 - $nr) / 2);
    for ($nr = 0; $nr < $stop; $nr++):?>
        <i class="far fa-star"></i>
    <?php
    endfor;
    ?>
    </span>
    <?php
}


?>