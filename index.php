<!DOCTYPE html>
<html>
    <head>
        <title>PartMent 短網址</title>
        <link href="./assets/common.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha384-YWP9O4NjmcGo4oEJFXvvYSEzuHIvey+LbXkBNJ1Kd0yfugEZN9NCQNpRYBVC1RvA" crossorigin="anonymous"></script>
        <script src="./assets/common.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="title">PartMent 短網址</div>
            <div id="url"><input id="urlvalue" type="text" placeholder="輸入網址" onkeyup="urlverify();"><li class="icon icon-error"></div>
            <div id="submit" onclick="make();">產生短網址</div>
        </div>
        <div id="footer">Open Source : <a target="blank" href="https://goo.gl/KjyTa1">https://github.com/partment/PartMent-ShortLink-Generator</a> Dev 0.0.1</div>
    </body>
</html>