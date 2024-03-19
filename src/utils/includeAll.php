<?php

function requireOnceAll($dirPattern)
{
    foreach (glob($dirPattern) as $filename) {
        require_once $filename;
    }
}
