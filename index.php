<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Subtitle Language Search </title>
</head>
<body>
  <header> <h1>Find a subtitle language today!</h1>
    <nav> <a href="index.php" style="padding-right:30px">Database</a> <a href="about.html" style="padding-right:30px">About</a> <a href="add_to_table.php" style="padding-right:30px">Add to Database</a> </nav>
  </header>

  <div class="search">
  <form action="index.php" method="get">
      <input type="text" placeholder="Search.." name="search" value="search">
      <button type="submit" name="Submit"  value="Send_Form">Search</button>
    </form>
    <?php 
      include "../../dbCon.php";

      if(!empty($_GET['search'])){
        $search = $_GET['search'];
        $sql = "SELECT * FROM `mediaDatabase` WHERE `title` LIKE '%$search%'";

        if($results = $mysqli->query($sql)){
          echo 'Showing results for ' .$search;
         
          if($results){
           while($rowHolder = mysqli_fetch_array($results, MYSQLI_ASSOC)){
             $records[] = $rowHolder;
             }
           }
           var_dump($records); 
     
           $things = array();
           
     
           foreach($records as $name=>$value){
               
               $extra_output = '<div class="movie_entry"> <h3>Title: ' . $value['title'] . '</h3> <h4>Platform: ' .$value['platforms']. '</h4><h4>Languages</h4><p> ' .
               $value['languages'] . '</p> </div>' ;
               
             echo $extra_output;
         }
       } else{
         echo 'issue with query';
       }


      } 


    ?>



  </div>

<div class="filter">
    <form action="index.php" method="post">
      <input type="radio" name="services" value="Netflix">
				<label for="netflix">Netflix</label><br>
				<input type="radio" name="services" value="Hulu">
				<label for="hulu">Hulu</label><br>

				<p>
					<input type="submit"  name="Submit"  value="Send_Form" />
				</p>
    </form>

    <?php
      include "../../dbCon.php";

     
     
      if(!empty($_POST['services'])){
        $service = $_POST['services'];
      $sql = "SELECT * FROM `mediaDatabase` WHERE `platforms` = '$service'";
      

      if($results = $mysqli->query($sql)){
         echo 'Showing results for ' .$service;
        
         if($results){
          while($rowHolder = mysqli_fetch_array($results, MYSQLI_ASSOC)){
            $records[] = $rowHolder;
            }
          }
          var_dump($records); 
    
          $things = array();
          
    
          foreach($records as $name=>$value){
              
              $extra_output = '<div class="movie_entry"> <h3>Title: ' . $value['title'] . '</h3> <h4>Platform: ' .$value['platforms']. '</h4><h4>Languages</h4><p> ' .
              $value['languages'] . '</p> </div>' ;
              
            echo $extra_output;
        }
      } else{
        echo 'issue with query';
      }
    }

      /*
      $streaming = $_GET['services'];
    
      switch ($streaming){
        case 'hulu':
          echo 'Hulu results: ';
          $sql = 'SELECT * FROM `mediaDatabase` WHERE platforms =Hulu';
          break; 
      }
*/
    ?>
  </div>

  <div class="media_database">
    
    <?php
      include "../../dbCon.php";

      $sql = 'select * from `mediaDatabase`';
    
      if($results = $mysqli->query($sql)){
        printf("select returned %d rows<br></br>", $results->num_rows);
      } else{
        echo 'issue with query';
      }

      //print var_dump($results);

      if($results){
        while($rowHolder = mysqli_fetch_array($results, MYSQLI_ASSOC)){
          $records[] = $rowHolder;
        }
      }
      var_dump($records); 

      $things = array();
      

      foreach($records as $name=>$value){
          
          $extra_output = '<div class="movie_entry"> <h3>Title: ' . $value['title'] . '</h3> <h4>Platform: ' .$value['platforms']. '</h4><h4>Languages</h4><p> ' .
           $value['languages'] . '</p> </div>' ;
          
        echo $extra_output;
    }

?>

    </div>

</div>


</body>



<footer> Bottom! </footer>
</html>
