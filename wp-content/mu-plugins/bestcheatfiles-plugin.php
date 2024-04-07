<?php


function subtractDaysFromDate(int $days, string $format = "F d, Y"): string
{
    // Create a DateTime object for the current date
    $date = new DateTime();

    // Subtract the specified number of days
    $date->sub(new DateInterval("P{$days}D"));

    // Return the formatted date
    return $date->format($format);
}
