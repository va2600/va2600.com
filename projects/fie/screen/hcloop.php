<?

set_time_limit(0);
exec("rm scrhc*");
$i = 0;


do{
$i++;
exec("screen -S webscreen -X hardcopy scrhc;");

if($i == 50){
exec("screen -S webscreen -X exec /var/www/screen/ttysize.sh");
$i = 0;
}

usleep("500000");
} while(file_exists("scrhc"));

?>
