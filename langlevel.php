<?php
    include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0;margin:0; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        body{
            width: 100%;
            height: 100vh;
            background-color: #366a8d;
            background-size: cover;
        }
        .menu-bar{
            color: black;
            opacity: 0.7;
            position: absolute;
            right: 200px;
            top: 30px
        }
        .menu-bar ul{
            display:inline-flex;
            list-style: none;
        }
        .menu-bar ul li{
            padding: 10px 20px;
            font-size: 22px;
            font-weight: 500;
        }
        .menu-bar ul li a{
            text-decoration: none;
            color: black;
        }
        .menu-bar .fa{
            margin-right: 8px;
        }
        .sub-menu-1{
            display: none;
        }
        .menu-bar ul li:hover .sub-menu-1{
            display: block;
            position:absolute;
            background: #a6c2d4;
            margin-top: 0px;
            margin-left: -15px;
        }
        .menu-bar ul li:hover .sub-menu-1 ul{
            display: block;
            margin: 10px;
        }
        .menu-bar ul li:hover .sub-menu-1 ul li{
            width: 150px;
            padding: 10px;
            border-bottom: 1px dotted #fff;
            background: transparent;
            border-radius: 0;
            text-align: left;
        }
        .menu-bar ul li:hover .sub-menu-1 ul li:last-child{
            border-bottom:none;
        }
        .menu-bar ul li:hover .sub-menu-1 ul li a:hover{
            color: #b2ff00;
        }
        .fa-angle-right{
            float: right;
        }
        .sub-menu-2{
            display: none;
        }
        .hover-me:hover .sub-menu-2{
            position: absolute;
            display: block;
            margin-top: -40px;
            margin-left: 140;
            background:#a6c2d4;
        }
    </style>
</head>
<body>
    <nav>
        <div class="menu-bar">
            <ul class="active">
                <li><a href=""><i class="fa fa-language"></i>Language</a>
                    <div class= "sub-menu-1">
                        <ul>
                            <li><a href="">English</a></li>
                            <li><a href="">Nepali</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href=""><i class="fa fa-align-left"></i>Level</a>
                    <div class= "sub-menu-1">
                        <ul>
                            <li class="hover-me"><a href="">Easy</a><i class="fa fa-angle-right"></i>
                                <div class= "sub-menu-2">
                                    <ul>
                                        <li><a href="">Alphabets</a></li>
                                        <li><a href="">Numbers</a></li>
                                        <li><a href="">Characters</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="hover-me"><a href="">Medium</a><i class="fa fa-angle-right"></i>
                            <div class= "sub-menu-2">
                                    <ul>
                                        <li><a href="">Alphabets</a></li>
                                        <li><a href="">Numbers</a></li>
                                        <li><a href="">Characters</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="hover-me"><a href="">Hard</a><i class="fa fa-angle-right"></i>
                            <div class= "sub-menu-2">
                                    <ul>
                                        <li><a href="">Quotes</a></li>
                                        <li><a href="">Facts</a></li>
                                        <li><a href="">Code</a></li>
                                        <li><a href="">Random</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>