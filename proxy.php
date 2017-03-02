<?php
    
function obfuscate($text , $key = 0xA8 ) {
    $key = 0xA8;
    $i = 0;
    $encrypted = '';
    foreach (str_split($text) as $char) {
        $encrypted .= chr(ord($char) ^ ord($key{$i++ % strlen($key)}));
    }
    return $encrypted;
}

	
	# set this to your client machine or proxy,
    # comment it out if you don't want protection
    $proxy_host = '';
    $proxy_port = 0;
    if(array_key_exists('req',$_POST)) {
            $req = $_POST['req'];
    } else {
        #print("unknown request");
        exit;
    }
	
	//only obfuscate  data not headers
	$nlnl = strpos($req, "\r\n\r\n");
	if (!$nlnl) $nlnl = strpos($req, "\n\n");
	if (!$nlnl) { exit; }
	$headers = substr($req, 0, $nlnl);
	$headers = preg_replace('/^Keep-Alive:.*?(\n|$)/ims', '', $headers, 1);
	$headers = preg_replace('/^(Proxy-)?Connection:.*?(\n|$)/ims', '', $headers, 1);
	$headers .= "\r\n". (!empty($proxy_host) ? 'Proxy-' : '') .'Connection: close';
	$req = $headers . substr($req, $nlnl);

    if (empty($proxy_host)) {
        $nl = strpos($req, "\n");
        $headl = substr($req, 0, $nl);
        if(!preg_match('/(\w+)\s+(\S+)(.*)/', $headl, $matches)) {
            exit;
        }
        
	$url = parse_url($matches[2]);
        $host = $url["host"];
	//fix by me
	//allow https connection
	if( $url["scheme"] == "https" ){
		$url = "ssl://" . $url;
		$url["port"] = 443; //https port
		$port = 443;
	}else{   
	$port = $url["port"] ? $url["port"] : 80;
        }
	$req = $matches[1] ." ".
               ($url["path"] ? $url["path"] : '/') .
               ($url["query"] ? "?". $url["query"] : '') .
               $matches[3] . substr($req, $nl);
    } else {
        $host = $proxy_host;
        $port = $proxy_port;
    }

    $fp = fsockopen ($host, $port, $errno, $errstr, 30);
    if (!$fp) {
        print( obfuscate("fsockopen failed: $errstr ($errno)") );
        print obfuscate("HTTP/1.0 500 $errstr ($errno)\r\n");
        print obfuscate("Content-Type: text/html\r\n\r\n");
        print obfuscate("<html><body><b>error</b></body></html>\n");
        exit;
    }

    #socket_set_blocking($fp, 0);
    #socket_set_timeout($fp, 5, 0);

    fwrite($fp, $req);
    $headers_processed = 0;
    $reponse = '';
    while (!feof($fp)) {
        $r = fread($fp, 2048);
        if ($strip_header && !$headers_processed) {
            $response .= $r;
            $nlnl = strpos($response, "\r\n\r\n"); $add = 4;
            if (!$nlnl) { $nlnl = strpos($response, "\n\n"); $add = 2; }
            if (!$nlnl) continue;
            if ($set_content_type) {
                $headers = substr($response, 0, $nlnl);
                if (preg_match_all('/^(Content-.*?)(\r?\n|$)/ims', $headers, $matches)) {
                    for ($i = 0; $i < count($matches[0]); ++$i) {
                        $ct = $matches[1][$i];
                        debug("content-*: $ct");
                        header($ct);
                    }
                }
            }
            print obfuscate( substr($response, $nlnl + $add) , 0xA8 );
            $headers_processed = 1;
        } else
            print obfuscate($r , 0xA8);
    }
    fclose ($fp);

?>
