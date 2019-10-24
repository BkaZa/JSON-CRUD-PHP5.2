<?php

$json_file = './data.json';

if($proc=='add'){
    $data_id = uniqid();
}else{
    
    $json_data = file_get_contents($json_file);
    $data = json_decode($json_data, true);
    
    $data_type = $data[$data_id]['type'];
    $data_name = $data[$data_id]['name'];
    $data_detail = $data[$data_id]['detail'];
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>JSON <?= strtoupper($proc)?> [<?=$keyword?>]</title>
</head>
<body>
    <form id="frm" action="./json_proc.php" method="post">
        <input type="hidden" id="proc" name="proc" value="<?=$proc?>">
        
        <div>
            <h1>Data ID : <?=$data_id?> <input type="hidden" id="data_id" name="data_id" value="<?=$data_id?>"></h1>
            <div>
                <p><b>Data type : </b><input type="text" id="data_type" name="data_type" value="<?=$data_type?>" autocomplete="off"></p>
                <p><b>Data Name : </b><input type="text" id="data_name" name="data_name" value="<?=$data_name?>" autocomplete="off"></p>
                <p><b>Data Detail : </b><textarea id="data_detail" name="data_detail"><?=$data_detail?></textarea></p>
            </div>
        </div>
        
        <button type="submit"> <?= strtoupper($proc)?> </button>
    </form>
</body>
</html>