    <h1>Our courses</h1>

    </header>


    <!-- course -->

    <div class="course">
        <h1>Courses We Offer</h1>
        <p>Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj.</p>
        <div class="row">
            <?php
            $appeared = [];
            for ($i = 1; $i <= 4; $i++) {
                do {
                    $index = rand(0, count($subjects) - 1);
                } while (in_array($index, $appeared));
                echo "<div class='course-col'>";
                echo "<h3>" . $subjects[$index]->name . "</h3>";
                echo "<p>" . $subjects[$index]->description . "</p>";
                echo "</div>";
                array_push($appeared, $index);
            }
            ?>
        </div>
    </div>

    <div class="semester">

    </div>

    <script>
        window.onload = function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('course-header');
        }

        // Validate external login on server
        // xhrPost(
        //     url = '?controller=users&action=externalLogin',
        //     data = data,
        //     success = function (responseTxt) {
        //         response = JSON.parse(responseTxt);
        //         window.location.href = '?controller=pages&action=home';
        //     },
        //     error = function (status, responseTxt) {
        //         alert('Authenticate error!');
        //         window.location.reload();
        //     }
        // )

        xhrGet(
            url = '?controller=courses&action=detail',
            data = 'id',
            success = function(responseTxt) {
                response = JSON.parse(responseTxt);
                console.log(response);
            },
            error = function (status, responseTxt) {
               console.log('Error!');
            }
        )
    </script>