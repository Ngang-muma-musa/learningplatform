<?php
 require "../includes/db.inc.php";
 $parent_id = "679165995";

 $sql = "SELECT * FROM lessons WHERE parent_id = '$parent_id'";
 $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lessons</title>	
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
          <a href="lessons.php" class="btn btn-primary py-2 px-8">LESSONS</a>
        </div>
    </div>
      <div class="col-md-4">
        <div class="pray text-center  shadow-sm p-3 mb-5 bg-white rounded">
          <img src="../images/qa.png" alt="image" height="120px"><br><br>
          <a href="questions.php" class="btn btn-primary py-2 px-8">QUESTIONS</a>
        </div>
    </div>
    </div>
    <h1 class=" text-center">GO THROUGH THE FOLLOWING LESSONS</h1><br>
<div class="row p-4">
   <?php 
      while ($row =  mysqli_fetch_assoc($result)) {
      	$lesson_id  = $row['lesson_id'];
        $parent_id  = $row['parent_id'];
      	$lesson_type  = $row['lesson_type'];
      	$lesson_instructions  = $row['lesson_description'];
      	?>
           
   	        <div class="col-md-4 text-center">
              <div class="card">
                <div class="card-img">
                <img src="../images/<?php if($lesson_type == 'IMAGE' ){
                  echo 'img.jpg';
                }elseif($lesson_type == 'VIDEO'){
                  echo 'video.png';
                }elseif($lesson_type == 'YOUTUBE'){
                   echo 'youtube.png';
                }else{
                  echo 'text.jpg';
                } ?>" alt="image" class="img-responsive p-4 " height="200"> 
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?php if (strlen($lesson_instructions)) {
                    	echo substr($lesson_instructions, 0, 16) . "...";
                    }else{
                    	echo $lesson_instructions;
                    } ?></h3>
                    <hr>
                    <a href="lesson_display.php?id=<?php echo $parent_id.$lesson_id;?>&type=<?php echo $lesson_type;?>&lesson_id=<?php echo $lesson_id?>" class="btn btn-primary py-2 px-8">VIEW LESSON</a>
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