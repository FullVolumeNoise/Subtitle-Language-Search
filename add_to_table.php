<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Subtitle Language Search </title>
</head>
<body>
  <header> <h1>Find a subtitle language today!</h1>
    <nav> <a href="index.php" style="padding-right: 25px; ">Database</a> <a href="about.html">About</a> <a href="add_to_table.php">Add to Database</a></nav>
  </header>

  <div class="new_media"> 
    <form action="add_to_table.php" method="get"> Have a show/movie to submit? Enter the data and add to the database? <br/>
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
  
</body>
  </html>