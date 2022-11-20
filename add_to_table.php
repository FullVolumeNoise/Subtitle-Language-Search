<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Subtitle Language Search </title>
</head>
<header> <h1>~ Find a subtitle language today! ~</h1>
    <nav> <a href="index.php" style="padding-right:30px">Database</a> <a href="about.html" style="padding-right:30px">About</a> <a href="add_to_table.php" style="padding-right:30px">Add to Database</a> </nav>
  </header>
<body>
 
    <br>
  <div class="new_media"> 
    <form action="add_to_table.php" method="get"> <h3>Have a show/movie to submit? Enter the data and add to the database!</h3> <br/>
      <!--Name to be entered into table -->
      <label>Name of TV show or movie:</label> <input type="text" id="name" name="name" placeholder="TV show or movie" required> </input><br/><br/>
      <!--Comment to be entered into table -->
      <label>Languages:</label> <br>
      <textarea id="langs" name="langs" placeholder="Languages the subtitles are available in" required></textarea>
      <br/><br/>
      <label>Platform:</label> <input type="textarea" id="plat" name="plat" placeholder="Platform the TV show/movie is on" required>  </input>
      <br/><br/>
      <button type="submit" value="Add to the database">Add to the database</button>
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
<footer> This project is part of the M&T 2022 Hackathon. </footer>
  </html>