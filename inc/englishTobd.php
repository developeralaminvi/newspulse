<?php
// Retrieve the post date and format it

function bangla_date_time($format = 'F j, Y')
{
    // Retrieve the post date and format it
    $english_date = get_the_date($format);

    // Arrays of English and Bengali numerals
    $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $bangla_numbers = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');

    // Arrays of English and Bengali month names
    $english_months = array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    );
    $bangla_months = array(
        'জানুয়ারী',
        'ফেব্রুয়ারী',
        'মার্চ',
        'এপ্রিল',
        'মে',
        'জুন',
        'জুলাই',
        'আগস্ট',
        'সেপ্টেম্বর',
        'অক্টোবর',
        'নভেম্বর',
        'ডিসেম্বর'
    );

    // Replace English month names with Bengali month names
    $bangla_date = str_replace($english_months, $bangla_months, $english_date);

    // Replace English numerals with Bengali numerals
    $bangla_date = str_replace($english_numbers, $bangla_numbers, $bangla_date);

    return $bangla_date;
}

function convert_to_bangla($number)
{
    // Define the mapping of English digits to Bangla digits
    $bangla_digits = array(
        '0' => '০',
        '1' => '১',
        '2' => '২',
        '3' => '৩',
        '4' => '৪',
        '5' => '৫',
        '6' => '৬',
        '7' => '৭',
        '8' => '৮',
        '9' => '৯'
    );

    // Convert the number to a string and replace each digit
    $number = strval($number);  // Convert to string if it's not already
    $bangla_number = '';

    for ($i = 0; $i < strlen($number); $i++) {
        // If the character is a digit, replace it with the corresponding Bangla digit
        $bangla_number .= isset($bangla_digits[$number[$i]]) ? $bangla_digits[$number[$i]] : $number[$i];
    }

    return $bangla_number;
}


// Function to display the Bangla date and Bengali year
function newsplus_bangla_date()
{
    $bddp_options = get_option("bddp_options");

    // Default options if none are set
    if (!is_array($bddp_options)) {
        $bddp_options = array('dt_change' => '0', 'separator' => ', ', 'last_word' => '1', 'ord_suffix' => '1', 'bangla_tz' => 6);
    }

    // If 'last_word' is set to 1, append "বঙ্গাব্দ"
    if ($bddp_options['last_word'] == "1") {
        $last_word = " বঙ্গাব্দ";
    }

    // Initialize BanglaDate with current timestamp and the date change option
    $bn = new BanglaDate(time(), $bddp_options['dt_change']);
    $bdtday = $bn->get_day();  // Returns the day of the week, date, and month-year
    $bdtmy = $bn->get_month_year();  // Returns month and year in Bangla

    // Extract the day and the month-year
    $day = $bdtday[1]; // Day of the month (e.g., 11)
    $month_year = sprintf('%s', implode($bddp_options['separator'], $bdtmy));

    // Array for converting numbers to Bangla with suffix (e.g., 1 => "১লা")
    $day_number = array(
        "1" => "১লা",
        "2" => "২রা",
        "3" => "৩রা",
        "4" => "৪ঠা",
        "5" => "৫ই",
        "6" => "৬ই",
        "7" => "৭ই",
        "8" => "৮ই",
        "9" => "৯ই",
        "10" => "১০ই",
        "11" => "১১ই",
        "12" => "১২ই",
        "13" => "১৩ই",
        "14" => "১৪ই",
        "15" => "১৫ই",
        "16" => "১৬ই",
        "17" => "১৭ই",
        "18" => "১৮ই",
        "19" => "১৯শে",
        "20" => "২০শে",
        "21" => "২১শে",
        "22" => "২২শে",
        "23" => "২৩শে",
        "24" => "২৪শে",
        "25" => "২৫শে",
        "26" => "২৬শে",
        "27" => "২৭শে",
        "28" => "২৮শে",
        "29" => "২৯শে",
        "30" => "৩০শে",
        "31" => "৩১শে"
    );

    // Convert the day to Bangla with suffix
    $day_in_bangla = isset($day_number[$day]) ? $day_number[$day] : $day; // Fallback if day is not in the array

    // Format the Gregorian Date (e.g., "11 November 2024")
    $gregorian_date = en_to_bn(gmdate("d F Y", time() + $bddp_options['bangla_tz'] * 60 * 60));

    // Format the Bangla Date
    $bangla_date = en_to_bn(gmdate("l", time() + $bddp_options['bangla_tz'] * 60 * 60)) . ', ' . $day_in_bangla . ' ' . en_to_bn($month_year);

    // Calculate Bengali year manually
    $gregorian_year = date('Y');
    $gregorian_month = date('m');

    if ($gregorian_month < 4) {
        // Bengali year is the current Gregorian year minus 594
        $bangla_year = $gregorian_year - 594;
    } else {
        // Bengali year is the current Gregorian year minus 593
        $bangla_year = $gregorian_year - 593;
    }

    // Display the final formatted date with both the Gregorian date and the Bangla date
    echo '<div class="date" bis_skin_checked="1"><i class="lar la-calendar-minus"></i>
            ' . $bangla_date . ', 
            বঙ্গাব্দ
          </div>';
}

// Function to convert English numbers to Bangla
function en_to_bn($text)
{
    $en = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $bn = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");

    return str_replace($en, $bn, $text);
}


function newsplus_bangla_en_translate()
{

    $selected_language = get_option('newspulse_options')['language_select'] ?? 'bn';
    if ($selected_language == 'bn') {
        ?>
        <i class="las la-clock"></i> <?php echo bangla_date_time(); ?><!--BD Date of post -->
        <?php
    } else {
        ?>
        <i class="las la-clock"></i> <?php the_time('F j, Y'); ?> <!-- Date of post -->
        <?php
    }
    ;
    return;
}