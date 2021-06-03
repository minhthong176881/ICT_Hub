<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<form action="javascript:submit();" method="POST">
    <input class="title" id="title" type="text" name="title" placeholder="Title" required>
    <br>
    <div class="dropdown dropdown-tags tag-input">
        <input type="text" id="inputTags" name="tags" placeholder="Tag your post. Maximum 5 tags. At least 1 tag." required>
        <div class="dropdown-content dropdown-bg" style="margin-left: 5%">
            <?php
            $tagList = "";
            foreach ($post->tags as $tag) {
                $tagList .= $tag->name . " ";
            }
            foreach ($tags as $tag) {
                if (str_contains($tagList, $tag->name))
                    echo "<div class='checkbox-tags'><input class='tag' type='checkbox' name='" . $tag->name . "' value='" . $tag->_id . "' onclick='check()' checked/>";
                else echo "<div class='checkbox-tags'><input class='tag' type='checkbox' name='" . $tag->name . "' value='" . $tag->_id . "' onclick='check()'/>";
                echo "<label style='margin-left: 10px' for='" . $tag->name . "'>" . $tag->name . "</label></div><br>";
            }
            ?>
        </div>
    </div>
    <Textarea style="text-align: left; padding: 15px" class="content" rows="50" name="content" placeholder="Your post's content." id="content" required></Textarea>
    <br>
    <div class="btn-group" style="display: flex; margin-top: 20px;">
        <div style="margin-left: auto; margin-right: 95px">
            <button type="submit" name="btn-submit" class="button-login" style="width: 200px; margin-right: 20px">Update</button>
            <button type="reset" onclick="deletePost()" name="btn-submit" class="button-delete" style="width: 200px; margin-right: 20px">Delete</button>
            <button type="reset" class="button-cancel" style="width: 200px;" onclick="cancel()">Cancel</button>
        </div>
    </div>
</>

<script>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        el[0].classList.add('navbar');

        var title = document.getElementById('title');
        title.value = "<?php echo $post->title ?>";
        var tags = document.getElementById('inputTags');
        tags.value = "<?php echo $tagList ?>";
        var content = document.getElementById('content');
        content.value = `<?php echo $post->content ?>`;
    }

    function cancel() {
        window.location.href = "?controller=users&action=profile&id=<?php echo $post->author->_id ?>";
    }

    function check() {
        var tags = document.querySelectorAll('.tag');
        var inputTags = document.querySelector('#inputTags');
        var selectedTags = [];
        var typedTags = inputTags.value.split(" ");
        for (let i = 0; i < tags.length; i++) {
            if (typedTags.includes(tags[i].value)) {
                selectedTags.push(tags[i].name);
                tags[i].checked = true;
            }
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
        formData.append("content", document.getElementById('content').value);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (parseInt(this.responseText) > 0) {
                    alert('Update post successfully!');
                    window.location.href = '?controller=users&action=profile&id=<?php echo $post->author->_id ?>';
                } else alert('Fail to update post. Some errors occured!');
            }
        }
        xmlhttp.open("POST", "?controller=posts&action=postEdit&id=<?php echo $post->_id ?>");
        xmlhttp.send(formData);
    }

    function deletePost() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (parseInt(this.responseText) > 0) {
                    alert('Delete post successfully!');
                    window.location.href = '?controller=users&action=profile&id=<?php echo $_SESSION['userId'] ?>';
                } else alert('Fail to delete. Some errors occured!');
            }
        }
        xmlhttp.open("GET", "?controller=posts&action=delete&id=<?php echo $post->_id ?>", true);
        xmlhttp.send();
    }
</script>