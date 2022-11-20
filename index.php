<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Subtitle Language Search </title>
</head>
<body>
  <header> <h1>Find a subtitle language today!</h1>
    <nav> <a href="index.php" style="padding-right: 25px; ">Database</a> <a href="about.html">About</a> </nav>
  </header>

  <div class="new_media"> 
    <form action="index.php" method="get"> Have a show/movie to submit? Enter the data and add to the database? <br/>
      <!--Name to be entered into table -->
      <label>Name of TV show or movie:</label> <input type="text" id="name" name="name"> </input><br/><br/>
      <!--Comment to be entered into table -->
      <label>Languages:</label> <input type="text" id="langs" name="langs">  </input>
      <br/><br/>
      <label>Platform:</label> <input type="text" id="plat" name="plat">  </input>
      <br/><br/>
      <input type="submit" value="Add to the List">
    </form>
<?php 
    include "../../dbCon.php";
  if ($mysqli) {
    //if the name and comment fields aren't empty, then do the next thing
    if( !empty($_GET['name']) && !empty($_GET['langs']) && !empty($_GET['plat'])){
      //inserts the input into the table
      $stmt=$mysqli->prepare("insert into mediaDatabase (title, languages, platforms) values (?, ?, ?)");
      $stmt->bind_param("sss",$_GET['name'],$_GET['langs'], $_GET['plat']);
      $stmt->execute();
      $stmt->close();
    }
    $res=$mysqli->query('select name, langs, plat from mediaDatabase');
    if($res){
      while($rowHolder = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        $records[] = $rowHolder;
      }
    }
  }


  
?>
  </div>
  
<div class="filter">
    <form>
      <input type="radio" name="services" value="services">
				<label for="netflix">Netflix</label><br>
				<input type="radio" name="services" value="hulu">
				<label for="hulu">Hulu</label><br>

				<p>
					<input type="submit"  name="Submit"  value="Send_Form" action="index.php" method="post" />
				</p>
    </form>

    <?php
      include "../../dbCon.php";


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
          
          $extra_output = '<div class="movie_entry"> <h3>Title: ' . $value['title'] . '</h3> <h4>Platform: ' .$value['platforms']. '</h4><br> <h4>Languages</h4><br> <p> ' .
           $value['languages'] . '</p> </div>' ;
          
        echo $extra_output;
    }

?>

    </div>

</div>


</body>



<footer> Bottom! </footer>
</html>
