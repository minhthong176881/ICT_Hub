<form action="?controller=posts&action=savePost" method="POST">
    <input class="title" type="text" name="title" placeholder="Title">
    <br>
    <input class="tag-input" type="text" name="tag" placeholder="Tag your post. Maximum 5 tags. At least 1 tag."><br>
    <Textarea class="content" rows="10" name="content" placeholder="Your post's content." id="post-content"></Textarea>
    <br>
    <div class="btn-group" style="display: flex; margin-top: 20px;">
        <div style="margin-left: auto; margin-right: 95px">
            <button type="submit" name="btn-submit" class="button-login" style="width: 200px; margin-right: 20px">Submit</button>
            <button type="reset" class="button-cancel" style="width: 200px;" onclick="cancel()">Cancel</button>
        </div>
    </div>
</form>

<script>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        el[0].classList.add('navbar');
        CKEDITOR.replace('post-content');
    }

    function cancel() {
        window.location.href = "?controller=pages&action=blog";
    }
</script>