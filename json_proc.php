<?php
header('Content-Type: text/html; charset=utf-8');

$json_file = './data.json';

switch ($proc) {
    case "add":
        
        $data['type'] = $_POST['data_type'];
        $data['name'] = $_POST['data_name'];
        $data['detail'] = $_POST['data_detail'];
        
        $json_check_data = @file_get_contents($json_file);
        $data_check = json_decode($json_check_data, true);
        
        if(count($data_check)>0){
            foreach ($data_check as $data_id_check => $data_val_check) {
                $json_data[$data_id_check] = $data_val_check;
            }
        }
        
        $json_data[$_POST['data_id']] = $data;        
        $json_data = json_encode_utf8($json_data);

        file_put_contents($json_file, $json_data);
        
        header( "location: ./index.php" );
        exit();
    break;
    case "edit":

        $data['type'] = $_POST['data_type'];
        $data['name'] = $_POST['data_name'];
        $data['detail'] = $_POST['data_detail'];
        
        $json_check_data = file_get_contents($json_file);
        $data_check = json_decode($json_check_data, true);
        
        foreach ($data_check as $data_id_check => $data_val_check) {
            $json_data[$data_id_check] = $data_val_check;
            if($data_id_check==$data_id){
                $json_data[$data_id] = $data;
            }
        }
        
        $json_data = json_encode_utf8($json_data);

        file_put_contents($json_file, $json_data);
        
        header( "location: ./index.php" );
        exit();
    break;
    case "del":

        $json_check_data = file_get_contents($json_file);
        $data_check = json_decode($json_check_data, true);
        unset($data_check[$data_id]);

        foreach ($data_check as $data_id_check => $data_val_check) {
            $json_data[$data_id_check] = $data_val_check;
        }
        
        $json_data = json_encode_utf8($data_check);

        file_put_contents($json_file, $json_data);
          
        header( "location: ./index.php" );
        exit;
    break;
}

//Json Pretty Print PHP 5.2
function jsonpp($json, $istr = '  ')
{
    $result = '';
    for($p=$q=$i=0; isset($json[$p]); $p++)
    {
        $json[$p] == '"' && ($p>0?$json[$p-1]:'') != '\\' && $q=!$q;
        if(strchr('}]', $json[$p]) && !$q && $i--)
        {
            strchr('{[', $json[$p-1]) || $result .= "\n".str_repeat($istr, $i);
        }
        $result .= $json[$p];
        if(strchr(',{[', $json[$p]) && !$q)
        {
            $i += strchr('{[', $json[$p])===FALSE?0:1;
            strchr('}]', $json[$p+1]) || $result .= "\n".str_repeat($istr, $i);
        }
    }
    return $result;
}
//JSON_UNESCAPED_UNICODE PHP 5.2
function json_encode_utf8($json) {
   return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($json));
}