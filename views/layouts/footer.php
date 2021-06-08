<button type="button" id="scroll-top" class="btn btn-default" style="background-color: #1da4dd;" aria-label="Left Align">
    <span><i class="fad fa-chevron-double-up"></i></span>
</button>
<footer>
    <hr>
    <h4>About Us</h4>
    <p>This is an online library for ICT student which contains all subjects of global ICT course, <br> also a website for sharing knowledge, discussion.<br>If you have any question, feel free to contact with us. You will get nothing and we will have an unread email.</p>
    <div class="icons">
        <a href="https://www.facebook.com/minhthong176881" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/Minh__Thong" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/_minh.thong/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/thong-do-6b21b3163/" target="_blank"><i class="fab fa-linkedin"></i></a>
    </div>
    <p class="icons">Made with love <i class="far fa-heart"></i></p>
</footer>
<script>
    var scrollButton = document.getElementById('scroll-top');
    window.onscroll = function() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            // document.getElementById("nav-bar").style.display = "none";
            scrollButton.style.display = 'block';
            if (document.querySelector('.fixed-right') != null) {
                document.querySelector('.fixed-right').style.position = 'fixed';
                document.querySelector('.fixed-right').style.top = '10px';
            }
        } else if (document.body.scrollTop > document.body.scrollHeight - 500 || document.documentElement.scrollTop > document.documentElement.scrollHeight - 500) {
            if (document.querySelector('.fixed-right') != null) {
                document.querySelector('.fixed-right').style.top = '';
                document.querySelector('.fixed-right').style.position = '';
            }
        }
        else {
            // document.getElementById("nav-bar").style.display = "initial";
            scrollButton.style.display = 'none';
            if (document.querySelector('.fixed-right') != null) {
                document.querySelector('.fixed-right').style.top = '';
                document.querySelector('.fixed-right').style.position = '';
            }
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