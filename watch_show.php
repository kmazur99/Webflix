<?php
include('navbar.php');
session_start();

# Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');
require('checkPremium.php');

# Get passed product id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective item data from 'movie' database table. 
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
    </div>
        ';


# Extract show ID
$showID = substr($row['link'], strpos($row['link'], "=") + 1);

# Close database connection.
mysqli_close($link);

include('includes/bootstrap.html');

?>

<html>

<?php
$previous_episode = $episode - 1;
$previous_season = $season - 1;

# Buttons for navigating through seasons and episodes
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . $season . '&episode=' . $previous_episode . '"> <button id="previousEpisode" type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-left"></i> Previous episode</h3></button></a>';
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . $season . '&episode=' . ++$episode . '"> <button id="nextEpisode" type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-right"></i> Next episode</h3></button></a>';
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . $previous_season . '&episode=1"> <button id="previousSeason" type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-left"></i> Previous season</h3></button></a>';
echo '<a href="watch_show.php?id=' . $row['id'] . '&season=' . ++$season . '&episode=1"> <button id="nextSeason" type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-right"></i> Next Season</h3></button></a>';

?>

<script>
  var showID = '<?= $showID ?>';
  var episode = '<?= $episode ?>' - 1;
  var season = '<?= $season ?>' - 1;

  const season_url = '/season/';
  const base_url = 'https://api.themoviedb.org/3/tv/'
  const api_key = '?api_key=1ed6b45ec4f8d4c58a0cde96357735ce';

  const api_url = base_url + showID + season_url + season + api_key;
  const api_url2 = base_url + showID + api_key;

  // Get number of epsiodes in season
  function getEpisodes(api_url) {
    fetch(api_url)
      .then(response => response.json())
      .then(data => {
        checkEpisode(data.episodes.length);
      })
  }

  // Get number of seasons in show
  function getSeasons(api_url2) {
    fetch(api_url2)
      .then(response2 => response2.json())
      .then(data2 => {
        checkSeason(data2.number_of_seasons);
      })
  }

  console.log(episode);
  // Display buttons appropriately to number of episodes in a season
  function checkEpisode(episodeNo) {
    if (episode < episodeNo) {
      document.getElementById("previousEpisode").style.display = "inline";
      document.getElementById("nextEpisode").style.display = "inline";
    }
    if (episode == episodeNo || episode > episodeNo) {
      document.getElementById("previousEpisode").style.display = "inline";
      document.getElementById("nextEpisode").style.display = "none";
    }
    if (episode == 1 || episode == 0) {
      document.getElementById("previousEpisode").style.display = "none";
    }
  }

  // Display buttons appropriately to number of seasons in a show
  function checkSeason(seasonNo) {
    if (season < seasonNo) {
      console.log(season);
      document.getElementById("nextSeason").style.display = "inline";
      document.getElementById("previousSeason").style.display = "inline";

    }
    if (season == seasonNo || season > seasonNo) {
      document.getElementById("nextSeason").style.display = "none";
      document.getElementById("previousSeason").style.display = "inline";
    }
    if (season == 1 || season == 0) {
      document.getElementById("previousSeason").style.display = "none";
    }
  }

  getEpisodes(api_url);
  getSeasons(api_url2);
</script>

</html>