<?php


$mode = 'create';
?>
<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Create Article
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
                    <h3>New article</h3>
                    <!-- <button>See all <span class="fas fa-arrow-right"></span></button> -->
                </div>

                <div class="card-body">
                    <form action="javascript:submit();" method="POST" style="text-align: center;">
                        <input class="title" type="text" name="title" placeholder="Title" id="title" required>
                        <br>
                        <div class="dropdown  subject-input">
                            <input type="text" id="inputSubject" name="subject" 
                            placeholder="Choose subject that this article belong to" onkeypress="return false;" required>
                            <input style="display:none" type="text" id="inputSubjectId"  required>
                            <div class="dropdown-content dropdown-bg">
                                <?php
                                foreach ($subjects as $subject) {
                                    echo "<div class='checkbox-tags'><input class='subject' type='radio' name='subject' id='" . $subject->_id . "' value='" . $subject->_id . "' onclick='check()'/>";
                                    echo "<label style='margin-left: 10px' for='" . $subject->_id . "'>" . $subject->name . "</label></div><br>";
                                }
                                ?>
                            </div>
                        </div>
                        <Textarea class="content" rows="50" name="content" placeholder="Your post's content." id="content" required></Textarea>
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
        CKEDITOR.replace('content');
    }

    function cancel() {
        window.location.href = "?controller=admin&action=articles";
    }

    function check() {
        var tags = document.querySelectorAll('.subject');
        var inputSubject = document.querySelector('#inputSubject');
        var inputSubjectId = document.querySelector('#inputSubjectId');
     
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].checked){
                 inputSubject.value = tags[i].nextElementSibling.innerHTML;
                 inputSubjectId.value = tags[i].id;
                }
        }
        inputSubject.value = inputSubject.value.trim();
    }

    function submit() {
        var formData = new FormData();
        $title = document.getElementById('title').value;
        // $inputSubject = document.getElementById('inputSubject').value;
        $inputSubjectId = document.getElementById('inputSubjectId').value;
        $content = CKEDITOR.instances.content.getData();


        xhrPost({
                url: '?controller=admin&action=addArticle',
                data: {
                    "title": $title,
                    "inputSubjectId": $inputSubjectId,
                    "content": $content
                },
                success: (responseTxt) => {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Create article successfully!");
                        window.location.href = '?controller=admin&action=articles';
                    } else {
                        alert("Can not create article!");
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