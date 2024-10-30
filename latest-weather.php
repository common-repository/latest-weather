<?php
/*
Plugin Name: Latest Weather
Plugin URI: http://aresdown.blog.com/2011/06/05/latest-weather-updates
Description: Displays the current weather in your desired city or location.
Version: 1.0.6
Author: Ares Down
Author URI: http://aresdown.blog.com
*/

/*  Copyright 2011 Ares Down - site@techfirefly.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'latest_weather_add_pages');

// action function for above hook
function latest_weather_add_pages() {
    add_options_page('Weather', 'Weather', 'administrator', 'weather', 'latest_weather_options_page');
}

// latest_weather_options_page() displays the page content for the Test Options submenu
function latest_weather_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_latest_weather_header';
	$opt_name_2 = 'mt_latest_weather_color';
    $opt_name_3 = 'mt_latest_weather_city';
	$opt_name_4 = 'mt_latest_weather_header2';
    $opt_name_6 = 'mt_latest_weather_plugin_support';
	$opt_name_7 = 'mt_latest_weather_temp';
	$opt_name_8 = 'mt_latest_weather_wind';
	$opt_name_9 = 'mt_latest_weather_type';
    $hidden_field_name = 'mt_latest_weather_submit_hidden';
    $data_field_name = 'mt_latest_weather_header';
	$data_field_name_2 = 'mt_latest_weather_color';
    $data_field_name_3 = 'mt_latest_weather_city';
	$data_field_name_4 = 'mt_latest_weather_header2';
    $data_field_name_6 = 'mt_latest_weather_plugin_support';
	$data_field_name_7 = 'mt_latest_weather_temp';
	$data_field_name_8 = 'mt_latest_weather_wind';
	$data_field_name_9 = 'mt_latest_weather_type';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option( $opt_name_2 );
    $opt_val_3 = get_option( $opt_name_3 );
	$opt_val_4 = get_option( $opt_name_4 );
    $opt_val_6 = get_option($opt_name_6);
	$opt_val_7 = get_option($opt_name_7);
	$opt_val_8 = get_option($opt_name_8);
	$opt_val_9 = get_option($opt_name_9);
    

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[ $data_field_name_2 ];
        $opt_val_3 = $_POST[ $data_field_name_3 ];
		$opt_val_4 = $_POST[ $data_field_name_4 ];
        $opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_8 = $_POST[$data_field_name_8];
		$opt_val_9 = $_POST[$data_field_name_9];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_6, $opt_val_6 );
        update_option( $opt_name_7, $opt_val_7 );
        update_option( $opt_name_8, $opt_val_8 );
        update_option( $opt_name_9, $opt_val_9 );		

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Weather Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change4 = get_option("mt_latest_weather_plugin_support");
	$change5 = get_option("mt_latest_weather_temp");
	$change6 = get_option("mt_latest_weather_wind");
       $change8 = get_option("mt_latest_weather_type");

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="c" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change6=="Yes") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}

if ($change7=="c" || $change7=="") {
$change7="checked";
$change71="";
} else {
$change7="";
$change71="checked";
}

if ($change8=="current") {
$change8="checked";
} else if ($change8=="forecast") {
$change81="checked";
} else {
$change82="checked";
}
    ?>

<p>If you go to your website and see "No weather information could be retrieved for this location." then this means the weather location you have entered is incorrect and is not recognised by the Google API.</p>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Title of Widget", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo $opt_val_4; ?>" size="50">
</p><hr />

<p>To enter your location, either give it in the form City,Country - Eg. Paris,France or if you're in the US, you can simply enter your zip code.</p>

<p><?php _e("Location for Weather Widget:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_3; ?>" value="<?php echo $opt_val_3; ?>" size="40">
</p><hr />

<p><?php _e("Temperature displayed in...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="c" <?php echo $change7; ?>>Celcius (&deg;C)
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="f" <?php echo $change71; ?>>Fahrenheit (&deg;F)
</p><hr />

<p><?php _e("Show...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_9; ?>" value="current" <?php echo $change8; ?>>Current weather
<input type="radio" name="<?php echo $data_field_name_9; ?>" value="forecast" <?php echo $change81; ?>>Forecasted weather
<input type="radio" name="<?php echo $data_field_name_9; ?>" value="both" <?php echo $change82; ?>>Current & Forecasted Weather
</p><hr />

<p><?php _e("Display a support link?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change41; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php
}

function show_latest_weather_forecast($args) {

extract($args);

  $latest_weather_header2 = get_option("mt_latest_weather_header2"); 
  $plugin_support2 = get_option("mt_latest_weather_plugin_support");
  $option_city = get_option("mt_latest_weather_city");
  $weathercolor = get_option("mt_latest_weather_color");
  
    if ($option_city=="") {
  $option_city="London,England";
  }
  
  $docload='http://www.google.com/ig/api?weather='.urlencode($option_city);
  $temp_u = get_option("mt_latest_weather_temp");

if ($latest_weather_header2=="") {
$latest_weather_header2="Weather Forecast in ".$option_city;
}

$i=0;
$headings2=$before_widget.$before_title.$latest_weather_header2.$after_title."<br />";
$headings3=strip_tags($headings2);
echo $headings3;
echo "<ul>";
		$output = @wp_remote_fopen($docload);
		$xml  = @simplexml_load_string($output);

    $unit_system = $xml->weather->forecast_information->unit_system['data'];
	
	if ($temp_u=="c") {
	$temp=$xml->weather->current_conditions->temp_c['data'].'&deg;C';
	} else {
	$temp=$xml->weather->current_conditions->temp_f['data'].'&deg;F';
	}
	
	$condition=$xml->weather->current_conditions->condition['data'];
	$icon=$xml->weather->current_conditions->icon['data'];

if ($condition!="" && $icon!="" && $unit_system!="") {
if (get_option("mt_latest_weather_type")=="current" || get_option("mt_latest_weather_type")=="both") {
echo "<li><img src='http://www.google.com/".$icon."' alt='".$condition."' title='".$condition."' align='left'/>Today - ".$condition." <br /> ".$temp."</li><br /><br />";
}
}
	
	for($i=0; $i<=3; $i++) {		
			$day = $xml->weather->forecast_conditions[$i]->day_of_week['data'];
			$icon = $xml->weather->forecast_conditions[$i]->icon['data'];

if ($temp_u=="c") {
$high = round(($xml->weather->forecast_conditions[$i]->high['data'] - 32)/1.8);
$low = round(($xml->weather->forecast_conditions[$i]->low['data'] - 32)/1.8);
$high=$high."&deg;C";
$low=$low."&deg;C";
} else {
$high = $xml->weather->forecast_conditions[$i]->high['data'];
$low = $xml->weather->forecast_conditions[$i]->low['data'];
$high=$high."&deg;F";
$low=$low."&deg;F";
}
			$condition = $xml->weather->forecast_conditions[$i]->condition['data'];
	
if ($icon!="" && $condition!="") {	
if (get_option("mt_latest_weather_type")=="forecast" || get_option("mt_latest_weather_type")=="both") {
	echo "<li><img src='http://www.google.com".$icon."' alt='".$condition."' title='".$condition."' align='left'/>".$day. " - " . $condition."<br /> " . $low . " - " . $high . "</li>";
}
	$j ++;
	}
}

$i ++;

if ($icon=="" && $condition=="") {
echo "<li>No weather information could be retrieved for the location entered. The location must be updated to show current/forecasted weather.</li>";
}

echo "</ul>";

add_action('wp_footer', 'latest_weather_footer_plugin');

echo $after_widget;
}

function init_latest_weather_widget() {
register_sidebar_widget("Latest Weather", "show_latest_weather_forecast");
}

function latest_weather_footer_plugin() {
$plugin3=get_option("mt_latest_weather_plugin_support");
if ($plugin3=="Yes" || $plugin3=="") {
echo "<p style='font-size:x-small'>Weather Plugin made by <a href='http://www.audacity-free-download.com'>Audacity</a></p>";
}
}

add_action("plugins_loaded", "init_latest_weather_widget");

?>
