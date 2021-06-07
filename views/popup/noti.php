<div class="popup popup-hide noti-popup">
    <div class="model"></div>
    <div class="popup-content">
        <div class="popup-header">
            <div class="popup-title">
                <?php
                if (isset($mode)) {
                    if ($mode == 'create') echo "Create post";
                    if ($mode == 'edit') echo "Update post";
                    if ($mode == 'delete') echo "Delete post";
                    if ($mode == 'profile') echo "Update profile";
                }
                ?>
            </div>
            <div class="popup-close-button" onclick="btnCloseOnClick()"> &#x2715;</div><br>
            <hr>
        </div><br>
        <div class="popup-body">
            <?php if (isset($mode)) {
                if ($mode == 'create') echo '<div style="font-size: 13px; color: #000">Created post successfully!</div>';
                if ($mode == 'edit') echo '<div style="font-size: 13px; color: #000">Updated post successfully!</div>';
                if ($mode == 'delete') echo '<div style="font-size: 13px; color: #000">Deleted post successfully!</div>';
                if ($mode == 'profile') echo '<div style="font-size: 13px; color: #000">Updated profile successfully!</div>';
            } ?>
        </div>
        <hr>
        <div class="popup-footer">
            <button class="button-login" style="margin-bottom: 25px; width: 30%" onclick="btnCloseOnClick()">OK</button>
        </div>
    </div>
</div>