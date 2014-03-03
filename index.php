<?php
set_time_limit(0);
$socket = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);
if (!$socket) {
  echo "$errstr ($errno)<br />\n";
} else {
  while ($conn = stream_socket_accept($socket)) {
    while($command= fread($conn,1024)) {
		if(trim($command) == 'volup') {
			exec('amixer set Master 10%+');
		}
		if(trim($command) == 'voldown') {
			exec('amixer set Master 10%-');
		}
		echo $command;
    }
    fclose($conn);
  }
  fclose($socket);
}
?>
