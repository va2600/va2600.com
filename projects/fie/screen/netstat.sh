netstat -ac --numeric-ports | grep -i "estab" | grep -v "tcp6|LISTEN" | grep ":80" | grep -v "0      0"
