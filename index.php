<?php
include("connect/config.php");
if (!isset($_SESSION['user'])) {
    header("location: login.php");
} ?>
<!DOCTYPE html>
<html>
<head>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="font/css/font-awesome.min.css">
    <link href="css/chat.css" rel="stylesheet"/>
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet"/>

    <title>PHP Group Chat With jQuery & AJAX</title>
</head>
<body>
<div id="content container-full">
    <div class=" container">
        <div class="users col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="container info-user">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 infor" >
                    <div class="avatar col-lg-6 col-xs-6 col-sm-6 col-md-6" style="padding: 0px;"><img class="img-responsive"
                                             src="<?php echo Image::getImage($_SESSION['avatar']); ?>" alt=""></div>
                    <div class="username col-lg-6 col-xs-6 col-sm-6 col-md-6" style="padding: 0px;"><span><?php echo $_SESSION['user']; ?></span></div>
                </div>
                <div class="dropdown col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                    <i class="show-status fa fa-chevron-down" aria-hidden="true"
                       style="cursor: pointer; padding-right: 1em;"></i>

                </div>
            </div>
            <div id="myDropdown" class="container dropdown-content">
                <div class="wrapper-arrow">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <a href="logout.php">Log Out</a>
                </div>
                <div class="wrapper-arrow">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <a data-toggle="modal" data-target="#myModal">Upload Avatar</a>
                </div>
            </div>
            <div class="container list-users">
                <?php include("listUsers.php"); ?>
            </div>

            <footer>
                Dinh Van Duy
            </footer>
        </div>
        <div class="chatbox col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <?php
            include("chatbox.php");
            ?>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please Choose New Avataer</h4>
                    </div>
                    <div class="modal-body">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input id="file-0" class="file" name="image" type="file" multiple data-min-file-count="1">
                            <br>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="plugin/jquery-3.2.1.min.js"></script>
<script src="plugin/chat.js"></script>
<script src="plugin/fileinput.js" type="text/javascript"></script>
<script src="plugin/bootstrap.min.js"></script>

<script>
    
    $("#myDropdown").hide();
    $(".show-status").on("mousedown", function () {
        if ($("#myDropdown").css("display") == 'none') {
            $("#myDropdown").slideDown("slow");
            $(".list-users").hide(300);
        }
        else {
            $("#myDropdown").hide(300);
            $(".list-users").slideDown("slow");
        }

    });


</script>
</body>
</html>
