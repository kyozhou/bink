<?php
include 'engine/app.php';
require 'common.php';
$menu_current = "packer.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include "head.php"; ?>
        <script src="js/packer/my.js"></script>
        <script src="js/packer/base2-load.js"></script>
        <script src="js/packer/Packer.js"></script>
        <script src="js/packer/Words.js"></script>
        <script src="js/packer/bindings.js"></script>
    </head>
    <body>
        <?php include "header.php"; ?>
        <div id="center">
            <div id="center_article">
                <div id="center_article_title">JS超级压缩</div>
                <div class="fenge2"></div>
                <div id="center_article_content">
                    <textarea id="input" name="input" rows="10" cols="130" spellcheck="false"></textarea>
                    <div>
                    <button type="button" id="pack-script">压缩</button>
                    <input type="checkbox" id="shrink" name="shrink" value="1" checked class="none" />
                    <input type="checkbox" id="base62" name="base62" value="1" checked class="none" />
                    </div>
                    <textarea id="output" name="output" rows="10" cols="130" readonly="" spellcheck="false"></textarea>
                </div>
            </div>
        </div>

        </div>
        <?php include "footer.php"; ?>
    </body>
</html>