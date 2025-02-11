
<?php $page_title = 'Question Display'; ?>
<?php $page_title = 'Quiz Master > Question Display'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="questions_list.php";
    verifyLogin($page);

?>

<style>

.image-centered {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 400;
        height: auto;
}
</style>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>

<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM questions
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
      die ('There was an error running query[' . $db->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "fileRealFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "fileTypeFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyQuestion'])){
        if($_GET["modifyQuestion"] == "fileExistFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
        }
      }

      //--------------My draft
      echo '<h2 id="title">Question Display</h2><br>';
      echo '<img class="image-centered" src="' .$row["image_name"]. '" alt="'.$row["image_name"].'  ">';
      $sql_keywords = "SELECT k.keyword FROM keywords k
        INNER JOIN question_keywords qk ON k.id = qk.keyword_id
        WHERE qk.question_id = '".$id."'";

      $keywords_result = $db->query($sql_keywords);

      $keywords_array = array();
      while($keyword_row = $keywords_result->fetch_assoc()) {
    $keywords_array[] = $keyword_row['keyword'];
    }
    $keywords_string = implode(', ', $keywords_array);

      echo '<h3>'.$row["topic"].' - '.$row["question"].'? </h3> <br>';

      echo '<h4>Keywords</h4>';
      echo '<p>'.$keywords_string.'</p><br>';

      echo '<div>

      <h4>Choice 1</h4>
      <p>'.$row["choice_1"].'</p><br>

      <h4>Choice 2</h4>
      <p>'.$row["choice_2"].'</p><br>

      <h4>Choice 3</h4>
      <p>'.$row["choice_3"].'</p><br>

      <h4>Choice 4</h4>
      <p>'.$row["choice_4"].'</p><br>

      
      </div>';

      
    
    }//end while
}//end if
else {
    echo "0 results";
}//end else

?>

</div>


