<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

if (LoginManager::verifyLogin()) {
    Page::showHeader("MoviesLists", true, "singleMovie.css");
} else {
    Page::showHeader("MoviesLists", true, "singleMovie.css");
}

$dummy_data = array("title" => "Watch List", "description" => "Movies to watch later", "created_at" => "12/12/2020");
?>

<div class="lists-wrapper body-wrapper">
    <div class="container">
        

    </div>
</div>

<?php
Page::footer();
?>