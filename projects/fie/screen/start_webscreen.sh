#!/bin/bash


screen -d -m -S webscreen 
sleep 1


#screen -S webscreen -X multiuser on
#screen -S webscreen -X acladd www-data
#sleep 1

./ttysize.sh

screen -S webscreen -X exec `php-cgi hcloop.php &`
