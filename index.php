<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <style>
        *{
        padding: 0;margin:0; box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        :root{
            --clr-body-bg: #366a8d;
            --clr-nav-bg: #a6c2d4;
            --clr-box: indianred;
            --clr-dropdown: #b1c9d7;
            --clr-text: black;
            --clr-text2: white;
        }
        header{
            width: 100%;
            height: 100vh;
            background-color: var(--clr-body-bg);
            background-size: cover;
        }
        nav{
            width: 100%;
            height: 100px;
            background-color: var(--clr-nav-bg);
            color: var(--clr-text);
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .logo{
            font-size: 2.5em;
            letter-spacing: 2px;
        }
        .menu a{
            text-decoration: none;
            color: var(--clr-text);
            opacity: 1;
            padding: 10px 20px;
            font-size: 22px;
            font-weight: 500;
            position: relative;
        }
        .menu a.active{
            background: transparent;
            border-bottom: 3px solid var(--clr-box);
            color: var(--clr-text);
            opacity: 1.5;
            font-size: 22px;
        }
        .menu a:hover{
            font-size: 24px;
            font-weight: bold;
            transition: 0.4s;
        }
        /* Add CSS for the themes dropdown container */
        .themes-dropdown {
            position: relative;
            display: inline-block;
        }

        /* Style the Themes link */
        .theme-link {
            text-decoration: none;
            color: var(--clr-text);
            opacity: 0.7;
            padding: 10px 20px;
            font-size: 22px;
            font-weight: 500;
        }

        /* Style for the themes dropdown content */
        .themes-dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--clr-dropdown);
            min-width: 120px;
            border-radius: 0 0 1rem 1rem;
            z-index: 1;
            transition: 0.4s;
        }

        /* Style for each radio option in the dropdown */
        .themes-dropdown-content label {
            display: block;
            padding: 5px 20px;
            color: var(--clr-text);
            text-decoration: none;
            font-size: 18px;
            font-weight: 500px;
        }

        /* Show the themes dropdown content when hovering over the Themes link */
        .themes-dropdown:hover .themes-dropdown-content {
            display: block;
        }

        .menu input[type="radio"]{
            appearance: none;
        }
        .menu label[for="default"]:hover{
            color: #264b64;
            font-size: 20px;
            font-weight: bold;
            transition: 0.2s;
        }
        .menu label[for="light"]:hover{
            color: grey;
            font-size: 20px;
            font-weight: bold;
            transition: 0.2s;
        }
        .menu label[for="green"]:hover, label[for="green"]:active{
            color: green;
            font-size: 20px;
            font-weight: bold;
            transition: 0.2s;
        }
        .menu label[for="pink"]:hover{
            color:  rgb(248, 120, 141);
            font-size: 20px;
            font-weight: bold;
            transition: 0.2s;
        }
        .menu label[for="dark"]:hover{
            color: #232323;
            font-size: 20px;
            font-weight: bold;
            opacity: 5;
            transition: 0.2s;
        }
        .light,
        :root:has(#light:checked){
            --clr-body-bg: hsl(195, 76%, 84%);
            --clr-nav-bg: hsl(209, 31%, 35%); 
            --clr-box: hsl(209, 48%, 21%);
            --clr-dropdown: hsl(209, 43%, 83%); 
            --clr-text: hsl(209 50% 15%);
            --clr-text2: hsl(209, 14%, 53%);
        }
        .dark,
        :root:has(#dark:checked){
            --clr-body-bg: hsl(208, 49%, 15%);
            --clr-nav-bg: hsl(208, 81%, 20%); 
            --clr-box: hsl(206, 18%, 69%);
            --clr-dropdown: hsl(208, 14%, 53%); 
            --clr-text: hsl(209 50% 90%);
            --clr-text2: hsl(209, 50%, 53%);
        }

        .login_reg a{
            text-decoration: none;
            color: var(--clr-text2);
            padding: 10px 20px;
            font-size: 20px;
            background: var(--clr-box);
            border-radius: 8px;
            transition: 0.4s;
        }
        .login_reg a:hover{
            background: transparent;
            border:1px solid var(--clr-box);
            color: var(--clr-text);
        }
        .h-txt{
            max-width: 650px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            text-align: center;
            color: var(--clr-text2);
        }
        .h-txt span{
            letter-spacing: 5px;
        }
        .h-txt h1{
            font-size: 3.5em;
        }
        .h-txt a{
            text-decoration: none;
            background: var(--clr-box);
            color: var(--clr-text2);
            padding: 10px 20px;
            letter-spacing: 5px;
            transition: 0.4s;
        }
        .h-txt a:hover{
            background: transparent;
            border:1px solid var(--clr-box);
            color: var(--clr-text);
        }
    </style>
    <header>
        <nav>
            <div class="logo">
                Typing-test
            </div>
            <div class="menu">
                <a class="active" href="#">Home</a>
                <a href="test.php">Tests</a>
                <a href="about.php">About</a>
                <a href="#">Lang</a>

                <div class="themes-dropdown">
                    <a href="#" class="theme-link">Themes</a>
                    <div class="themes-dropdown-content">
                        <label for="default" class="theme">
                            <input type="radio" name="theme" id="default" checked>
                            Default
                        </label>
                        <label for="light" class="theme">
                            <input type="radio" name="theme" id="light">
                            Light
                        </label>
                        <label for="dark" class="theme">
                            <input type="radio" name="theme" id="dark">
                            Dark
                        </label>
                    </div>
                </div>
            </div>
            <div class="login_reg">
                <a href="signup.php">Register</a>
            </div>
        </nav>
        <section class="h-txt">
            <span>Hello!</span>
            <h1>Welcome to Typing World</h1>

            <br>
            <a href="login.php">Login</a>
        </section>
    </header>
</body>
<script src="main.js"></script>
</html>