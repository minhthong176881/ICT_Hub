<button type="button" id="scroll-top" class="btn btn-default" style="background-color: #1da4dd;" aria-label="Left Align">
    <span><i class="fad fa-chevron-double-up"></i></span>
</button>
<footer>
    <hr>
    <h4>About Us</h4>
    <p>Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj. Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj. <br> Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj.</p>
    <div class="icons">
        <a href="https://www.facebook.com/minhthong176881"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/Minh__Thong"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/_minh.thong/"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/thong-do-6b21b3163/"><i class="fab fa-linkedin"></i></a>
    </div>
    <p class="icons">Made with love <i class="far fa-heart"></i></p>
</footer>
<script>
    var scrollButton = document.getElementById('scroll-top');
    window.onscroll = function() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            // document.getElementById("nav-bar").style.display = "none";
            scrollButton.style.display = 'block';
        } else {
            // document.getElementById("nav-bar").style.display = "initial";
            scrollButton.style.display = 'none';
        }
    }
    scrollButton.addEventListener('click', () => {
        document.body.scrollTo({
            top: 0,
            behavior: "smooth"
        })
        document.documentElement.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    })
</script>
<script src="assets/js/script.js"></script>
</body>

</html>