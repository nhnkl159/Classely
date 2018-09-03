<?php
use Carbon\Carbon;

/**
* find the last white space after chopping text to a desired length so you don't cut off in the middle of a word.
*
* @param $text
* @param $chars
*/
function texttruncate($text, $chars = 150)
{
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}

/**
* take the time and calculate the diff between them and return time elapsed
*
* @param $time
*/
function humanTiming($time)
{
    $dt = Carbon::now();
    $diff = $dt->diffForHumans($time);
    return str_replace('אחרי', 'לפני', $diff);
}