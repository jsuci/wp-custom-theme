<?php


function adjustDateToPreviousMonthWithRandomTime(string $dateStr): string
{
    // Parse the given date string
    $givenDate = DateTime::createFromFormat('Y-m-d', $dateStr);
    $currentDate = new DateTime();

    // Adjust the month to one month before the current month, and update the year to the current year
    $previousMonth = (int)$currentDate->format('m') - 1;
    $year = $currentDate->format('Y');

    // If the previous month is December (0 after subtraction), adjust the year and month accordingly
    if ($previousMonth === 0) {
        $previousMonth = 12;
        $year--; // Decrease the year if we roll back to December
    }

    // Apply adjustments
    $givenDate->setDate($year, $previousMonth, $givenDate->format('d'));

    // Generate random time values
    $hours = mt_rand(0, 23);
    $minutes = mt_rand(0, 59);
    $seconds = mt_rand(0, 59);

    // Set the random time to the given date
    $givenDate->setTime($hours, $minutes, $seconds);

    // Return the updated date string in "Y-m-d H:i:s" format
    return $givenDate->format("Y-m-d H:i:s");
}


function update_publish_date($post_id, $new_date)
{
    // Check if the new date is in the correct format 'Y-m-d H:i:s'
    if (DateTime::createFromFormat('Y-m-d H:i:s', $new_date) !== false) {
        $post_data = array(
            'ID'            => $post_id,
            'post_date'     => $new_date, // New publish date
            'post_date_gmt' => get_gmt_from_date($new_date) // Convert to GMT
        );

        // Update the post
        $return_value = wp_update_post($post_data);
    } else {
        error_log('Invalid date format. Date must be in the format Y-m-d H:i:s');
    }
}
