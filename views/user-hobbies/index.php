<?php

use yii\helpers\Html;
use app\models\AddHobbyForm;

/* @var $this yii\web\View */

if($_SERVER['REQUEST_METHOD'] === 'GET') { // a lot of this isn't needed for POST response

$this->title = 'Main';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css" media="screen">
#hobby {display: none;}
</style>

<script type="text/javascript" language="javascript">

function showHobbies(clicked){
  if(!clicked) {
    document.getElementById('hobby').style.cssText='display:none';
    document.getElementById('hobby_btn').style.cssText='display:block';
  }
  else {
    document.getElementById('hobby').style.cssText='display:block';
    document.getElementById('hobby_btn').style.cssText='display:none';
  }
}

function addHobby(){
  var hobby_item = document.getElementById('source');
  var hobby = hobby_item.value;

  if(hobby) {
  	$.ajax( //jquery ajax request
  	{
  		url: "index.php?r=user-hobbies/index",
  		type: "POST",
  		data: "hobby=" + hobby,
  		success: function(response) {
  			var count = (response.match(/failed/g) || []).length;
  			if(count <= 0) {
	          document.getElementById("hobby_item").innerHTML += "<li>" + response + "</li>";
	          document.getElementById('hobby_btn').innerHTML = "Add Another Hobby";
	          showHobbies(false);
	        }
	        else {
	          showHobbies(false);
	        }
  		}
  	});
  }
  else {
    showHobbies(false);
  }
}

</script>

<div class="user-hobbies-index">

<h2>Hobbies</h2>
<?= Html::ul(null, ['id' => 'hobby_item']); ?> <!-- filled programmatically -->

<div><?= Html::button('Add a Hobby', ['class' => 'btn-primary', 'id' => 'hobby_btn', 'onclick'=>'js:showHobbies(true);'])?></div>

<div id='hobby'>
<?php
$hobbies = array("Acting"=>"Acting","Antiquing"=>"Antiquing","Backgammon"=>"Backgammon","Backpacking"=>"Backpacking","Badminton"=>"Badminton","Baseball"=>"Baseball","Basketball"=>"Basketball",
	"Board games"=>"Board games","Camping"=>"Camping","Computer programming"=>"Computer programming","Cycling"=>"Cycling","Drawing"=>"Drawing","Gymnastics"=>"Gymnastics","Ice skating"=>"Ice skating",
	"Martial arts"=>"Martial arts","Painting"=>"Painting","People Watching"=>"People Watching","Rock climbing"=>"Rock climbing","Skiing"=>"Skiing","Snowboarding"=>"Snowboarding",
	"Slacklining"=>"Slacklining","Swimming"=>"Swimming","Traveling"=>"Traveling","Triathlon"=>"Triathlon","Video Games"=>"Video Games","Walking"=>"Walking","Weightlifting"=>"Weightlifting",
	"Windsurfing"=>"Windsurfing","Wrestling"=>"Wrestling","Writing"=>"Writing","Yoga"=>"Yoga","Ziplining"=>"Ziplining","Zumba"=>"Zumba");
echo Html::dropDownList('Hobbies', null, $hobbies, ['id' => 'source', 'onblur'=>'js:addHobby();'])
?></div>
<?php
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'GET') {
	$hobbies = AddHobbyForm::getUserHobbies();
	if(!empty($hobbies)) {
		echo ('<script type="text/javascript">
            document.getElementById("hobby_btn").innerHTML = "Add Another Hobby";
          </script>
        ');
		foreach($hobbies as $hobby) {
			echo ('
	            <script type="text/javascript">
	              document.getElementById("hobby_item").innerHTML += "<li>" + "'.addslashes($hobby->hobby).'" + "</li>";
	            </script>
	        ');
		}
	}
}

if (isset($_POST['hobby'])) { // adding a new hobby functionality (called from AJAX request)
  $hobby = trim($_POST['hobby']);
  if(!empty($hobby)) {
  	if(AddHobbyForm::insertUserHobby($hobby)){
  		exit($hobby);
  	}
  	else {
	    exit("failed");
	  }

  }
  else {
    exit("failed");
  }
}
?>

</div>

