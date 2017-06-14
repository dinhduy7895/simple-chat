<?php
if (isset($_SESSION['user'])) {
    ?>
    <div class="menu">
        <i class="fa fa-star-o favourite" aria-hidden="true"></i>
        <i class="fa fa-hashtag hastgtag" aria-hidden="true"></i>
        <div class="name text-center"> Room for ALL</div>
    </div>
    <ol class='chat msgs'>
        <?php include("messages.php"); ?>
    </ol>
    <form id="msg_form">
        <input class="textarea" type="text" placeholder="Type here!"/></div>
    </form>
    <?php
}
?>