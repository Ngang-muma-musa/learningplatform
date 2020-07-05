<?php 
require "../includes/db.inc.php";
if (isset($_GET['type'])&&isset($_GET['id'])) {
    $id = $_GET['id'];

    $type  = $_GET['type'];

    $question_id =  $_GET['question_id'];

    $sql = "SELECT * FROM question_content WHERE question_id = '$id' ";
    $result = mysqli_query($conn,$sql);

    $sql2 = "SELECT question_description FROM questions WHERE question_id = $question_id";
    $result2 = mysqli_query($conn,$sql2);

    while ($row  = mysqli_fetch_assoc($result2)) {
    	$instruction = $row['question_description'];
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
         .col-md-4{
        margin-bottom: 20px;
      }
    		#hide{
    			display: none;
    		}
        h2{
          color: white;
        }
    	</style>
    </head>
    <body class="bg-primary">
    <div class="container">
    	<?php
          if ($type == "TEXT") {
          	while ($row  = mysqli_fetch_assoc($result)) {
               $id = $row['id']; 
          	   $question_content_id = $row['question_id'];
               $timestamp_id = $row['timestamp_id'];
          	   $content = $row['content'];
          	   ?>
          	   <div class="row">
                <?php 
                
                $sql3 = "SELECT * FROM answer WHERE id = $id";
                $result3 = mysqli_query($conn,$sql3);
                while($rows = mysqli_fetch_assoc($result3)){
                $answer = $rows['answer'];
                }

                ?>
          	   	<div class="col-md-2"></div>
          	   	<div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
          	   		<h1 class="text-center"><?php echo $instruction; ?></h1><br>
          	   		<h5 class="text-center"><?php echo $content;?></h5><br>
          	   		<div class="button">
          	   			<button onclick="myHide()" class="btn btn-primary left"> VIEW ANSWER</button>
          	   		</div><br>
          	   		<div id="hide">
                    <label for="question_description">ANSWER</label>
                    <textarea class="form-control" id="answer" name="answer" rows="3" placeholder="<?php echo $answer; ?>" ></textarea><br>
                    <button class="btn btn-success">CORRECT</button>
                    <button class="btn btn-danger">Wrong</button><br><br>
                  
          	   		<form class="md-form" method="post" action="children_includes/question_display.inc.php">
          	   			<div class="form-grop">
						<label for="question_description">Type Correction here if answer was wrong</label>
						<textarea class="form-control" id="answer" name="answer" rows="3" placeholder="type Correction..." ></textarea>
					</div><br>
					<button class="btn btn-primary btnn" type="submit" name="submit_ans">SUBMIT</button>
          	   		</form>
                  </div><br>
          	   		</div>
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div><br><br>
          	   <?php
            }
            
          session_start();
          $_SESSION['id'] = $id;
          $_SESSION['question_id'] = $question_id ;
          $_SESSION['timestamp_id'] = $timestamp_id;
          $_SESSION['question_content_id'] =  $question_content_id;


          }
          elseif($type == "YOUTUBE"){
            while ($row  = mysqli_fetch_assoc($result)) {
               $id = $row['id']; 
          	   $question_content_id = $row['question_id'];
               $timestamp_id = $row['timestamp_id'];
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
          	   		<div class="button">
          	   			<button onclick="myHide()" class="btn btn-primary left"> VIEW ANSWER</button>
          	   		</div><br>
          	   		<div id="hide">
          	   		<form class="md-form" method="post" action="children_includes/question_display.inc.php">
          	   			<div class="form-grop">
						<label for="question_description">Type Answer Here</label>
						<textarea class="form-control" id="answer" name="answer" rows="3" placeholder="type answer..." ></textarea>
					</div><br>
					<button class="btn btn-primary btnn" type="submit" name="submit_ans">SUBMIT</button>
          	   		</form>
          	   		</div>
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div>
          	   <?php
            }

            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['question_id'] = $question_id ;
            $_SESSION['timestamp_id'] = $timestamp_id;
            $_SESSION['question_content_id'] =  $question_content_id;

          }
          elseif($type == "VIDEO"){
            while ($row  = mysqli_fetch_assoc($result)) {
               $id = $row['id']; 
          	   $question_content_id = $row['question_id'];
               $timestamp_id = $row['timestamp_id'];
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
          	   			<button onclick="myHide()" class="btn btn-primary left">VIEW ANSWER</button>
          	   		</div>
          	   		<div id="hide">
          	   		<form class="md-form" method="post" action="children_includes/question_display.inc.php">
          	   			<div class="form-grop">
						<label for="question_description">Type Answer Here</label>
						<textarea class="form-control" id="answer" name="answer" rows="3" placeholder="type answer..." ></textarea>
					</div><br>
					<button class="btn btn-primary btnn" type="submit" name="submit_ans">SUBMIT</button>
          	   		</form>
          	   		</div>
          	   	</div>
          	   	<div class="col-md-2"></div>
          	   </div>
          	   <?php
            }

          session_start();
          $_SESSION['id'] = $id;
          $_SESSION['question_id'] = $question_id ;
          $_SESSION['timestamp_id'] = $timestamp_id;
          $_SESSION['question_content_id'] =  $question_content_id;

          }
      


                      elseif($type == "IMAGE"){

             ?>
               <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 shadow-sm p-3 mb-5 bg-white rounded">
                    <h1 class="text-center"><?php echo $instruction; ?></h1><br>
                    <div class="videoembed">

                    <!-- carouel starts -->

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
                         echo $id = $row['id'];
                            $question_id = $row['question_id'];
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


                    
                    </div><br>
                    <div class="button">
                        <button class="btn btn-primary">  < PREVIOUS </button>
                        <button class="btn btn-primary">  NEXT > </button>
                        <button onclick="myHide()" class="btn btn-primary left">VIEW ANSWER</button>
                    </div>
                    <div id="hide">
                    <form class="md-form" method="post" action="">
                        <div class="form-grop">
                        <label for="question_description">Type Answer Here</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3" placeholder="type answer..." ></textarea>
                    </div><br>
                    <button class="btn btn-primary btnn" type="submit" name="submit_ans">SUBMIT</button>
                    </form>
                    </div>
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