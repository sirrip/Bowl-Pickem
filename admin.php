<?php 
/*
-Import games (CSV)
	-Single / Bulk
-Update win list
	-Radio Buttons
-Payment display
-Lock picks option (per league)
	Lock by date
(tabular format)
-Manage users
	-Create Leagues
	-Add/remove from leaguess
*/
	include_once 'common.php';
	include_once 'login.php';
	$link = mysqli_connect($servername,$username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}

?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>College Bowl Picker Page</title>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>College Football Pick Em</title>
	<meta name="description" content="">
	<meta name="author" content=" Made by Keyners">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />


	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- PT Sans -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- Crete Roung -->
	<link href='http://fonts.googleapis.com/css?family=Crete+Round&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- CSS
  ================================================== -->
  	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="js/admin.js"></script>

	<style>
	.tab-container {
		width:80%;
		margin:0 auto;
		overflow: auto;
	}
	.right-center {
		width:50%;
		float:right;
	}
	.left-center {
		width:50%;
		float:left;
	}
	.highlight {
		background: #33FF99; font-weight: bold;
		}
	.tabs {
		margin: 0 auto;
		}
	form {
		margin: 0 auto;
		}
	}
	#saveBtn{
		text-align: center;
	}
	table {
		margin: 0 auto;
	}

  </style>
</head>
<body>
	<header>			
		<nav>
			<div class='container'>
				<div class='five columns logo'>
					<a href='#'>Logo Spot</a>
				</div>

				<div class='eleven columns'>
					<ul class='mainMenu'>
						<li><a href='index.html' title='Home'>Home</a></li>
						<li><a href='PickList.php' title='My Picks'>My Picks</a></li>
						<li><a href='leaderboard.php' title='Leaderboard'>Leaderboard</a></li>
						<li><a href='#' title='Profile'>Profile</a></li>
						<li><a href='#' title='Blog'>Blog</a></li>
						<li><a href='admin.php' title='Admin'>Admin</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class='container'>
			<div class='slogan'>
				<div class='ten columns'>
					<h1>College Bowl Pick Em</h1>
					<h2>Prove your NCAA football fanhood.</h2>
				</div>

				<div class='six columns'>
					<h4>How to play</h4>
					<p>Join a league. Each participant picks the winners of each bowl game, and then sort each game by your level of confidence in your selections. A correct pick wins you the confidence points you've wagered on that game. Most points wins.</p>
					<a href='#' class='button medium blue'>Official Rules</a>
				</div>
			</div>
		</div>	
	</header>
	
	
<!--
TABS AND BODY OF ADMIN PAGE----------------
-->


<div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1">Add games</a></li>
        <li><a href="#tab2">Add/Edit seasons</a></li>
        <li><a href="#tab3">Update Game Results</a></li>
        <li><a href="#tab4">User Payments</a></li>
    </ul>
 
    <div class="tab-content">
<!-- TAB1 -->
        <div id="tab1" class="tab active">
            <p>
				<table id='addGameTbl' class='add'>
					<thead class='tblHead'><tr><td colspan='2'>Add a game</td></tr></thead>
					<tr><td>Bowl Name:</td><td><input type='text' id='bowlName' /><font color='red'>*</font></td></tr>
					<tr><td>Team 1:</td><td><input type='text' id='team1' /><font color='red'>*</font></td></tr>
					<tr><td>Team 2:</td><td><input type='text' id='team2' /><font color='red'>*</font></td></tr>
					<tr><td>Game Day:</td><td><input type='date' id='gameDay' /><font color='red'>*</font></td></tr>
					<tr><td>Season:</td><td>  <select id="selectSeason" name="gameSeason" >													 <option value="0">Select season</option>
											 <option value="2014">2014</option>
											</select><font color='red'>*</font></td></tr>
					<tr><td id='addGameMsg' class='confirmText' colspan='2'></td></tr>
					<tr><td colspan='2'><button class='add' id='addGame' value='Add'>Add</button></td></tr>
				</table>
            </p>
        </div>
 
 <!-- TAB2 -->
 
		<div id="tab2" class="tab">
			<div class='tab-container'>
				<div class='left-center'>
					<table id='addSeasonTbl' class='add'>
						<thead class ='tblHead'><tr><td colspan='2'>Add a season</td></tr></thead>
						<tr><td>Year:</td><td><input type='text' id='seasonYear' name='seasonYear' /><font color='red'>*</font></td></tr>
						<tr><td>Title:</td><td><input type='text' id='seasonTitle' name='seasonTitle' /><font color='red'>*</font></td></tr>
						<tr><td>Start Date:</td><td><input type='date' id='seasonStart' name='startDate' /><font color='red'>*</font></td></tr>
						<tr><td>Lock Date:</td><td><input type='date' id='seasonLock' name='lockDate' /><font color='red'>*</font></td></tr>
						<tr><td>End Date:</td><td><input type='date' id='seasonEnd' name='endDate' /><font color='red'>*</font></td></tr>
						<tr><td colspan='2'><button class='add' id='addSeason' value='Add'>Add</button></td></tr>
						<tr><td id='addSeasonMsg' class='confirmText' colspan='2'></td></tr>
					</table>
				</div>
				<div class='right-center'>
					<?php
					$listSeasonsQry ="SELECT year, startDate, lockDate, endDate, title FROM seasons";
					$result = mysqli_query($link, $listSeasonsQry);
					if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}

					//Build 5 column table (year, startDate, lockDate, endDate, title)
					$tableStart="<table id='seasonList'><thead class='tblHead'><tr></tr><td>Year</td><td>Start</td><td>Lock</td><td>End</td><td>Title</td><td></td><td></td></tr></thead><tbody>";
					$tableEnd="</tbody><tfoot><tr><td colspan='4'><button id='saveSeasonEdit' class='add'>Save Edits</button></td></tr></tfoot></table>";
					echo $tableStart;
					
					//Display list of records
					while ($row = mysqli_fetch_row($result)){
						echo "<tr><td><input id='".$row[0]."' type='text' class='varLength' value='".$row[0]."' disabled /> </td>";
						echo "<td><input id='startDate_".$row[0]."' type='date' class='varLength' value='".$row[1]."' disabled /> </td>";
						echo "<td><input id='lockDate_".$row[0]."' type='date' class='varLength' value='".$row[2]."' disabled /> </td>";
						echo "<td><input id='endDate_".$row[0]."' type='date' class='varLength' value='".$row[3]."' disabled /> </td>";
						echo "<td><input id='title_".$row[0]."' type='text' class='varLength' value='".$row[4]."' disabled /> </td>"; 
						//Add edit and delete button rows
						echo "<td><button class='editBtn' id='edit_".$row[0]."'>Edit</button></td>";
						echo "<td><button class='deleteBtn' id='delete_".$row[0]."'>Delete</button></td></tr>";
					}
					echo $tableEnd;
					echo "<div id='textput'></div>";
					//Edit Delete Actions
					?>
				</div>
			</div>
		</div>
 <!-- TAB3 -->
        
        <div id="tab3" class="tab">
            <p>GAME RESULTS</p>
            <p>
			<ul>
				<li>ASPX select box to choose season.</li>
				<li>Query to choose all games in that season.</li>
				<li>Lock edits.</li>
				<li>If current season, unlock + editable.</li>
				<li>Radio buttons and "Save" button on each game record to Update database.</li>
				<li>Give message back to user to confirm save</li>
			</ul>
			</p>

				<table id='seasonsTbl'>
					<tr><td>Season:</td><td>
						<select id='seasonSelect' name='seasonSelect' onChange='seasonSelect(this.value)'>
						<option value=''>Select a season...</option>
							<?php 
							$seasonsQry = "SELECT * FROM seasons ORDER BY current DESC";
							$result = mysqli_query($link, $seasonsQry);
							if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
							$seasonsCount = mysqli_num_rows($result);
							while ($row = mysqli_fetch_row($result)){
								echo "<option value='".$row[0]."'>".$row[4]."</option>";
							}
							$season = $row[0];
							?>
					</select><font color='red'>*</font>
						</td>
					</tr>
					<tr></tr>
				</table>
        </div>
        
 <!-- TAB4 -->
        
        <div id="tab4" class="tab">
            <p>User Payment Tab Report information goes here</p>
            <p>The "User Payments" section is under construction. This area will be used to track which players have paid their
            league dues, and which ones have not.</p>
        </div>
    </div>
</div>

	<div id='AdminTabs'>
		<br>
		 <?php
			
			
		 ?>
	</div>



<!-- Display lower third
-->

	<div class='clear'></div>
	<div class='clear'></div>


	<div class='container'>

		<div class='one-third column'>
			<a href='PickList.php'><img src='images/mypicks.png'>
			<h3>My Picks</h3></a>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
		</div>


		<div class='one-third column'>
			<a href='leaderboard.php'><img src='images/misc/goals.png'>
			<h3>Leaderboard</h3></a>
			<p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur.</p>
		</div>



		<div class='one-third column'>
			<img src='images/misc/about_us.png'>
			<h3>Profile</h3>
			<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		
	</div>


	<div class='clear'></div>


	<div class='blue'>

		<div class='container'>
			<h3>About this project</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			<a href='#' class='dalej'>Find it on GitHub</a>
		</div>

	</div>
	</div>
</body>
</html>
