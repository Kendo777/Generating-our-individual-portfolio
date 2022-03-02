<?php
header( "refresh:7;url=index.php" );
if(!empty($_FILES['uploaded_file']))
    {
      $path = $_POST['dir'].DIRECTORY_SEPARATOR.$_POST['unit'].DIRECTORY_SEPARATOR.$_POST['lesson'].DIRECTORY_SEPARATOR;
      $path = $path . basename( $_FILES['uploaded_file']['name']);

      if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        echo 'The file:<b>'.basename( $_FILES['uploaded_file']['name']). 
        '</b> has been uploaded in the path:<i>'.$_POST['dir'].'/'.$_POST['upload'].'</i>.<br>
        <h3>You will be redirected to the homepage in 7 seconds</h3><br>
        <p>Or <a href="index.php?&unit='.$_POST['unit'].'&lesson='.$_POST['lesson'].'">click here</a> to go now';
      } else{
          echo "There was an error uploading the file, please try again!";
      }
    }

  
?>