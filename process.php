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
    $count =ceil(count($posts));
    // var_dump($count);
    // die();
    $string=array();
    $string['main']=array();
    $string['first']="
        <thead>
            <tr>
                <td>leads_id</td>
                <td>first name</td>
                <td><last name/td>
                <td>registered datetime</td>
                <td>email</td>
            </tr>
        </thead>";
    $string['page']="";    
    for ($i=0; $i < ($count/20); $i++) 
    {   
        $string['page'].="<a href=''>{$i}</a>";
        // $string['main'][$i].=""
        for ($j=0; $j < 20; $j++) 
        { 
            $string['main'][$i]='';
            foreach ($posts as $key => $value) 
            {
                $string['main'][$i].="
                    <tr>
                        <td>{$value['leads_id']}</td>
                        <td>{$value['first_name']}</td>
                        <td>{$value['last_name']}</td>
                        <td>{$value['registered_datetime']}</td>
                        <td>{$value['email']}</td>
                    </tr>";
            }
        }    
    }   
    // $stringPosts = "<td>{$posts[0]['description']}</td>";
echo json_encode($string); 
}
?>