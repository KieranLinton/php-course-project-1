<?php


function requireOnceAll(string $dirPattern)
{
    foreach (glob($dirPattern) as $filename) {
        require_once $filename;
    }
}
