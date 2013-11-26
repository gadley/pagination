<?php
require("connection.php");
if(isset($_POST) && !empty($_POST))
{
    $note= mysql_real_escape_string($_POST['nameSearch']);
    // $queryInsert = "INSERT into posts (description, created_at, updated_at) values ('{$note}', NOW(), NOW())";
    // // mysql_query($queryInsert);
    $queryName = "SELECT leads_id , first_name, last_name, registered_datetime, email FROM lead_gen_business.leads
    where first_name like '{$note}%'";
    $posts = fetch_all($queryName);
    // var_dump($posts);
    // die();
    $count =ceil(count($posts)/20);
    $string=array();
    $string['thead']="
        <thead>
            <tr>
                <td>leads_id</td>
                <td>first name</td>
                <td>last name</td>
                <td>registered datetime</td>
                <td>email</td>
            </tr>
        </thead>";
    $string['main']=array();    
    $string['page']="";    
    for ($i=1; $i < ($count)+1; $i++) 
    {   
        $string['page'].="<a href='#'>{$i}</a> | ";
        $string['main'][$i]="";
        for ($j=0; $j < 20; $j++) 
        { 
            $t = ($i - 1)*20 + $j;
            if(!empty($posts[$t])) 
            {
                $string['main'][$i].="
                    <tr>
                        <td>{$posts[$t]['leads_id']}</td>
                        <td>{$posts[$t]['first_name']}</td>
                        <td>{$posts[$t]['last_name']}</td>
                        <td>{$posts[$t]['registered_datetime']}</td>
                        <td>{$posts[$t]['email']}</td>
                    </tr>";
            }
        }    
    }   
    // $stringPosts = "<td>{$posts[0]['description']}</td>";
echo json_encode($string); 
}
?>