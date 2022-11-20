<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Subtitle Language Search </title>
</head>
<body>
  <header> <h1>Find a subtitle language today!</h1>
<nav><a href="index.php" style="padding-right: 25px; ">Database</a> <a href="about.html">About</a></nav>
</header>

  <form>
    <label for="search">Enter the name of a film or show:</label>
    <input type="text" id="search" name="search" placeholder="Search.." cursor: pointer;>
    <button type="submit" action="index.php" method="post">Search</button>
  </form>
  <p> Showing results for: </p>
  <?php 
  //echo $_GET["search"];
  if(!empty($_GET)){
    $searchPhrase = $_GET["search"];
    $sql = 'SELECT * from `mediaDatabase` WHERE title IN ($searchPhrase)';
    echo $sql;
  }
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
      

      //$things = array_keys($records);
      //print_r($records);
     
      foreach($records as $name=>$value){
       
          
          $extra_output = '<div class="movie_entry"> <h3>Title: ' . $value['title'] . '</h3> <h4>Platform: ' .$value['platforms']. '</h4><br> <h4>Languages</h4><br> <p> ' .
           $value['languages'] . '</p> </div>' ;
          //things[2]
        echo $extra_output;
    }
   
     
      

?>

    </div>

</div>


</body>



<footer> Bottom! </footer>
</html>
