<?php 
require "../includes/db.inc.php";
if (isset($_GET['type'])&&isset($_GET['id'])) {
    $id = $_GET['id'];

    $type  = $_GET['type'];

    $lesson_id =  $_GET['lesson_id'];

    $sql = "SELECT * FROM lesson_content WHERE lesson_id = '$id' ";
    $result = mysqli_query($conn,$sql);

    $sql2 = "SELECT lesson_description FROM lessons WHERE lesson_id = $lesson_id";
    $result2 = mysqli_query($conn,$sql2);

    while ($row  = mysqli_fetch_assoc($result2)) {
    	$instruction = $row['lesson_description'];
    }

    ?>


    <!DOCTYPE html>
    <html>
    <head>
    	<title>Answer Questions</title>
    	<?php include '../includes/styles_js_importer.php'; ?>
    	<style type="text/css">
    		body{
    			padding-top: 1rem;
    		}
    		.videoembed{
    			position: relative;
    			padding-bottom: 56.25%;
    			padding-top: 25px;
    			height: 0px;
    		}
    		.videoembed embed{
    			position: absolute;
    			left: 0px;
    			top: 0px;
    			right: 0px;
    			bottom: 0px;
    			height: 100%;
    			width: 100%;
    		}
    		.videoembed video{
    			position: absolute;
    			left: 0px;
    			top: 0px;
    			right: 0px;
    			bottom: 0px;
    			height: 100%;
    			width: 100%;
    		}
    		.left{
    			float:right;
    		}
    		.btnn{
    			width: 100%;
    		}
    		#hide{
    			display: none;
    		}
    	</style>
    </head>
    <body class="bg-primary">
    <div class="container">
    	<?php
          if ($type == "TEXT") {
          	while ($row  = mysqli_fetch_assoc($result)) {
             $id = $row['id'];
             $timestamp_id = $row['timestamp_id'];
        	   $question_id = $row['lesson_id'];
        	   $content = $row['content'];
             
        	   ?>
        	   <div class="row">
        	   	<div class="col-md-2"></div>
        	   	<div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
        	   		<h1 class="text-center"><?php echo $instruction; ?></h1><br>
        	   		<h5 class="text-center"><?php echo $content;?></h5><br>
        	   	</div>
        	   	<div class="col-md-2"></div>
        	   </div><br><br>
        	   <?php
            }
                  $_SESSION['id'] = $id;
                  $_SESSION['lesson_id'] = $question_id ;
                  $_SESSION['timestamp_id'] = $timestamp_id;
                  $_SESSION['lesson_content_id'] =  $question_content_id;
          }
          elseif($type == "YOUTUBE"){
            while ($row  = mysqli_fetch_assoc($result)) {
               $id = $row['id'];
               $timestamp_id = $row['timestamp_id'];
          	   $question_id = $row['lesson_id'];
          	   $content = $row['content'];
          	   $content = preg_replace("#.*youtube\.com/watch\?v=#", "", $content);
          	  
          	   ?>
          	   <div class="row">
          	   	<div class="col-md-2"></div>
          	   	<div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
          	   		<h1 class="text-center"><?php echo $instruction; ?></h1><br>
          	   		<div class="videoembed">
          	   			<embed src="https://www.youtube.com/embed/<?php echo $content?>"></embed>
          	   		</div><br>
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div>
              
          	   <?php
            } 
                $_SESSION['id'] = $id;
                $_SESSION['lesson_id'] = $question_id ;
                $_SESSION['timestamp_id'] = $timestamp_id;
                $_SESSION['lesson_content_id'] =  $question_content_id;
          }
          elseif($type == "VIDEO"){
            while ($row  = mysqli_fetch_assoc($result)) {
               $id = $row['id'];
               $timestamp_id = $row['timestamp_id'];
          	   $lesson_id = $row['lesson_id'];
          	   $content = $row['content'];
          	   ?>
          	   <div class="row">
          	   	<div class="col-md-2"></div>
          	   	<div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
          	   		<h1 class="text-center"><?php echo $instruction; ?></h1><br>
          	   		<div class="videoembed">
          	   			<video src="../uploads/<?php echo $content; ?>"  controls></video>
          	   		</div><br>
          	   		<div class="button">
          	   			<button class="btn btn-primary">  < PREVIOUS </button>
          	   			<button class="btn btn-primary">  NEXT > </button>
          	   		</div>
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div>
          	   <?php
            }
                $_SESSION['id'] = $id;
                $_SESSION['lesson_id'] = $question_id ;
                $_SESSION['timestamp_id'] = $timestamp_id;
                $_SESSION['lesson_content_id'] =  $question_content_id;
          }
          elseif($type == "IMAGE"){

             ?>
               <div class="row">
          	   	<div class="col-md-2"></div>
                <h1 class="text-center"><?php echo $instruction; ?></h1><br>
          	   	<div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
                   <div id="demo" class="carousel slide" data-ride="carousel">   

                    <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <?php 
                       $i=0;
                       foreach ($result as $row) {
                        $active = '';
                        if($i == 0){
                             $active = 'active';
                        }
                    ?>
                    
                      <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php echo $active;?>"></li>
                     <?php $i++;}?>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                    <?php 
                       $i=0;
                       foreach($result as $row){
                        $id = $row['id'];
                        $question_id = $row['lesson_id'];
                          $content = $row['content'];
                        $active = '';
                        if($i == 0){
                             $active = 'active';
                        }
                    ?>
                                  <?php echo$id;?>
                      <div class="carousel-item <?= $active;?>">
                        <img src="../uploads/<?= $row['content'];?>" height="400" width="100%">
                      </div>
                   <div class="carousel-caption">
                          <h3><?php echo$id;?></h3>
                        </div>
                     <?php $i++;}?>
                    </div>
                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                      <span class="carousel-control-next-icon"></span>
                    </a>

                  </div>
                  
                      <!-- carousel ends -->
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div>
             <?php
          }
    	?>
    </div>

    <script type="text/javascript">	
    	function myHide() {
    		const x = document.getElementById("hide");
    		if(x.style.display == "none"){
                x.style.display="block";
    		}else{
    			x.style.display="none";
    		}
    	}
    </script>
    </body>
    </html>


    <?php

}else{
	header("Location:questions.php");
	exit();
}
?>