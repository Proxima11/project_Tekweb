<?php
session_start();
require "connection.php";

if (!isset ($_SESSION["email"])){
	header("location: login-user.php");
}

if (isset($_POST['showsong'])){
	$sql="select * from audios order by tanggal_rilis DESC";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		$didengar = $row['didengar'];
		$pendengar = " ";
		if ($didengar/1000 >= 1){
			$didengar = $didengar/1000;
			if($didengar/1000 >= 1){
				$didengar = $didengar/1000;
				if($didengar/1000 >= 1){
					$didengar = $didengar/1000;
					$pendengar = $didengar." B";
				}
				else{
					$pendengar = $didengar." M";
				}
			}
			else{
				$pendengar = $didengar." K";
			}
		}
		else{
			$pendengar = $didengar;
		}
		if($counter <= 6){
			echo "
			<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5'>
			<img class='card-img' src='".$row['gambar']."'>
			<div class='details'>
			<button type='button' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
			<div class='row'>
			<divstyle='max-height: 0px; color:white;'>
			<i class='fa-solid fa-headphones' style='color: white;' id='heard'></i>
			</div>
			<div style='max-height: 0px; color:white;'>
			".$pendengar."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
		else{
			break;
		}
	}
	exit();
}

if (isset($_POST['popularsong'])){
	$sql="select * from audios order by didengar DESC";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		$didengar = $row['didengar'];
		$pendengar = " ";
		if ($didengar/1000 >= 1){
			$didengar = $didengar/1000;
			if($didengar/1000 >= 1){
				$didengar = $didengar/1000;
				if($didengar/1000 >= 1){
					$didengar = $didengar/1000;
					$pendengar = $didengar." B";
				}
				else{
					$pendengar = $didengar." M";
				}
			}
			else{
				$pendengar = $didengar." K";
			}
		}
		else{
			$pendengar = $didengar;
		}
		if($counter <= 6){
			echo "
			<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5'>
			<img class='card-img' src='".$row['gambar']."'>
			<div class='details'>
			<button type='button' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
			<div class='row'>
			<divstyle='max-height: 0px; color:white;'>
			<i class='fa-solid fa-headphones' style='color: white;' id='heard'></i>
			</div>
			<div style='max-height: 0px; color:white;'>
			".$pendengar."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
		else{
			break;
		}
	}
	exit();
}

if(isset($_POST['songicon']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
		echo "<img id='playimage' src='".$row['gambar']."'>";
	}
	exit();
}
if(isset($_POST['songinfo']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
		echo "
		<h4 id='playtitle'>".$row['nama']."</h4>
		<h7 id='playsinger'>".$row['penyanyi']."</h7>";
	}
	exit();
}

if(isset($_POST['playsong']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	echo "<div><button class='btn btn-empty border-0'>
	<i class='fa-solid fa-backward-step' style='color:grey'></i>
	</button>
	<button class='btn btn-empty border-0' id='playbutton'>
	<i class='fa-solid fa-play' style='color:white'></i>
	</button>
	<button class='btn btn-empty border-0'>
	<i class='fa-solid fa-forward-step' style='color:grey'></i>
	</button></div>";
	echo "<div>
	<button class='btn btn-empty border-0' onclick='back21()'>
	<i class='fa-solid fa-angles-left' style='color:white'></i>
	</button>30&nbsp;
	<button class='btn btn-empty border-0' onclick='back1()'>
	<i class='fa-solid fa-angle-left' style='color:white'></i>
	</button>10
	&nbsp;&nbsp;&nbsp;&nbsp;
	10<button class='btn btn-empty border-0' onclick='front1()'>
	<i class='fa-solid fa-angle-right' style='color:white'></i>
	</button>
	&nbsp;30
	<button class='btn btn-empty border-0' onclick='front21()'>
	<i class='fa-solid fa-angles-right' style='color:white'></i>
	</button>
	</div>";
	echo '<audio id="playingsong" autoplay="true" style="display:none;">
	<source src="'.$row[2].'" type="audio/wav">
	</audio>';
	exit();
}

if (isset($_POST['homemenu'])){
	echo"<br>
	<h3 style='float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;' class='mt-4'>New Releases</h3>
	<div class='wrap mt-6' style='background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;'>
	<div class='row' id='newarrival'>
	</div>
	</div>
	<h3 style='float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;' class='mt-4'>Most Played</h3>
	<div class='wrap mt-6' style='background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;'>
	<div class='row' id='popular'>
	</div>
	</div>
	<div class='slideshow-container mb-3 mt-5'>

	<div class='mySlides'>
	<img src='picture/promo3.jpg' style='width:100%; height:400px;'>
	</div>

	<div class='mySlides'>
	<img src='picture/promo2.jpg' style='width:100%; height:400px;'>
	</div>

	<div class='mySlides'>
	<img src='picture/promo4.jpg' style='width:100%; height:400px;'>
	</div>

	</div>
	<br>
	<div style='text-align:center'>
	<span class='dot'></span> 
	<span class='dot'></span> 
	<span class='dot'></span> 
	</div>";
	exit();
}

if(isset($_POST['search'])){
	$search_query = $_POST['search_query'];
	$sql="select * from audios where nama like '%$search_query%' or penyanyi like '%$search_query%' order by tanggal_rilis DESC";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		$didengar = $row['didengar'];
		$pendengar = " ";
		if ($didengar/1000 >= 1){
			$didengar = $didengar/1000;
			if($didengar/1000 >= 1){
				$didengar = $didengar/1000;
				if($didengar/1000 >= 1){
					$didengar = $didengar/1000;
					$pendengar = $didengar." B";
				}
				else{
					$pendengar = $didengar." M";
				}
			}
			else{
				$pendengar = $didengar." K";
			}
		}
		else{
			$pendengar = $didengar;
		}
		if($counter <= 6){
			echo "
			<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5'>
			<img class='card-img' src='".$row['gambar']."'>
			<div class='details'>
			<button type='button' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
			<div class='row'>
			<divstyle='max-height: 0px; color:white;'>
			<i class='fa-solid fa-headphones' style='color: white;' id='heard'></i>
			</div>
			<div style='max-height: 0px; color:white;'>
			".$pendengar."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
		else{
			break;
		}
	}
	exit();
}

if(isset($_POST['shownewplaylistoption']))
{	
	echo "
	<h8 style='color: white; margin-bottom:10px;''>Playlist Name :</h8><br><br>
	<input type='text' id='playlistname' style='width: 455px; float:middle; border-radius:10px'><br>
	<div style='height:1px; margin-left:10px; margin-right:10px; margin-top:30px; border-bottom: white 1px solid;'></div><br>";
	$sql="select * from audios";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
		echo "
		<div class='container' style='background-color: rgba(128,128,128,0.3); padding-top:5px; padding-bottom:5px; margin-top:10px; border-radius:30px;'>
		<div class='row' id='choosesong' style='padding-left: 20px;''>
		<div class='col-sm-2' id='playlistsongicon'>
		<img src='".$row['gambar']."' style='height: 50px; width: 50px'>
		</div>
		<div class='col-sm-8' style='float: left; color:whitesmoke;''>
		<h7 id='choicetitle'>".$row['nama']."</h7><br>
		<h9 id='choicesinger'>".$row['penyanyi']."</h9>
		</div>
		<div class='col-sm-2' style='margin-top: 15px;'>
		<input type='checkbox' name='songcheckbox' style='float: right; margin-right: 30px;' value='".$row[0]."' onclick='addsongtoplaylist();'>
		</div>
		</div>
		</div>";
	}
	exit();
}

if(isset($_POST['addnewplaylist']))
{
	$playlist=$_POST['playlist'];
	$playlist=serialize($playlist);
	$email=$_SESSION['email'];
	$name=$_POST['name'];
	$playlist_id=0;
	$sql="select * from playlist";
	$result=mysqli_query($con, $sql);

	while($row=mysqli_fetch_array($result)){
		echo("1");
		$playlist_id+=1;
	}

	$sql="INSERT INTO playlist values('$playlist_id','$name','$playlist','$email')";
	$result=mysqli_query($con,$sql);
	
	exit();
}

if(isset($_POST['showartist'])){
	$sql="select * from penyanyi ORDER BY RAND()";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		if($counter <= 6){
			echo"<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5' style='width:95%;'>
			<img class='card-img' src=".$row['gambar'].">
			<div class='details'>
			<button type='button' id='artistsong' class='btn btn-lg mb-2' artist_nama='".$row['nama']."' data-bs-toggle='modal' data-bs-target='#viewsongartist' style='border-radius:100%; border-color: transparent; background-color:rgba(0,0,0,0.5); color: white;'><i class='fa-solid fa-music'></i></button>
			<div class='row'>
			<div style='max-height: 0px; color:white;'>
			".$row['nama']."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
	exit();
}

if(isset($_POST['playsongplaylist']))
{
    $id=$_POST['songid'];
    $next=$_POST['next'];
    $prev=$_POST['prev'];
    $play_id=$_POST['pid'];
    $sql="select * from audios where ID like '%$id%'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    echo "<button id='playbarrewindbutton' class='btn btn-empty border-0' prev='".$prev."' playlistid='".$play_id."'>
    <i class='fa-solid fa-backward-step' style='color:white'></i>
    </button>
    <button class='btn btn-empty border-0' id='playbarplaybutton' playlistid='".$play_id."'>
    <i class='fa-solid fa-play' style='color:white'></i>
    </button>
    <button id='playbarforwardbutton' class='btn btn-empty border-0' next='".$next."' playlistid='".$play_id."'>
    <i class='fa-solid fa-forward-step' style='color:white'></i>
    </button>";
    echo "<div>
	<button class='btn btn-empty border-0' onclick='back2()'>
	<i class='fa-solid fa-angles-left' style='color:white'></i>
	</button>30&nbsp;
	<button class='btn btn-empty border-0' onclick='back()'>
	<i class='fa-solid fa-angle-left' style='color:white'></i>
	</button>10
	&nbsp;&nbsp;&nbsp;&nbsp;
	10<button class='btn btn-empty border-0' onclick='front()'>
	<i class='fa-solid fa-angle-right' style='color:white'></i>
	</button>
	&nbsp;30
	<button class='btn btn-empty border-0' onclick='front2()'>
	<i class='fa-solid fa-angles-right' style='color:white'></i>
	</button>
	</div>";
    echo '<audio id="playingsong" autoplay="true" style="display:none;">
    <source src="'.$row[2].'" type="audio/wav">
    </audio>';
    exit();
}

if(isset($_POST['showartistextend'])){
	$sql="select * from penyanyi ORDER BY RAND()";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		if($counter <= 12){
			echo"<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5' style='width:95%;'>
			<img class='card-img' src=".$row['gambar'].">
			<div class='details'>
			<button type='button' id='artistsong' class='btn btn-lg mb-2' artist_nama='".$row['nama']."'  data-bs-toggle='modal' data-bs-target='#viewsongartist'  style='border-radius:100%; border-color: transparent; background-color:rgba(0,0,0,0.5); color: white;'><i class='fa-solid fa-music'></i></button>
			<div class='row'>
			<div style='max-height: 0px; color:white;'>
			".$row['nama']."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
	exit();
}

if(isset($_POST['showcategory'])){
	$sql="select * from category ORDER BY RAND()";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		if($counter <= 6){
			echo"<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5' style='width:95%;'>
			<img class='card-img' src=".$row['gambar'].">
			<div class='details'>
			<button type='button' id='categorysong' class='btn btn-lg mb-2' category_nama='".$row['nama']."' data-bs-toggle='modal' data-bs-target='#viewsongcategory' style='border-radius:100%; border-color: transparent; background-color:rgba(0,0,0,0.5); color: white;'><i class='fa-solid fa-music'></i></button>
			<div class='row'>
			<div style='max-height: 0px; color:white;'>
			".$row['nama']."
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
	exit();
}

if(isset($_POST['showcategoryextend'])){
	$sql="select * from category ORDER BY RAND()";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
			echo"<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5' style='width:95%;'>
			<img class='card-img' src=".$row['gambar'].">
			<div class='details'>
			<button type='button' id='categorysong' class='btn btn-lg mb-2' category_nama='".$row['nama']."' data-bs-toggle='modal' data-bs-target='#viewsongcategory' style='border-radius:100%; border-color: transparent; background-color:rgba(0,0,0,0.5); color: white;'><i class='fa-solid fa-music'></i></button>
			<div class='row'>
			<div style='max-height: 0px; color:white;'>
			".$row['nama']."
			</div>
			</div>
			</div>
			</div>
			</div>";
	}
	exit();
}

// <<<<<<< Updated upstream
// =======
// // <<<<<<< Updated upstream
// // =======
// // // <<<<<<< Updated upstream
// // >>>>>>> Stashed changes
// >>>>>>> Stashed changes
if(isset($_POST['showplaylist'])){
	$current_user = $_SESSION['email'];
	$sql="select * from playlist";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		if ($row[3] == $current_user){
		$count = 0;
		$song_id=$row[2];
		$array=unserialize($song_id);
		$id = $array['playlist'];

		echo "  
		<div class='accordion-item'>
    		<h2 class='accordion-header' id='heading".$counter."'>
      			<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse".$counter."' aria-expanded='true' aria-controls='collapse".$counter."' style='color:white; background-color:grey;'>
        		".$row[1]."
      			</button>
    		</h2>";


    	foreach ($array as $key => $value) {
    		for($i=0;$i<count($id);$i++){
    			$curid=$value[$i];
    			$previous=$i-1;
    			$next=$i+1;
    			if ($previous < 0){
    				$previous=count($id)-1;
    			}
    			if ($next >= count($id)){
    				$next=0;
    			}
				$sql2="select * from audios where ID like '%$curid%'";
				$result2=mysqli_query($con,$sql2);
				while($row2=mysqli_fetch_array($result2)){
    			echo"
    			<div id='collapse".$counter."' class='accordion-collapse collapse show' aria-labelledby='heading".$counter."' data-bs-parent='#accordionExample' >
      				<div class='accordion-body' style='height: 100px;'>
      					<div class='row' id='choosesong' style='padding-left: 20px;''>
							<div class='col-sm-2' id='playlistsongicon' style='width: 120px'>
								<div class='card mb-3 ml-5 mu-5' style='height:70px; width:70px; margin-left:30px;'>
									<img class='card-img' src='".$row2['gambar']."' style='height:70px; width:70px;'>
									<div class='details' style='height:70px; width:70px;'>
										<button type='button' class='btn btn-secondary btn-lg mb-2' id='playplaylist' songID='".$row2['ID']."' next='".$id[$next]."' prev='".$id[$previous]."' playlistid='".$row[0]."'><i class='fa-solid fa-play'></i></button>		
									</div>
								</div>
							</div>
							<div class='col-sm-8' style='float: left; color:grey; margin-left:20px;'>
								<h7>".$row2['nama']."</h7><br>
								<h9>".$row2['penyanyi']."</h9>
							</div>
							<div class='col-sm-2' id='action'>
								
							</div>
						</div>
      				</div>
    			</div>";
    			}
    		}		
    	}	
  		echo "</div>";
		$counter+=1;
	}
}
	exit();
}

// <<<<<<< Updated upstream

// =======
// // <<<<<<< Updated upstream
// // =======
// // // =======
// // >>>>>>> Stashed changes
// >>>>>>> Stashed changes
if(isset($_POST['showartistsong']))
{	
	$nama=$_POST['artistnama'];
	echo "
	<h8 style='color: white; margin-bottom:10px;'>Artist Name : ".$nama."</h8><br><br>
	<div style='height:1px; margin-left:10px; margin-right:10px; border-bottom: white 1px solid;'></div><br>";
	$sql="select * from audios where penyanyi like '%$nama%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
		echo "
		<div class='container' id='chooseartistsong' style='background-color: rgba(128,128,128,0.3); padding-top:5px; padding-bottom:5px; margin-top:10px; border-radius:30px;'>
		<div class='row' id='chooseartistsong' style='padding-left: 20px;''>
		<div class='col-sm-2' id='playlistsongicon'>
		<img src='".$row['gambar']."' style='height: 50px; width: 50px; margin-top:10px; margin-bottom:5px;'>
		</div>
		<div class='col-sm-8' style='float: left; color:whitesmoke; padding-top:10px; padding-bottom:5px;'>
		<button type='button' style='float: right;position: relative; border-radius:50%; margin-top:4px; margin-bottom:0 auto; margin-right:-60px;' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
		<h7 id='choicetitle' style='margin-top:4px; margin-bottom:4px;'>".$row['nama']."</h7><br>
		<h9 id='choicesinger' style='margin-top:4px; margin-bottom:4px;'>".$row['penyanyi']."</h9>
		</div>
		<div class='col-sm-2' style='margin-top: 15px;'>
		</div>
		</div>
		</div>";
	}
	exit();
}

if(isset($_POST['showcategorysong']))
{	
	$category=$_POST['categorynama'];
	echo "
	<h8 style='color: white; margin-bottom:10px;'>Category : ".$category."</h8><br><br>
	<div style='height:1px; margin-left:10px; margin-right:10px; border-bottom: white 1px solid;'></div><br>";
	$sql="select * from audios where category like '%$category%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
		echo "
		<div class='container' id='chooseartistsong' style='background-color: rgba(128,128,128,0.3); padding-top:5px; padding-bottom:5px; margin-top:10px; border-radius:30px;'>
		<div class='row' id='chooseartistsong' style='padding-left: 20px;''>
		<div class='col-sm-2' id='playlistsongicon'>
		<img src='".$row['gambar']."' style='height: 50px; width: 50px; margin-top:10px; margin-bottom:5px;'>
		</div>
		<div class='col-sm-8' style='float: left; color:whitesmoke; padding-top:10px; padding-bottom:5px;'>
		<button type='button' style='float: right;position: relative; border-radius:50%; margin-top:4px; margin-bottom:0 auto; margin-right:-60px;' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
		<h7 id='choicetitle' style='margin-top:4px; margin-bottom:4px;'>".$row['nama']."</h7><br>
		<h9 id='choicesinger' style='margin-top:4px; margin-bottom:4px;'>".$row['penyanyi']."</h9>
		</div>
		<div class='col-sm-2' style='margin-top: 15px;'>
		</div>
		</div>
		</div>";
	}
	exit();
}

if(isset($_POST['backwardplay'])){
	$prev=$_POST['prev'];
	$pid=$_POST['pid'];
	$sql="select * from playlist where playlist_id like '%$pid%'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);

	$song_id=$row[2];
	$array=unserialize($song_id);
	$id = $array['playlist'];

	$index=0;
	foreach ($array as $key => $value) {
    	for($i=0;$i<count($id);$i++){
    		if($id[$i] == $prev){
    			$index=$i;
    			break;
    		}
    	}
    }
    $prev_index=$index-1;
    $next_index=$index+1;
    if ($prev_index < 0){
    	$prev_index=count($id)-1;
    }
    if ($next_index >= count($id)){
    	$next_index=0;
    }
    $sql="select * from audios where ID like '%$prev%'";
    $result=mysqli_query($con, $sql);
    $row=mysqli_fetch_array($result);

    echo "<button id='playbarrewindbutton' class='btn btn-empty border-0' prev='".$id[$prev_index]."' playlistid='".$pid."' onclick='stopaudio()'>
    <i class='fa-solid fa-backward-step' style='color:white'></i>
    </button>
    <button class='btn btn-empty border-0' id='playbarplaybutton' playlistid='".$pid."'>
    <i class='fa-solid fa-play' style='color:white'></i>
    </button>
    <button id='playbarforwardbutton' class='btn btn-empty border-0' next='".$id[$next_index]."' playlistid='".$pid."' onclick='stopaudio()'>
    <i class='fa-solid fa-forward-step' style='color:white'></i>
    </button>";
    echo "<div>
	<button class='btn btn-empty border-0' onclick='back2()'>
	<i class='fa-solid fa-angles-left' style='color:white'></i>
	</button>30&nbsp;
	<button class='btn btn-empty border-0' onclick='back()'>
	<i class='fa-solid fa-angle-left' style='color:white'></i>
	</button>10
	&nbsp;&nbsp;&nbsp;&nbsp;
	10<button class='btn btn-empty border-0' onclick='front()'>
	<i class='fa-solid fa-angle-right' style='color:white'></i>
	</button>
	&nbsp;30
	<button class='btn btn-empty border-0' onclick='front2()'>
	<i class='fa-solid fa-angles-right' style='color:white'></i>
	</button>
	</div>";
    echo '<audio id="playingsong" autoplay="true" style="display:none;">
    <source src="'.$row[2].'" type="audio/wav">
    </audio>';
    exit();
}

if(isset($_POST['forwardplay'])){
	$next=$_POST['next'];
	$pid=$_POST['pid'];
	$sql="select * from playlist where playlist_id like '%$pid%'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);

	$song_id=$row[2];
	$array=unserialize($song_id);
	$id = $array['playlist'];

	$index=0;
	foreach ($array as $key => $value) {
    	for($i=0;$i<count($id);$i++){
    		if($id[$i] == $next){
    			$index=$i;
    			break;
    		}
    	}
    }
    $prev_index=$index-1;
    $next_index=$index+1;
    if ($prev_index < 0){
    	$prev_index=count($id)-1;
    }
    if ($next_index >= count($id)){
    	$next_index=0;
    }
    $sql="select * from audios where ID like '%$next%'";
    $result=mysqli_query($con, $sql);
    $row=mysqli_fetch_array($result);

    echo "<button id='playbarrewindbutton' class='btn btn-empty border-0' prev='".$id[$prev_index]."' playlistid='".$pid."' onclick='stopaudio()'>
    <i class='fa-solid fa-backward-step' style='color:white'></i>
    </button>
    <button class='btn btn-empty border-0' id='playbarplaybutton' playlistid='".$pid."'>
    <i class='fa-solid fa-play' style='color:white'></i>
    </button>
    <button id='playbarforwardbutton' class='btn btn-empty border-0' next='".$id[$next_index]."' playlistid='".$pid."' onclick='stopaudio()'>
    <i class='fa-solid fa-forward-step' style='color:white'></i>
    </button>";
    echo "<div>
	<button class='btn btn-empty border-0' onclick='back2()'>
	<i class='fa-solid fa-angles-left' style='color:white'></i>
	</button>30&nbsp;
	<button class='btn btn-empty border-0' onclick='back()'>
	<i class='fa-solid fa-angle-left' style='color:white'></i>
	</button>10
	&nbsp;&nbsp;&nbsp;&nbsp;
	10<button class='btn btn-empty border-0' onclick='front()'>
	<i class='fa-solid fa-angle-right' style='color:white'></i>
	</button>
	&nbsp;30
	<button class='btn btn-empty border-0' onclick='front2()'>
	<i class='fa-solid fa-angles-right' style='color:white'></i>
	</button>
	</div>";
    echo '<audio id="playingsong" autoplay="true" style="display:none;">
    <source src="'.$row[2].'" type="audio/wav">
    </audio>';
    exit();
    
}

if(isset($_POST['drawvolume'])){
	
	exit();
}

// <<<<<<< Updated upstream

// =======
// // <<<<<<< Updated upstream

// // =======
// // // >>>>>>> Stashed changes
// // >>>>>>> Stashed changes
// >>>>>>> Stashed changes
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="jquery-3.6.1.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/8111334eea.js" crossorigin="anonymous"></script>
	<style type="text/css">
		body{
			font-family: 'Roboto', sans-serif;
			height: 1000px;
		}
		* {
			scrollbar-width: 0 auto;
			scrollbar-color: #712985 #000000;
		}
		*::-webkit-scrollbar {
			width: 10px;
		}

		*::-webkit-scrollbar-track {
			background: #000000;
		}

		*::-webkit-scrollbar-thumb {
			background-image: linear-gradient(#000000 0%, #5D1E94 50%, #000000 100%);
			border-radius: 10px;
			border: 0px solid #ffffff;
		}
		*{
			margin: 0;
			padding: 0;
			list-style: none;
			text-decoration: none;
		}
		.sidebar{
			background-image: linear-gradient(#404040 0%, #202020 80%);
			position: fixed;
			left: 0;
			width:200px;
			height: 100%;
			transition: all .5s ease;
		}
		.sidebar header{
			font-size: 20px;
			color: white;
			text-align: center;
			line-height: 65px;
			user-select: none;
			margin-bottom: 50px;
			padding-right: 30px;
		}

		.sidebar ul.menu a{
			display: block;
			height: 100%;
			width: 100%;
			line-height: 50px;
			font-size: 18px;
			color: white;
			box-sizing: border-box;
			transition: .5s;
			text-decoration: none;
			padding-left: 0px;
		}
		ul.menu li:hover a{
			padding-left: 10px;
			text-decoration: none;
			border-right: 2px solid white;
		}

		.sidebar ul a i{
			margin-right: 15px;
		}

		ul.menu li a.active{
			color: #B266FF;
			border-right: 2px solid #B266FF;
		}
		section{
			background-color: #202020;
			height: 100%;
			transition: all .5s ease;
			margin-left: 200px;
		}
		.card {
			height: 10rem;
			width: 10rem;
			overflow: hidden;
			position: relative;
			cursor: pointer;
			border: none;
		}

		.view .card img {
			min-height: 100%;
			min-width: 100%;
			position: absolute;
		}

		.view .card:hover .details {
			opacity: 1;
			height: 100%;
		}

		.view .details {
			position: absolute;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			bottom: 0 auto;
			width: 100%;
			height: 0%;
			background: rgba(0, 0, 0, 0.7);
			opacity: 0;
			transition: 0.5s ease;
		}

		.top_bar{
			height: 70px;
			background-color: rgba(0, 0, 0, 0.2);
			position: relative;
		}
		section .top_bar .d-flex #search{
			margin-left:0 auto; 
			margin-right:0 auto;
			margin-top: 15px;
			margin-bottom: 15px;
			border-radius: 50%;
			color: #B266FF;
			background-color: transparent;
			border-color: #B266FF;
			transition: .4s;
		}
		section .top_bar .d-flex #search:hover{
			border-radius: 50%;
			color: #FFFFFF;
			background-color: #B266FF;
			transition: .4s;
		}
		section .top_bar .d-flex input{
			margin-top: 15px;
			margin-bottom: 15px;
			width: 70%;
			border-radius: 30px;
			color: white;
			border-color: #B266FF;
			background-color: transparent;
			transition: .4s;
		}
		section .top_bar .d-flex input::placeholder{
			color: #C0C0C0;
		}
		section .top_bar .d-flex input:focus{
			border-radius: 30px;
			color: black;
			border-color: #FFFFFF;
			background-color: #FFFFFF;
			transition: .4s;
		}
		.wrapper section .top_bar .dropdown #user_menu{
			background-color: transparent;
			border-color: transparent;
			transition: .5s;
		}
		.wrapper section .top_bar .dropdown #user_menu:hover{
			background-color: transparent;
			border: 1px solid #B266FF;
		}
		.wrapper section .top_bar #profile img:hover{
			scale: 1.1;
		}
		.wrapper section .top_bar .dropdown ul li button:hover{
			transition: .5s;
		}
		.wrapper section .top_bar .dropdown ul li button:hover{
			background-color: #B266FF;
			font-color: black;
		}

		.playbar{
			position: fixed;
			right: 0;
			left:0;
			bottom: 0;
			height: 100px;
			background-color: black;
			color: white;
		}
		#playbarcenter{
			text-align: center;
		}
		#playbarleft{

		}
		#playbarright{

		}
		#coverimage{
			margin-left: 30px;
			margin-top: 15px;
			height: 70px;
			width: 70px;
		}
		#playimage{
			margin-right: 30px;
			height: 70px;
			width: 70px;
		}
		#songinfo{
			margin-left: 10px;
			margin-top: 20px;
		}

		/*#check{
			display: none;
		}
		label #btn, label #cancel{
			position: absolute;
			cursor: pointer;
			background: rgba(0, 0, 0, 0.2);
			border-radius: 3px;
		}
		label #btn{
			left: 40px;
			top: 25px;
			font-size: 35px;
			color: white;
			padding: 6px 12px;
			}
		label #cancel{
			z-index: 1111;
			left: 165px;
			top: 17px;
			font-size: 20px;
			color: white;
			padding: 4px 9px;
		}
		#check:checked ~ .sidebar{
			left: 0;
		}
		#check:checked ~ label #btn{
			left: 200px;
			opacity: 0;
			pointer-events: none;
		}
		#check:checked ~ label #btn{
			left: -165px;
			opacity: 0;
			pointer-events: none;
		}*/
		.slideshow-container {
			max-width: 100%;
			max-height: 100px;
			position: relative;
			margin: auto;
		}
		.dot {
			height: 15px;
			width: 15px;
			margin: 0 2px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
			transition: background-color 0.6s ease;
		}

		.slider-active {
			background-color: #717171;
		}

		.bottom {
			position: fixed;
			bottom: 0;
			width: 100%;
		}

		#garis {
			padding-top: 50px;
			margin-left: 40px;
			margin-right: 40px;
			height: 1px;
			border-bottom: white 1px solid;
		}

		.modal-header{
			background-color: #202020;
			color: white;
		}
		.modal-body{
			background-color: #202020;
		}
		.modal-footer{
			background-color: #202020;
			color: white;
		}

	</style>
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<ul class="menu">
				<header>Music Player</header>
				<div class="mb-3"style="border-top: 1px solid white; margin-right: 30px;"></div>
				<li><a href="#isi" id="#home" class="button active"><i class="fa-solid fa-house"></i>Home</a></li>
				<li><a href="#library"><i class="fa-solid fa-book"></i>Library</a></li>
				<li><a href="#playlist"><i class="fa-solid fa-list"></i>Playlist</a></li>
				<div class="mt-3 mb-3" style="border-top: 1px solid white; margin-right: 30px;"></div>
				<li><a href="#" onclick="addnewplaylist();" data-bs-toggle="modal" data-bs-target="#addplaylist"><i class="fa-solid fa-square-plus" ></i>New Playlist</a></li>

			</ul>
		</div>
		<section class="view">
			<!-- bar atas -->
			<div class="top_bar">
				<!-- <div style="width:200px; height: 50px; float: left; margin-top: 20px; margin-bottom: 10px; margin-left: 20px; color: white; font-size: 20px;">
					Listen, Feel, Happy
				</div> -->
				<div id="profile" style="width:50px; height: 50px; float: right; margin-top: 10px; margin-bottom: 10px; margin-right: 20px;">
					<img src="picture/imgSementara.jpg" width="100%" style="border-radius: 50%;">
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="user_menu" data-bs-toggle="dropdown" aria-expanded="false"  style="float: right; margin-top: 15px; margin-bottom: 15px; margin-right:20px;">
						<i class="fa-solid fa-gear"></i>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: rgba(0, 0, 0, 1);">
						<li><form action="logout-user.php"><button type="submit"class="dropdown-item" type="button" style="color:white;">Logout</button></form></li>
					</ul>
				</div>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">Edit Profile</a>
					<a class="dropdown-item" href="#">Logout</a>
				</div>
				<div style=" float: left; margin-left: 15px;">
					<form class="d-flex" role="search">
						<input class="form-control me-2 textfield" type="search" id="search_query" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline" type="submit" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>
				</div>
			</div>
			<div id="isi">
				<div class="mb-5"style="height: 400px; margin-top: -60px;">
				<div class="slideshow-container mb-3 mt-5">

				<div class="mySlides">
					<img src="picture/promo5.jpg" style="width:100%; height:400px;">
				</div>

				<div class="mySlides">
					<img src="picture/promo2.jpg" style="width:100%; height:400px;">
				</div>

				<div class="mySlides">
					<img src="picture/promo3.jpg" style="width:100%; height:400px;">
				</div>

			</div>
			<br>
			<div style="text-align:center">
				<span class="dot"></span> 
				<span class="dot"></span> 
				<span class="dot"></span> 
			</div>
		</div>
		<br>
				<h3 style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;" class="mt-3">New Releases</h3>
				<div class="wrap mt-6" style="background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
					<div class="row" id="newarrival">
					</div>
				</div>
				<h3 style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;" class="mt-4">Most Played</h3>
				<div class="wrap mt-7" style="background-color: rgba(96, 96, 96, 0.3); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
					<div class="row" id="popular">
					</div>
				</div>
			</div>
			<div id="garis"></div><br>
			<div id="library">
				<div class="row" style="width:95%;">
					<h2 class="mt-3" style="float:left; margin-left: 30px; color: white; height: 0 auto; position:relative;">Library</h2><br>
					<div class="col">
						<h3 style="float:left; color: white; margin-left:30px; height: 0 auto; position:relative;" class="mt-2">Artists</h3>
					</div>
					<div class="col">
						<a href="#library" onclick="showartistsextend();"style="float:right; color: white; height: 0 auto; padding-top: 20px; text-decoration: none; color: #FF99FF; position:relative; font-size: 20px;" class="mt-2">See All</a>
					</div>
				</div>
				<div class="wrap mt-2" style="background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
					<div class="row" id="artists"></div>
				</div>
				<div class="row" style="width:95%;" id="isi_category">
					<div class="col" style="padding-top:10px;">
					<h3 style="float:left; color: white; margin-left:30px; height: 0 auto; position:relative;" class="mt-5">Category</h3>
				</div>
					<div class="col" style="padding-top: 50px;">
						<a href="#isi_category" onclick="showcategoryextend();"style="float:right; color: white; padding-top: 20px; text-decoration: none; color: #FF99FF; position:relative; font-size: 20px;" class="mt-2">See All</a>
					</div>
				</div>
				<div class="wrap mt-2" style="background-color: rgba(96, 96, 96, 0.3); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
					<div class="row" id="category"></div>

				</div>
			</div>
			<div id="garis"></div><br>
			<div id="playlistbar">
				<h2 class="mt-3"style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;">Playlist</h2><br><br><br>
				<div id="playlist" style="color: white;">
					<div class="accordion" id="playlistaccordion" style="width: 94%; margin-left: 30px; margin-right:0 auto;">
					</div>
				</div>
			</div><br><br><br><br>
			<!-- <div class="slideshow-container mb-3 mt-5">

				<div class="mySlides">
					<img src="picture/promo3.jpg" style="width:100%; height:400px;">
				</div>

				<div class="mySlides">
					<img src="picture/promo2.jpg" style="width:100%; height:400px;">
				</div>

				<div class="mySlides">
					<img src="picture/promo4.jpg" style="width:100%; height:400px;">
				</div>

			</div>
			<br>
			<div style="text-align:center">
				<span class="dot"></span> 
				<span class="dot"></span> 
				<span class="dot"></span> 
			</div> -->
		</section>
		<div class="playbar">
			<div class="row">
				<div class="col-md-4" id="playbarleft">
					<div class="row">
						<div class="col-md-4" id="coverimage"></div>
						<div class="col-md-6" id="songinfo"></div>
					</div>
				</div>
				<div class="col-md-4" style='margin-top: 10px' id ="playbarcenter">
				</div>
				<div class="col-md-4" id="playbarright">
					<div id="volumebar" style="float:right; margin-right: 40px; margin-top: 30px;">
						<span id='vol-icon'><i class='fa fa-volume-up'></i></span> <input type='range' value='100' id='volume'>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				var playlist = [];
				var next = "";
				var previous = "";
				var ply_id = "";
				var songduration = 0;
				var remaining = 0;
				// homepage();/=
				showsongs();
				popularsongs();
				showSlides();
				addnewplaylist();
				showartists();
				showplaylist();
				showcategory();
				checkaudio();

				$("#search").click(function(){
					search_query_in = $('#search_query').val();

					if (search_query_in == ""){
						showsongs();
					}
					else{
						$.ajax({
							url		: "admin_edit.php",
							type 	: "POST",
							async	: true,
							data    : {
								search : 1,
								search_query :search_query_in
							},
							success	: function(result)
							{ 
								alert("Searching...");
								$('#newarrival').html(result);
							}
						});
					}
				});
			});

			function showsongs(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showsong : 1
					},
					success : function(res){
						$("#newarrival").html(res);
					}	
				});
			}
			function popularsongs(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						popularsong : 1
					},
					success : function(res){
						$("#popular").html(res);
					}	
				});
			}
			// $("#newarrival").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			songicon : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#coverimage").html(res);
			// 		}	
			// 	});
			// });
			// $("#newarrival").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			songinfo : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#songinfo").html(res);
			// 		}	
			// 	});
			// });

			// $("#newarrival").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			playsong : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#playbarcenter").html(res);
			// 		}
			// 	});
			// });

			// $("#popular").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			songicon : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#coverimage").html(res);
			// 		}	
			// 	});
			// });
			// $("#popular").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			songinfo : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#songinfo").html(res);
			// 		}	
			// 	});
			// });

			// $("#popular").delegate('#play', 'click', function(){
			// 	var v_songid=$(this).attr('songID');
			// 	$.ajax({
			// 		url	  : "homepagefix.php",
			// 		type  : "POST",
			// 		async : true,
			// 		data  : {
			// 			playsong : 1,
			// 			songid	: v_songid
			// 		},
			// 		success : function(res){
			// 			$("#playbarcenter").html(res);
			// 		}
			// 	});
			// });

			function back(){
				var music = document.getElementById('playingsong');
				if (music.currentTime - 10 < 0){
					music.currentTime = 0.1;
				}
				else{
					music.currentTime -= 10;
				}
				setTimeout(function(){playcont()}, 1000);
			}

			function back2(){
				var music = document.getElementById('playingsong');
				if (music.currentTime - 30 < 0){
					music.currentTime = 0.1;
				}
				else{
					music.currentTime -= 30;
				}
				setTimeout(function(){playcont()}, 1000);
			}

			function front(){
				var music = document.getElementById('playingsong');
				if (music.currentTime + 10 > music.duration){
					music.currentTime = music.duration - 1;
				}
				else {
					music.currentTime += 10;
				}
				setTimeout(function(){playcont()}, 1000);
			}

			function front2(){
				var music = document.getElementById('playingsong');
				if (music.currentTime + 30 > music.duration){
					music.currentTime = music.duration -1;
				}
				else {
					music.currentTime += 30;
				}
				setTimeout(function(){playcont()}, 1000);
			}

			function back1(){
				var music = document.getElementById('playingsong');
				if (music.currentTime - 10 < 0){
					music.currentTime = 0.1;
				}
				else{
					music.currentTime -= 10;
				}
			}

			function back21(){
				var music = document.getElementById('playingsong');
				if (music.currentTime - 30 < 0){
					music.currentTime = 0.1;
				}
				else{
					music.currentTime -= 30;
				}
			}

			function front1(){
				var music = document.getElementById('playingsong');
				if (music.currentTime + 10 > music.duration){
					music.currentTime = music.duration - 1;
				}
				else {
					music.currentTime += 10;
				}
			}

			function front21(){
				var music = document.getElementById('playingsong');
				if (music.currentTime + 30 > music.duration){
					music.currentTime = music.duration -1;
				}
				else {
					music.currentTime += 30;
				}
			}

			function showvolume(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						drawvolume : 1
					},
					success : function(res){
						$("#volumebar").html(res);
					}	
				});
			}
			$("body").delegate('#play', 'click', function(){
				var v_songid=$(this).attr('songID');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songicon : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#coverimage").html(res);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songinfo : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#songinfo").html(res);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						playsong : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#playbarcenter").html(res);

					}
				});
			});

			function showartists(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showartist : 1
					},
					success : function(res){
						$("#artists").html(res);
					}	
				});
			}
			function showartistsextend(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showartistextend : 1
					},
					success : function(res){
						$("#artists").html(res);
					}	
				});
			}
			function showcategory(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showcategory : 1
					},
					success : function(res){
						$("#category").html(res);
					}	
				});
			}
			function showcategoryextend(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showcategoryextend : 1
					},
					success : function(res){
						$("#category").html(res);
					}	
				});
			}

			$('#volume').on('mousedown', function(e) {
				var music=document.getElementById('playingsong');
                    $(this).on('mousemove', function() {
                        var vol = $(this).val() / 100
                        music.volume = vol
                        if (vol == 0) {
                            $('#vol-icon').html('<i class="fa fa-volume-off"></i>')
                        } else if (vol < .5) {
                            $('#vol-icon').html('<i class="fa fa-volume-down"></i>')
                        } else {
                            $('#vol-icon').html('<i class="fa fa-volume-up"></i>')
                        }
                    })
                })
                $('#volume').on('mouseup', function(e) {
                    $(this).off('mousemove')
            });

			$("#playbarcenter").delegate('#playbarplaybutton', 'click', function(){
				var music=document.getElementById('playingsong');
				if (music.paused){
					music.play();
					const id = setTimeout(function(){playcont();}, 1000);
				}
				else{
					music.pause();
					clearTimeout(id);
				}
			});

			$("#playbarcenter").delegate('#playbutton', 'click', function(){
				var music=document.getElementById('playingsong');
				if (music.paused){
					music.play();
				}
				else{
					music.pause();
				}
			});

			function stopaudio(){
				var music=document.getElementById('playingsong');
				music.pause();
				music.currentTime = 0;
			}

			function playcont(){
				var music = document.getElementById('playingsong');
				var wait = (music.duration - music.currentTime) * 1000;
				setTimeout(function(){
					var v_next = $('#playbarforwardbutton').attr('next');
					var v_pid = $('#playbarforwardbutton').attr('playlistid');
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							forwardplay : 1,
							next : v_next,
							pid : v_pid
						},
						success : function(res){
							$("#playbarcenter").html(res);
							clearTimeout(id);
							const id = setTimeout(function(){playnext();}, 1000);
						}	
					});
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							songicon : 1,
							songid	: v_next
						},
						success : function(res){
							$("#coverimage").html(res);
						}	
					});
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							songinfo : 1,
							songid	: v_next
						},
						success : function(res){
							$("#songinfo").html(res);
						}	
					});
				}, wait);
			}

			function playnext(){
				clearTimeout(id);
				var music = document.getElementById('playingsong');
				var wait = music.duration * 1000;
				setTimeout(function(){
					var v_next = $('#playbarforwardbutton').attr('next');
					var v_pid = $('#playbarforwardbutton').attr('playlistid');
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							forwardplay : 1,
							next : v_next,
							pid : v_pid
						},
						success : function(res){
							$("#playbarcenter").html(res);
							
							const id = setTimeout(function(){playnext();}, 1000);
						}	
					});
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							songicon : 1,
							songid	: v_next
						},
						success : function(res){
							$("#coverimage").html(res);
						}	
					});
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							songinfo : 1,
							songid	: v_next
						},
						success : function(res){
							$("#songinfo").html(res);
						}	
					});
				}, wait);
			}

			$("#playbarcenter").delegate('#playbarrewindbutton', 'click', function(){
				var v_prev = $(this).attr('prev');
				var v_pid = $(this).attr('playlistid');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						backwardplay : 1,
						prev : v_prev,
						pid : v_pid
					},
					success : function(res){
						$("#playbarcenter").html(res);
						const id = setTimeout(function(){playnext();}, 1000);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songicon : 1,
						songid	: v_prev
					},
					success : function(res){
						$("#coverimage").html(res);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songinfo : 1,
						songid	: v_prev
					},
					success : function(res){
						$("#songinfo").html(res);
					}	
				});
			});

			$("#playbarcenter").delegate('#playbarforwardbutton', 'click', function(){
				var v_next = $(this).attr('next');
				var v_pid = $(this).attr('playlistid');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						forwardplay : 1,
						next : v_next,
						pid : v_pid
					},
					success : function(res){
						$("#playbarcenter").html(res);
						const id = setTimeout(function(){playnext();}, 1000);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songicon : 1,
						songid	: v_next
					},
					success : function(res){
						$("#coverimage").html(res);
					}	
				});
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songinfo : 1,
						songid	: v_next
					},
					success : function(res){
						$("#songinfo").html(res);
					}	
				});

			});


			let slideIndex = 0;
			function showSlides() {
				let i;
				let slides = document.getElementsByClassName("mySlides");
				let dots = document.getElementsByClassName("dot");
				for (i = 0; i < slides.length; i++) {
					slides[i].style.display = "none";  
				}
				slideIndex++;
				if (slideIndex > slides.length) {slideIndex = 1}    
					for (i = 0; i < dots.length; i++) {
						dots[i].className = dots[i].className.replace(" slider-active", "");
					}
					slides[slideIndex-1].style.display = "block";  
					dots[slideIndex-1].className += " slider-active";
					setTimeout(showSlides, 4000);
				}
				function homepage(){
					$.ajax({
						url	  : "homepagefix.php",
						type  : "POST",
						async : true,
						data  : {
							homemenu : 1
						},
						success : function(res){
							$("#isi").html(res);
							showSlides();
						}
					});
				}
				function addnewplaylist(){
					$.ajax({
						url		: "homepagefix.php",
						type	: "POST",
						async	: true,
						data	: {
							shownewplaylistoption : 1
						},
						success : function(res){
							$(".modal-body").html(res);
						}

					});
				}
				function addsongtoplaylist(){
					var checkboxes = document.getElementsByName("songcheckbox");
					var songarray = []

					for (var i=0; i<checkboxes.length; i++){
						if (checkboxes[i].checked){
							songarray.push(checkboxes[i].value);
						}
					}
					playlist = songarray;
				}

				function addplaylisttodatabase(){
					var v_playlist = playlist;
					var v_name= $('#playlistname').val();
					$.ajax({
						url		: "homepagefix.php",
						type	: "POST",
						async	: true,
						data	: {
							addnewplaylist : 1,
							name 	 : v_name,
							playlist : {playlist: v_playlist}
						},
						success : function(res){
							alert("Playlist added");
							showplaylist();
							playlist = [];
							name = "";
						}
					});
				}

				function showplaylist(){
					$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showplaylist : 1
					},
					success : function(res){
						$("#playlistaccordion").html(res);
					}	
				});
				}

				$("body").delegate('#artistsong', 'click', function(){
					var v_artistnama=$(this).attr('artist_nama');
					$.ajax({
						url		: "homepagefix.php",
						type	: "POST",
						async	: true,
						data	: {
							showartistsong : 1,
							artistnama : v_artistnama
						},
						success : function(res){
							$(".modal-body").html(res);
						}

					});
				});

				$("body").delegate('#categorysong', 'click', function(){
					var v_categorynama=$(this).attr('category_nama');
					$.ajax({
						url		: "homepagefix.php",
						type	: "POST",
						async	: true,
						data	: {
							showcategorysong : 1,
							categorynama : v_categorynama
						},
						success : function(res){
							$(".modal-body").html(res);
						}

					});
				});
// <<<<<<< Updated upstream

				$("#playlistaccordion").delegate('#playplaylist', 'click', function(){
                var v_songid=$(this).attr('songID');
                var v_next=$(this).attr('next');
                var v_prev=$(this).attr('prev');
                var v_pid=$(this).attr('playlistid');
                $.ajax({
                    url      : "homepagefix.php",
                    type  : "POST",
                    async : true,
                    data  : {
                        songicon : 1,
                        songid    : v_songid
                    },
                    success : function(res){
                        $("#coverimage").html(res);
                    }
                });
                $.ajax({
                    url      : "homepagefix.php",
                    type  : "POST",
                    async : true,
                    data  : {
                        songinfo : 1,
                        songid    : v_songid
                    },
                    success : function(res){
                        $("#songinfo").html(res);
                    }
                });
                $.ajax({
                    url      : "homepagefix.php",
                    type  : "POST",
                    async : true,
                    data  : {
                        playsongplaylist : 1,
                        songid    : v_songid,
                        next 	  : v_next,
                        prev      : v_prev,
                        pid       : v_pid
                    },
                    success : function(res){
                        $("#playbarcenter").html(res);
                        const id = setTimeout(function(){playnext();}, 1000);
                    }
                });

            });
// =======
				function refreshcard(){

				}
// >>>>>>> Stashed changes
			</script>
		</div>
		<<<<<<< HEAD
	=======
	<div class="modal fade" id="addplaylist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addplaylisttodatabase();">Save Playlist</button>
				</div>
			</div>
		</div>
	</div>
	<div id="#modal_artist_song"></div>
	<div class="modal fade" id="viewsongartist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Artist Songs</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="modal_body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="viewsongcategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Category Songs</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="modal_body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
>>>>>>> 6f8f51834bb765915fbf4d8c2e6a17565ba178a9
