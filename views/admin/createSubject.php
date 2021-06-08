<?php


$mode = 'create';
?>
<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Create Subject
        </h2>
        <div class="search-wrapper">
            <span class="fas fa-search"></span>
            <input type="search" placeholder="Search here">
        </div>
        <div class="user-wrapper">
            <img src="assets/img/dominhthong.jpg" width="30px" height="30px" alt="">
            <div>
                <h4><?= $user_given_name ?></h4>
                <p>Super Admin</p>
            </div>
        </div>
    </header>
    <main>
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h3>New subject</h3>
                    <!-- <button>See all <span class="fas fa-arrow-right"></span></button> -->
                </div>

                <div class="card-body">
                    <form action="javascript:submit();" method="POST" style="text-align: center;">
                        <input class="name" type="text" name="name" placeholder="Subject name" id="name" required>
                        <!-- <input class="name" type="text" name="description" placeholder="Subject description" id="description" required> -->
                        <br>
                        <div class="dropdown  subject-input">
                            <input type="text" id="inputSemester" name="subject" 
                            placeholder="Choose semester that this subject belong to" onkeypress="return false;" required>
                            <input style="display:none" type="text" id="inputSemesterId"  required>
                            <div class="dropdown-content dropdown-bg">
                                <?php
                                foreach ($semesters as $semester) {
                                    echo "<div class='checkbox-tags'><input class='subject' type='radio' name='semester' id='" . $semester->_id . "' value='" . $semester->_id . "' onclick='check()'/>";
                                    echo "<label style='margin-left: 10px' for='" . $semester->_id . "'>" . $semester->name . "</label></div><br>";
                                }
                                ?>
                            </div>
                        </div>
                        <Textarea class="" rows="6" name="description" placeholder="Your subject's description." id="description" required></Textarea>
                        <br>
                        <div class="btn-group" style="display: flex; margin-top: 20px;">
                            <div style="margin-left: auto; margin-right: 95px">
                                <button type="submit" name="btn-submit" class="button-login" style="width: 200px; margin-right: 20px">Submit</button>
                                <button type="reset" class="button-cancel" style="width: 200px;" onclick="cancel()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- <?php include "views/popup/noti.php"; ?> -->

<script>
    window.onload = function() {
        // el = document.getElementsByTagName('nav');
        // el[0].classList.add('navbar');
        // CKEDITOR.replace('content');
    }

    function cancel() {
        window.location.href = "?controller=admin&action=subjects";
    }

    function check() {
        var tags = document.querySelectorAll('.subject');
        var inputSemester = document.querySelector('#inputSemester');
        var inputSemesterId = document.querySelector('#inputSemesterId');
     
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].checked){
                 inputSemester.value = tags[i].nextElementSibling.innerHTML;
                 inputSemesterId.value = tags[i].id;
                }
        }
        inputSemester.value = inputSemester.value.trim();
    }

    function submit() {
        // var formData = new FormData();
        $name = document.getElementById('name').value;
        // $inputSemester = document.getElementById('inputSemester').value;
        $inputSemesterId = document.getElementById('inputSemesterId').value;
        // $description = CKEDITOR.instances.content.getData();
        $description = document.getElementById('description').value;

        xhrPost({
                url: '?controller=admin&action=addSubject',
                data: {
                    "name": $name,
                    // "inputSemester": $inputSemester,
                    "inputSemesterId": $inputSemesterId,
                    "description": $description
                },
                success: (responseTxt) => {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Create subject successfully!");
                        window.location.href = '?controller=admin&action=subjects';
                    } else {
                        alert("Can not create subject!");
                        return;
                    }


                },
                error: (status, responseTxt) => {
                    alert('Server error!');
                    // window.location.reload();
                }
            })
    }

    function btnCloseOnClick() {
        var popup = document.querySelector('.popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
        window.location.href = '?controller=pages&action=blog';
    }
</script>