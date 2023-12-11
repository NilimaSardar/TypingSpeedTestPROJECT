<?php
$page_title = "About Us";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($page_title)) {
            echo "$page_title";
        } ?> - Typing Speed Test</title>
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" 
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<!-- NAVBAR Section -->
<header>
    <nav>
        <div class="logo">
            Typing-test
        </div>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="how_to.php">How to</a>
            <a href="about.php" class="active">About</a>
        </div>
        <div class="register">
            <div class="login_reg">
                <a href="signup.php">Register</a>
            </div>
            <span class="separator">|</span>
            <div class="login_reg">
                <a href="login.php">Login</a>
            </div>
        </div>
    </nav>
</header>
<!-- Ends NAVBAR Section -->

<!-- Main section -->
    <main>
        <div class="section-hero">
            <div class="container grid grid-two--cols">
                <div class="section-hero--content">
                    <p class="hero-subheading">About</p>
                    <h1 class="hero-heading">
                        Typing-test
                    </h1>
                    <p class="hero-para">
                    At Typing-test, our mission is to help individuals improve their typing skills and
                    become more efficient typists.This page provides an overview of our platform, its 
                    mission, team, history, features, and more. Here's a detailed look at what Typing 
                    World is all about:
                    </p>
                </div>
                <div class="section-hero--image img" >
                    <figure>
                        <img src="images/image.webp" alt="A man Typing">
                    </figure>
                </div>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1701435690">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </main>
<!-- End Main Section -->

<!-- Start Overview and Mission Section Section -->
    <section class="section-why--choose">
        <div class="container grid grid-two--cols">
            <!-- Left side of the content -->
            <div class="section-overview " data-aos="zoom-in-right">

                <div class="why-choose--overview">
                    <h3 class="section-common-heading">Project Overview</h3>
                    <p>
                    Typing World is a web-based platform designed to help individuals enhance their typing skills. Our project focuses on creating an engaging and educational environment for users to improve their typing speed and accuracy.
                    </p>
                </div>  
                
            </div>

            <!-- Right side of the content -->
            <div class="section-overview " data-aos="zoom-in-left" data-aos-delay="600">

                <div class="why-choose--overview">
                    <h3 class="section-common-heading">Mission and Values</h3>
                    <p>
                    Our mission at Typing World is to empower users to become more efficient typists. We believe in fostering a supportive community and promoting the importance of strong typing skills. Our values include inclusivity, user-friendliness, continuous improvement, and the recognition of typing skills in various aspects of life.
                    </p>
                </div>  
                
            </div>

        </div>
    </section>
    <!-- End of Overview and Misssion Section -->

        <!-- start Development Team section -->
        <section class="section-team">
            <div class="container">
                <h2 class="section-common-heading">Development Team</h2>
                <p class="section-common-subheading">
                    Meet the passionate team behind Typing World. Our developer and designer are dedicated to creating a platform that makes learning to type enjoyable and rewarding. Check out our team bios and photos to learn more about the individuals driving the project forward.
                </p>
            </div>

            <div class="container grid grid-three--cols">
                <div class="team-div" data-aos="zoom-in">
                    <div class="icon">
                        <img src="images/coding.webp" alt="">
                    </div>
                    <h1 class="section-common--title">Archana Kumari Mandal</h1>
                    <p>
                        Frontend Developer 
                    </p>
                </div>

                <div class="team-div" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon">
                        <img src="images/coding.webp" alt="">
                    </div>
                    <h1 class="section-common--title">Nilima Sardar</h1>
                    <p>
                         Backend developer
                    </p>
            </div>
    </section>
    <!-- Ends Development Team section -->

     <!-- Start Instruction Section -->
     <section class="section-instruction">
        <div class="container grid grid-two--cols">
                <div class="section-hero--image img" data-aos="fade-up">
                    <figure>
                        <img src="images/instructor.webp" alt="A man Typing">
                    </figure>
                </div>
                <div class="section-hero--content">
                    <h1 class="section-common-heading">
                        Features and Benefits
                    </h1>
                    <p class="section-common-subheading">
                        Explore the features and benefits offered by Typing World:
                    </p>
                    <ol>
                        <li>Interactive typing tests and challenges.</li>
                        <li>Real-time feedback on your typing performance.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Instruction Page -->
<!-- Last Section -->
<section class="section-last">
        <div class="container">
            <h2 class="section-common-heading">Contact Us</h2>
            <p class="section-common-subheading">
            Have questions or feedback? We'd love to hear from you! Feel free to reach out to us at <a href="mailto:typingtest635@gmail.com">typingtest635@gmail.com</a> or use the contact form below.
            </p>
            <div class="login_reg">
                <a href="signup.html">Register Here</a>
            </div>
        </div>
    </section>
    <!-- End last Section -->

<!-- Footer Section -->
<footer class="shiftFooter" data-aos="fade-up" data-aos-delay="300">
        <div class="footerContainer">
            <div class="socialIcons">
                <a href="https://www.facebook.com/neelima.sardar.792"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href="https://instagram.com/______nilima____?igshid=NGVhN2U2NjQ0Yg=="><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/in/nilima-sardar-8416b0283/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                <a href="https://github.com/NilimaSardar"><i class="fa fa-github-square" aria-hidden="true"></i></a>
            </div>
            <div class="footerNav">
                <p class="copyright">Copyright &copy;2023; Designed by <span class="designer">Nilima & Archana</span></p>
            </div>
        </div>
    </footer>
<!-- End Footer Section -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>
