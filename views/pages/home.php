    <div class="text-box">
        <h1>Diễn đàn đầu hàng công nghệ ở Việt Nam</h1>
        <p>Lorem ipsum dolo abcksjdfskd ksdhaf kasdhf ks aksdfh kasdhf k askdfh k asfdhk </p>
        <a href="https://www.facebook.com/groups/990352754392150" target="_blank" class="hero-btn">Visit us to know more</a>
    </div>

    </header>
    <div class="content">
        <h1>Select courses and learn</h1>
        <div class="semester" style="display: flex">
            <div class="left" style="margin-left: 25%">
                <?php for ($i = 0; $i < 5; $i++) {
                    echo '<div class="dropdown">';
                    echo '<a href="?controller=pages&action=semester&id=' . $semesters[$i]->_id . '"><h3>' . $semesters[$i]->name . '</h3></a>';
                    echo '<div class="dropdown-content dropdown-bg">';
                    if (property_exists($semesters[$i], 'subjects')) {
                        if (count($semesters[$i]->subjects) > 0) {
                            for ($j = 0; $j < count($semesters[$i]->subjects); $j++) {
                                echo '<p class="subject"><a href="?controller=pages&action=subject&id='.$semesters[$i]->subjects[$j]->_id.'">' . $semesters[$i]->subjects[$j]->name . '</a></p>';
                            }
                        }
                    }
                    echo '</div></div><br>';
                } ?>
            </div>
            <div class="right" style="margin-left: auto; margin-right: 25%">
                <?php for ($i = 5; $i < count($semesters); $i++) {
                    echo '<div class="dropdown">';
                    echo '<a href="?controller=pages&action=semester&id=' . $semesters[$i]->_id . '"><h3>' . $semesters[$i]->name . '</h3></a>';
                    echo '<div class="dropdown-content dropdown-bg">';
                    if (property_exists($semesters[$i], 'subjects')) {
                        if (count($semesters[$i]->subjects) > 0) {
                            for ($j = 0; $j < count($semesters[$i]->subjects); $j++) {
                                echo '<p class="subject"><a href="?controller=pages&action=subject&id='.$semesters[$i]->subjects[$j]->_id.'">' . $semesters[$i]->subjects[$j]->name . '</a></p>';
                            }
                        }
                    }
                    echo '</div></div><br>';
                } ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('home-header');
        }
    </script>