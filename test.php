<?php
    session_start();
    header("Content-Type: text/html; charset=UTF-8");

    $mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";
    $path = isset($_REQUEST["path"]) ? $_REQUEST["path"] : "";
    $page = basename($_SERVER["PHP_SELF"]);
    $inputPw = isset($_POST["inputPw"]) ? $_POST["inputPw"] : "";
    $accessPw = "1234";
    $accessFlag = isset($_SESSION["accessFlag"]) ? $_SESSION["accessFlag"] : "";

    if ($accessFlag == "Y") {
        if ($mode == "logOut") {
            unset($_SESSION["accessFlag"]);
            session_destroy();
            echo "<script>location.href='{$page}'</script>";
            exit();
        }
    } else {
        if ($mode == "login" && $accessPw == $inputPw) {
            $_SESSION["accessFlag"] = "Y";
            echo "<script>location.href='{$page}'</script>";
            $inputPw = 0;
            exit();
        }
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    debug_to_console($accessFlag);
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>과제</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <? if ($accessFlag!="Y") {?>
                    <form action="<?=$page?>?mode=login" method="POST" style="margin-top:24px">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Password</span>
                            <input type="password" class="form-control" placeholder="Password Input..." name="inputPw"> 
                            <button class="btn btn-outline-secondary" type="submit" for="inputGroupFile02">Auth</button>
                        </div>
                    </form>
                    <? if (!empty($inputPw)) {?>
                        <div style="text-align:center">
                            <p class="text-dark" style="display:inline-block;margin-top:10px;--bs-text-opacity: .4">로그인 실패</p>  
                        </div>
                    <?}?>
                <? } else { ?>
                    <div style="margin-top: 20px; margin-top: 24px">
                        <div style="display:inline-block">
                            <h2>Welcome</h2>
                        </div>
                        <div style="display:inline-block; height:10px">
                        </div>
                        <div style="display:inline-block">
                            <small>but this site has NO data. just Enjoy!</small>
                        </div>
                        <div style="display:inline-block; margin-left: 10px; font-size: 18px;">
                            <a class="nav-link" href="<?=$page?>?mode=logOut">Logout</a>
                        </div>
                    </div>
                <? } ?>
            <div>
            <div class="col-md-3"></div>
        </div>    
    </body>
</html>
