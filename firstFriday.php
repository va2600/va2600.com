<?php

// $ff = Next First Fri
// $FriThisMonth = This months First Fri
// $NextFirstFri = Next First Fri formatted (or if today, says TODAY!)
// $NextFirstFri1 = Next First Fri formatted (or if today, says TODAY!) w/ no html code

// First Friday Check Function:

if (!function_exists('get_day')) {

   function get_day( $describer, $weekday, $reference_date ) {   //$reference_date format = m-Y

     $d = explode('-',$reference_date);

     switch ($describer) {
         case 'first':  $offset = get_day_offset($reference_date, $weekday); break;
     }

     $r = mktime( 0, 0, 0, $d[0], 1+$offset, $d[1] );
     return $r;  //returns timestamp format
   }
}

if (!function_exists('get_day_offset')) {
   function get_day_offset( $anchor , $target ) {  //$anchor format = m-Y

     $ts = explode('-',$anchor);
     $ts = mktime(0,0,0,$ts[0],'01',$ts[1]);

     $anchor = date("w",$ts);
     $target = strtolower($target);
     $days = array( 'sunday'=>0, 'monday'=>1, 'tuesday'=>2, 'wednesday'=>3, 'thursday'=>4, 'friday'=>5, 'saturday'=>6 );

     $offset = $days[$target] - $anchor;
     if ($offset<0) $offset+=7;
     return $offset;  //returns 0-6 for use in get_day();
   }
}

  $t = getdate(); //Get today's date

  $today = date('m-Y',$t[0]); //Display today's date as MM-YYYY

   //Calculate Next Month
   if ($t['mon'] == '12'){
     $nm = '1-'.($t[year]+1);
   }
#   if ($t[mday] <= '7' && $t[wday] <= '5') {  # Adjusted by 1 day?  Because the first Fri = 7th
   if ($t['mday'] <= '8' && $t['wday'] <= '6') {
      $nm = ($t['mon']).'-'.$t['year'];
   }
   else {
      $nm = ($t['mon']+1).'-'.$t['year'];
   }

   $date = get_day("first", "friday", $nm);

$FriThisMonth = date("m/d/Y", $date);

   //Checks if today is after the first friday of the month
   if ($t['mon'] == date('m',$date) && $t['mday'] > date('j',$date) && $t['mon'] == '12') {
      $nm = '1-'.($t['year']+1);
      $ff = get_day("first", "friday", $nm);
   }
   if ($t['mon'] == date('m',$date) && $t['mday'] > date('j',$date) && $t['mon'] != '12') {
      $nm = ($t['mon']+1).'-'.$t['year'];
      $ff = get_day("first", "friday", $nm);
   }
   else {
      $ff = $date;
   }

if (date("F j, Y", $ff) == date("F j, Y", time())) {
   $NextFirstFri1 = "TODAY";
   $NextFirstFri = "<b>TODAY!</b>";
} elseif (date("m j", $ff) == "04 1") {
   $NextFirstFri = "April Fools Day!";
} else {
   $NextFirstFri = date("F j, Y", $ff);
}
?>
