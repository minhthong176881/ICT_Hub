<header class="sub-header contact-header">
    <nav>
        <a href="#"><img src="assets/img/logo.png" alt=""></a>
        <div class="nav-links" id="navLinks">
            <i class="fas fa-times" onclick="hideMenu()"></i>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="?controller=pages&action=about">ABOUT</a></li>
                <li><a href="?controller=pages&action=course">COURSES</a></li>
                <li><a href="?controller=pages&action=blog">BLOG</a></li>
                <li><a href="?controller=pages&action=contact">CONTACT</a></li>
            </ul>
        </div>
        <i class="fas fa-bars" onclick="showMenu()"></i>
    </nav>
    <h1>Contact us</h1>

</header>

<!-- contact us -->
<div class="location">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6408192902422!2d105.840947314245!3d21.00703029389721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76ccab6dd7%3A0x55e92a5b07a97d03!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1620400698490!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>

<div class="contact-us">
    <div class="row">
        <div class="contact-col">
            <div>
                <i class="fas fa-home"></i>
                <span>
                    <h5>XYZ Road, ABC Building</h5>
                    <p>Dai Co Viet, Ha Noi, Viet Nam</p>
                </span>
            </div>
            <div>
                <i class="fas fa-phone"></i>
                <span>
                    <h5>+84 12345678910</h5>
                    <p>Monday to Saturday, 10AM to 6PM</p>
                </span>
            </div>
            <div>
                <i class="fas fa-envelope"></i>
                <span>
                    <h5>info@hust.com</h5>
                    <p>Email us</p>
                </span>
            </div>
        </div>
        <div class="contact-col">
            <form action="submit">
                <input type="text" placeholder="Enter your name" required>
                <input type="email" name="" id="" placeholder="Email">
                <input type="text" name="" id="" placeholder="Your subject">
                <textarea rows="8" placeholder="Message" required></textarea>
                <button type="submit" class="hero-btn red-btn">Send message</button>
            </form>
        </div>
    </div>
</div>