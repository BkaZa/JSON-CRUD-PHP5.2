<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>JSON CRUD</title>
</head>
<body>
    <form id="frm" action="" method="post">
        <input type="hidden" id="proc" name="proc" value="">
        <input type="hidden" id="data_id" name="data_id" value="">
    </form>
    
    <h1>JSON Simple CRUD</h1>
    
    <div>
        <button id="add_data">Add</button>
    </div>
    <br>
    
    <table border="1">
        <tr>
            <th>#</th>
            <th>Data ID</th>
            <th>Data Type</th>
            <th>Data Name</th>
            <th>Data Detail</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>
            <?php
                $json_data = @file_get_contents('./data.json');
                $arr_data = json_decode($json_data, true);
                $td=''; $i=1;

                foreach ($arr_data as $data_id => $data) {
              
                    $btn_edit = '<button onclick="btn_proc(\''.$data_id.'\',\'edit\')">Edit</button>';
                    $btn_delete = '<button onclick="btn_proc(\''.$data_id.'\',\'del\')">Delete</button>';
                    
                    $td.='<tr>';
                    $td.='<td>'.$i.'</td>';
                    $td.='<td>'.$data_id.'</td>';
                    $td.='<td>'.$data['type'].'</td>';
                    $td.='<td>'.$data['name'].'</td>';
                    $td.='<td>'.$data['detail'].'</td>';
                    $td.='<td>'.$btn_edit.'</td>';
                    $td.='<td>'.$btn_delete.'</td>';
                    $td.='</tr>';
                    
                $i++;
                }
                echo $td;
            ?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">
    var add_data = document.querySelector('#add_data');
    
    add_data.onclick = function(){
       document.querySelector('#proc').value = 'add';
       document.querySelector('#frm').action = './json_manage.php'; 
       document.querySelector('#frm').submit();
    }
function btn_proc(id, proc){
        document.querySelector("#proc").value = proc;
        document.querySelector("#data_id").value = id;
        
        var url = './json_proc.php';
        if(proc!='del'){
            url = './json_manage.php';
        }
        
        document.querySelector("#frm").action = url;
        document.querySelector("#frm").submit();
}    
</script>
</html>