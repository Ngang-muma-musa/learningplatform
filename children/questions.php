<?php
 require "../includes/db.inc.php";
 $parent_id = "679165995";

 $sql = "SELECT * FROM questions WHERE parent_id = '$parent_id'";
 $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Questions</title>	
<?php include '../includes/styles_js_importer.php'; ?>
<style type="text/css">
	body{
		padding-top: 1rem;
	}
	 .col-md-4{
        margin-bottom: 20px;
      }
        h1{
        color: white;
      }
</style>
</head>
<body class="bg-primary">
<div class="container">
	<div class="row p-4">
    <div class="col-md-4">
        <div class="pray text-center  shadow-sm p-3 mb-5 bg-white rounded">
          <img src="../images/home1.png" alt="image" height="120px"><br><br>
          <a href="childrenUI.php" class="btn btn-primary py-2 px-8">HOME</a>
        </div>
    </div>
       <div class="col-md-4">
        <div class="pray text-center  shadow-sm p-3 mb-5 bg-white rounded">
          <img src="../images/tick.webp" alt="image" height="120px"><br><br>
          <a href="#" class="btn btn-primary py-2 px-8"> QUESTIONS</a>
        </div>
    </div>
      <div class="col-md-4">
        <div class="pray text-center  shadow-sm p-3 mb-5 bg-white rounded">
          <img src="../images/cross.png" alt="image" height="120px"><br><br>
          <a href="#" class="btn btn-primary py-2 px-8">CORRECTION</a>
        </div>
    </div>
    </div>
    <h1 class=" text-center">ANSWERE THE FOLLOWING QUESTIONS</h1><br>
<div class="row p-4">
   <?php 
      while ($row =  mysqli_fetch_assoc($result)) {
      	$question_id  = $row['question_id'];
        $parent_id  = $row['parent_id'];
      	$question_type  = $row['question_type'];
      	$question_instructions  = $row['question_description'];
      	?>
           
   	        <div class="col-md-4 text-center">
              <div class="card">
                <div class="card-img">
                <img src="../images/<?php if($question_type == 'IMAGE' ){
                  echo 'img.jpg';
                }elseif($question_type == 'VIDEO'){
                  echo 'video.png';
                }elseif($question_type == 'YOUTUBE'){
                   echo 'youtube.png';
                }else{
                  echo 'text.jpg';
                } ?>" alt="image" class="img-responsive p-4 " height="200"> 
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?php if (strlen($question_instructions)) {
                    	echo substr($question_instructions, 0, 16) . "...";
                    }else{
                    	echo $question_instructions;
                    } ?></h3>
                    <hr>
                    <a href="question_display.php?id=<?php echo $parent_id.$question_id;?>&type=<?php echo $question_type;?>&question_id=<?php echo $question_id?>" class="btn btn-primary py-2 px-8">ANSWER QUESTION</a>
                </div>
               </div>
            </div>    
       	<?php
      }
   ?>
   </div>
</div>
</div>
</body>
</html>