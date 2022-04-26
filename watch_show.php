<?php

session_start();

# Display navbar
include('navbar.php');
# Check if user is logged in
include('redirect.php');
# Open database connection.
require('connect_db.php');
# Check if the user has premium subscription
require('checkPremium.php');

# Get passed the show id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective show data from the database.
$q = "SELECT * FROM tv_show WHERE id = $id";
$r = mysqli_query($link, $q);

if (isset($_GET['season'])) $season = $_GET['season'];
if (isset($_GET['episode'])) $episode = $_GET['episode'];

$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

echo '
    <title>Webflix</title>
    <div id="mv-info">
    <div id="content-embed">
    <iframe class="embed-responsive-item" src=' . $row['link'] . '&s=' . $season . '&e=' . $episode . ' 
    frameborder="no" scrolling="no" allow="autoplay; encrypted-media" allowfullscreen="yes" style="width: 100%; height: 100%;"></iframe></div>
    </iframe>
    </div>
        ';

# Extract show ID
$showID = substr($row['link'], strpos($row['link'], "=") + 1);

# Close database connection.
mysqli_close($link);

# Load bootstrap + css
include('includes/bootstrap.html');
?>

<html>
<div class="container-fluid" style="padding-top: 10px; padding-bottom: 20px;">
<?php
$previous_episode = $episode - 1;
$previous_season = $season - 1;

# Buttons for navigating through seasons and episodes
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . $season . '&episode=' . ++$episode . '"> <button id="nextEpisode" type="button" class="btn btn-secondary" role="button" style="float: right;"><h4><i class="fa-solid fa-caret-right"></i> Next episode</h4></button></a>';
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . ++$season . '&episode=1"> <button id="nextSeason" type="button" class="btn btn-secondary" role="button" style="float: right;"><h4><i class="fa-solid fa-caret-right"></i> Next Season</h4></button></a>';
?>
<select id="season" name="season" onchange="location = this.value;">
  <option value="" disabled selected>Season</option>
</select>

<select id="episode" name="episode" onchange="location = this.value;">
  <option value="" disabled selected>Episode</option>
</select>
</div>
<script>
  var showID = '<?= $showID ?>';
  var episode = '<?= $episode ?>' - 1;
  var season = '<?= $season ?>' - 1;
  var id = '<?= $row['id'] ?>';

  const season_url = '/season/';
  const base_url = 'https://api.themoviedb.org/3/tv/'
  const api_key = '?api_key=1ed6b45ec4f8d4c58a0cde96357735ce';

  const api_url = base_url + showID + season_url + season + api_key;
  const api_url2 = base_url + showID + api_key;

  // Get number of epsiodes in season
  function getEpisodesAndSeasons(api_url, api_url2) {
    fetch(api_url)
      .then(response => response.json())
      .then(data => {
        checkEpisode(data.episodes.length);
        displayEpisodes(data.episodes.length);
      })

    fetch(api_url2)
      .then(response2 => response2.json())
      .then(data2 => {
        checkSeason(data2.number_of_seasons);
        displaySeasons(data2.number_of_seasons);
      })
  }

  function displaySeasons(seasons) {
    var select = document.getElementById("season");
    for (var i = 1; i <= seasons; i++) {
      var option = document.createElement('option');
      option.text = "Season " + i;
      option.value = "watch_show.php?id=" + id + "&season=" + i + '&episode=1';
      select.add(option);
    }
  }

  function displayEpisodes(episodes) {
    var select = document.getElementById("episode");
    for (var i = 1; i <= episodes; i++) {
      var option = document.createElement('option');
      option.text = "Episode " + i;
      option.value = "watch_show.php?id=" + id + "&season=" + season + '&episode=' + i;
      select.add(option);
    }
  }
  // Display buttons appropriately to number of episodes in a season
  function checkEpisode(episodeNo) {
    if (episode == episodeNo || episode > episodeNo) {
      document.getElementById("nextEpisode").style.display = "none";
    }
    if(episode < episodeNo){
      document.getElementById("nextSeason").style.display = "none";
    }
  }

  // Display buttons appropriately to number of seasons in a show
  function checkSeason(seasonNo, episodeNo) {
    if (season < seasonNo && episode == episodeNo) {
      document.getElementById("nextSeason").style.display = "inline";
    }
    if (season == seasonNo || season > seasonNo) {
      document.getElementById("nextSeason").style.display = "none";
    }
    if (season == seasonNo && episode == episodeNo) {
      document.getElementById("nextSeason").style.display = "none";
    }
    if((season > seasonNo) && (episode > episodeNo)){
      
    }
  }

  // Call function to get number of seasons and episodes
  getEpisodesAndSeasons(api_url, api_url2);

</script>
</html>