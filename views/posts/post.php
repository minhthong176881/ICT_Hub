<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mode = 'create';
?>
<form action="javascript:submit();" method="POST">
    <input class="title" type="text" name="title" placeholder="Title" id="title" required>
    <br>
    <div class="dropdown dropdown-tags tag-input">
        <input type="text" id="inputTags" name="tags" placeholder="Tag your post. Maximum 5 tags. At least 1 tag." required>
        <div class="dropdown-content dropdown-bg" style="margin-left: 5%">
            <?php
            foreach ($tags as $tag) {
                echo "<div class='checkbox-tags'><input class='tag' type='checkbox' name='" . $tag->name . "' value='" . $tag->_id . "' onclick='check()'/>";
                echo "<label style='margin-left: 10px' for='" . $tag->name . "'>" . $tag->name . "</label></div><br>";
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

<?php include "views/popup/noti.php";?>

<script>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        el[0].classList.add('navbar');
        CKEDITOR.replace('content');
    }

    function cancel() {
        window.location.href = "?controller=pages&action=blog";
    }

    function check() {
        var tags = document.querySelectorAll('.tag');
        var inputTags = document.querySelector('#inputTags');
        var selectedTags = [];
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].checked) selectedTags.push(tags[i].name);
            if (!tags[i].checked && inputTags.value.includes(tags[i].name)) inputTags.value = inputTags.value.replace(tags[i].name, '');
        }
        for (let i = 0; i < selectedTags.length; i++) {
            if (!inputTags.value.includes(selectedTags[i])) {
                inputTags.value += ' ' + selectedTags[i];
            }
        }
        inputTags.value = inputTags.value.trim();
    }

    function submit() {
        var formData = new FormData();
        formData.append("title", document.getElementById('title').value);
        formData.append("tags", document.getElementById('inputTags').value);
        formData.append("content", CKEDITOR.instances.content.getData());
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (parseInt(this.responseText) > 0) {
                    var popup = document.querySelector('.popup');
                    window.scrollTo({top: 0, behavior: 'smooth'});
                    if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
                } else alert('Fail to create post. Some errors occured!');
            }
        }
        xmlhttp.open("POST", "?controller=posts&action=save&userId=<?php echo $_SESSION['userId'] ?>");
        xmlhttp.send(formData);
    }

    function btnCloseOnClick() {
        var popup = document.querySelector('.popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
        window.location.href = '?controller=pages&action=blog';
    }
</script>