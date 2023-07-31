<?php
include 'links.php';
?>

<style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        footer{
            background-color: #a6c2d4;
        }
        .footerContainer{
            width:100%;
            padding: 5px 30px 5px;
        }
        .socialIcons{
            display:flex;
            justify-content: center;
        }
        .socialIcons a{
            text-decoration: none;
            padding: 10px;
            background-color: white;
            margin: 10px;
            border-radius: 50px;
        }
        .socialIcons a i{
            font-size: 2em;
            color: indianred;
            opacity: 0.9;
        }
        /* hover effect on social media icon */
        .socialIcons a:hover{
            background-color: #a6c2d4;
            transition: 0.5s;
        }
        .socialIcons a:hover i{
            color: indianred;
            transition: 0.5s;
        }
        .footerNav{
            margin: 5px 0;
        }
        .footerNav ul{
            display:flex;
            justify-content: center;
            list-style-type: none;
        }
        .footerNav ul li a{
            color: black;
            margin: 20px;
            text-decoration: none;
            font-size: 1.3em;
            opacity: 0.7;
            position: relative;
            transition: 0.2s;
        }
        .footerNav ul li  a:before{
            content: '';
            position: absolute;
            top:0;
            left: 0;
            width: 0%;
            height: 100%;
            border-bottom: 2px solid indianred;
            transition: 0.4s linear;
        }
        .footerNav ul li a:hover::before{
            width: 90%;
        }
        .footerNav ul li a:hover{
            opacity: 2;
        }
        .footerNav .copyright{
            color: #817b7b;
            opacity: 3;
            margin-top: 15px;
            text-align: center;
            font-size: 15px;
        }
        .designer{
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 400;
            margin: 0px 5px;
        }
        .body{
            min-height: 100vh;
        }
        .shiftFooter{
            position: sticky;
            top: 100%;
        }
    </style>
    <footer class="shiftFooter">
        <div class="footerContainer">
            <div class="socialIcons">
                <a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-google-plus-official" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-github-square" aria-hidden="true"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">Privacy Policy</a></li>
                </ul>
                <p class="copyright">Copyright &copy;2023; Designed by <span class="designer">Nilima & Archana</span></p>
            </div>
        </div>
    </footer>