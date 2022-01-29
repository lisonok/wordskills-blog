
<?php

$connect = new PDO('mysql:host=ba5t3ohg1kijtaboujzj-mysql.services.clever-cloud.com;dbname=ba5t3ohg1kijtaboujzj', 'uuwamzqhmxdxw5v1', 'wGXZTn9n50oBlGaxZhrT');

$query = "
SELECT * FROM posts 
WHERE parent_post_id = '0' 
ORDER BY post_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach ($result as $row) {
    $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>' . $row["post_title"] . '</b> on <i>' . $row["date"] . '</i></div>
  <div class="panel-body">' . $row["post"] . '</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="' . $row["post_id"] . '">Дополнить</button></div>
 </div>
 ';
    $output .= get_reply_post($connect, $row["post_id"]);
}

echo $output;

function get_reply_post($connect, $parent_id = 0, $marginleft = 0)
{
    $query = "
 SELECT * FROM posts WHERE parent_post_id = '" . $parent_id . "'
 ";
    $output = '';
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $count = $statement->rowCount();
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }
    if ($count > 0) {
        foreach ($result as $row) {
            $output .= '
   <div class="panel panel-default" style="margin-left:' . $marginleft . 'px">
    <div class="panel-heading">By <b>' . $row["post_title"] . '</b> on <i>' . $row["date"] . '</i></div>
    <div class="panel-body">' . $row["post"] . '</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="' . $row["post_id"] . '">Дополнить</button></div>
   </div>
   ';
            $output .= get_reply_post($connect, $row["post_id"], $marginleft);
        }
    }
    return $output;
}

?>