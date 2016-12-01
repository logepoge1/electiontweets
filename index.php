<?php include_once("analyticstracking.php") ?>
<head>
<meta name="google-site-verification" content="lyFIGjk61uHm3jZ6jBGtJ21vmmBOpw8UugCmPUw7qMk" />
<title>2016 Election Candidate Tweet Tracker</title>
<meta name="description" content"The purpose of this page to to allow users to see tweets posted by various candidates in one location">
<meta name="keywords" content="Donald Trump, Trump, The Donald, Hillary Clinton, Clinton, Bernie Sanders, Sanders, Feel The Bern, Gary Johnson, Johnson">
<meta property="og:url"                content="http://electiontweets.xyz" />
<meta property="og:title"              content="2016 Presidential Candidate Tweet Trcker" />
<meta property="og:type"	       content="website" />
<meta property="og:description"        content="A useful interface to compare the tweets of the various presidential candidates in the United States 2016 election?" />
<meta property="og:image"              content="http://electiontweets.xyz/2016_Presidential_Election_ballot.jpg" />
</head>

<span itemscope itemtype="http://schema.org/WebSite"><h1 itemprop="name" style="text-align: center;">2016 Election Tweets</h1>
<meta itemprop="url" content="http://electiontweets.xyz/">
<span itemprop="author" itemscope itemtype="http://schema.org/Person">
<meta itemprop="name" content="Logan Simpson"></span></span>
<h4 style="text-align: center;">All Times In EST. Contact The <a href="mailto:developerinfinity@gmail.com">Developer</a> With Inquiries</h4>

<link href="css/bootstrap.min.css" rel="stylesheet">


<style>
.pager li>a {padding:3vmin;}
h1 { font-size: 7vmin; margin-top:0px;}
h4 { font-size: 2vmin;}
.row{
    overflow: hidden; 
}

[class*="col-"]{
    margin-bottom: -99999px;
    padding-bottom: 99999px;
}
.container > .row:last-of-type {
border-bottom: thin solid black;
}
#candidateMenu {
margin:0 auto;
display: block;
margin-bottom: 10px;
height:5vmin;
width: 38vmin;
font-size: 3vmin;
}
</style>
<?php

date_default_timezone_set('America/Chicago');

$tz_from = new DateTimeZone('UTC');
$tz_to = new DateTimeZone('America/Chicago');

$ini_array = parse_ini_file("config.ini");

$servername = $ini_array["servername"];
$username = $ini_array["username"];
$password = $ini_array["password"];
$dbname = $ini_array["dbname"];
$dropdownSql = "SELECT * FROM candidates ORDER BY name DESC;";

if(isset($_COOKIE['page'])){
        $page = $_COOKIE['page'];
} else{
       $page = '0';
}

$page1 = strval(intval($page) * 18); 
$limit = "LIMIT " . $page1 . ", 18;";

$trumpSql = "SELECT * FROM realDonaldTrump ORDER BY created_at DESC";
$sandersSql = "SELECT * FROM SenSanders ORDER BY created_at DESC";
$clintonSql = "SELECT * FROM HillaryClinton ORDER BY created_at DESC";
$johnsonSql = "SELECT * FROM GovGaryJohnson ORDER BY created_at DESC";
$steinSql = "SELECT * FROM DrJillStein ORDER BY created_at DESC";

$urlID = "";
$sql = "";
if(isset($_COOKIE['candidate'])){
        $dropdownID = $_COOKIE['candidate'];
        if($dropdownID == 'Donald Trump'){
                $sql = $trumpSql;
		$urlID = "realDonaldTrump";
        } else if($dropdownID == 'Bernie Sanders'){
		$sql = $sandersSql;
		$urlID = "SenSanders";
	} else if($dropdownID == 'Hillary Clinton'){
		$sql = $clintonSql;
		$urlID = "HillaryClinton";
	} else if($dropdownID == 'Gary Johnson'){
		$sql = $johnsonSql;
		$urlID = "GovGaryJohnson";
	} else if($dropdownID == 'Jill Stein'){
		$sql = $steinSql;
		$urlID = "DrJillStein";
	}
} else{
       $dropdownID = '';
}

$sql = $sql . " " . $limit;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$dropdownResult = $conn->query($dropdownSql);

echo '<select name="candidate_dropdown" onchange="dropdownSubmit()" id="candidateMenu">';
echo "<option value=''></option>";
while($row = $dropdownResult->fetch_assoc()){
	if($row["name"] == $dropdownID){
	echo "<option value='$row[name]' selected>$row[name]</option>";
	} else{
	 echo "<option value='$row[name]'>$row[name]</option>";
	}
}
echo '</select>';

if($dropdownID != ''){
$sqlResult = $conn->query($sql);
$sizeResult = $sqlResult->num_rows;
echo '<div class="container">';
echo '<div class="row">';
$counter = 0;
while($row = $sqlResult->fetch_assoc()){
	$time = strtotime($row['created_at'] . " UTC");
	$time = date("m/d/y g:i A", $time);
	$url = $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
	$tweet = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $row['tweet']);
	echo "<div class='col-md-2' style='border:1px solid black;'>";
	echo "<h4>$time</h4>";
	echo "<a target='_blank_' href='http://twitter.com/$urlID/status/$row[twitter_id]'>&#91;status&#93;</a>";
	echo "<br/><br/>";
	echo "$tweet";
	echo "<p>";
	echo "</p></div>";
	$counter = $counter + 1;
	if($counter%6 == 0) echo '</div><div class="row">';
}
echo '</div>';


echo '<ul class="pager">';
if($page != 0){
	echo '<li><a class="navButton" href="#" onclick="previousPage()">Previous</a></li>';
	echo '<li><a class="navButton" href="#" onclick="homePage()">Home</a></li>';
}
if($sizeResult == 18)
	echo '<li><a class="navButton" href="#" onclick="nextPage()">Next</a></li>';
echo '</ul>';
echo '</div>';
echo '<form action="files.php">';
echo '<button type="submit" value="Download SQL Dump File">Download SQL Dump File*</button>';
echo '</form>';
echo '<br /><p>*File is updated daily at 12:00AM CST</p>';
}
?>

<script>
function dropdownSubmit(){
                var choice = document.getElementById("candidateMenu");
                document.cookie = "candidate=" + choice.options[choice.selectedIndex].value;
		document.cookie = "page=0";
                window.location.reload();
        }
function nextPage(){
	var currPage = parseInt(<?php echo $page; ?>) + 1;
	document.cookie = "page=" + currPage;
	window.location.reload();
}
function previousPage(){
	var currPage = parseInt(<?php echo $page; ?>) - 1;
	document.cookie = "page=" + currPage;
	window.location.reload();
}
function homePage(){
	document.cookie="page=0";
	window.location.reload();
}
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78232525-1', 'auto');
  ga('send', 'pageview');

</script>
