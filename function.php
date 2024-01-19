<?php

function calculatePower($voltage, $ampere) {
    $energy = ($voltage * $ampere) / 1000;
    return $energy;
}

function calculateRate($current) {
    $rate = $current/100;
    return $rate;
}