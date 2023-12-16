<?php

namespace App\Services;

class DateService
{
    /**
     * Format the date to be displayed in the blog post.
     * @param string $date
     * @return string
     */
    public static function formatPublishedAtDate(string $date): string
    {
        return date('F j, Y', strtotime($date));
    }
}
