    <div class="text-box">
        <h1>Our courses</h1>
    </div>

    </header>


    <!-- course -->

    <div class="course">
        <h1>Courses We Offer</h1>
        <p>Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj.</p>
        <div class="row">
            <?php
            $appeared = [];
            for ($i = 1; $i <= 6; $i++) {
                do {
                    $index = rand(0, count($subject8) - 1);
                } while (in_array($index, $appeared));
                echo "";
                echo "<div class='course-col'>";
                echo "<a style='color:black;' href='?controller=pages&action=subject&id=" . $subject8[$index]->_id . "'><h3>" . $subject8[$index]->name . "</h3>";
                echo "<div class='subject-preview' style='display: flex'>";
                echo "<div class='left-preview'><p>" . $subject8[$index]->description . "</p></div>"; ?>
                <div class="right-preview"><img style="width: 200px;height: 300px; border-radius: 10px" src="<?php if (!empty($subject8[$index]->lecturer->avatar)) echo $subject8[$index]->lecturer->avatar ?>" alt="">
                    <div class="lecturer-info" style="text-align: left;">
                        <p><b>Lecturer:</b> <?php echo $subject8[$index]->lecturer->name ?></p>
                        <p><b>Department:</b> <?php echo $subject8[$index]->lecturer->department->name ?></p>
                        <p><b>Email:</b>
                            <?php
                            for ($j = 0; $j < count($subject8[$index]->lecturer->email); $j++) {
                                if (!empty($subject8[$index]->lecturer->email[$j])) {
                                    if ($j != count($subject8[$index]->lecturer->email) - 1)
                                        echo $subject8[$index]->lecturer->email[$j] . "| ";
                                    else echo $subject8[$index]->lecturer->email[$j];
                                }
                            }
                            ?>
                        </p>
                        <p><b>Web:</b> <a href="<?php echo $subject8[$index]->lecturer->detail ?>" target="_blank"><?php echo $subject8[$index]->lecturer->detail ?></a></p>
                    </div>
                </div>
            <?php
                echo "</div></a>";
                echo "</div>";
                array_push($appeared, $index);
            }
            ?>
        </div>
    </div>

    <div class="content-course">
        <h1>All courses</h1>
        <div>
            <?php
            foreach ($subjects as $sub) {
                echo<<<EOD
                <div class='subject-course' onclick='window.location.href="?controller=pages&action=subject&id={$sub->_id}"'>
                EOD;
                echo "<h3>" . $sub->name . "</h3>";
                // $substr = strlen($sub->description) > 50 ? substr($sub->description, 0, 50) . "..." : $sub->description;
                // echo "<div class='ellipsis'><p>" . $substr . "</p></div>";
                echo "</div>";
            }
            ?>
            <!-- <button onclick="plusDivs(-1)" id="left"><span><i class="fas fa-chevron-left"></i></span></button>
            <button onclick="plusDivs(+1)" id="right"><span><i class="fas fa-chevron-right"></i></span></button> -->
        </div>
    </div>

    <script>
        window.onload = function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('course-header');
        }

        function select(id) {
            window.location.href = "?controller=pages&action=subject&id=" + id;
        }
    </script>