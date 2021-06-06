<div class="popup popup-hide warn-popup">
    <div class="model"></div>
    <div class="popup-content">
        <div class="popup-header">
            <div class="popup-title">
                Warning!
            </div>
            <div class="popup-close-button" onclick="btnCloseOnClick()"> &#x2715;</div><br>
            <hr>
        </div><br>
        <div class="popup-body">
        <?php 
        if (isset($warning)) {
            switch ($warning) {
                case 'login':
                    echo '<div style="font-size: 13px; color: #000">You should login before commenting to this post!</div>';
                    break;
                default:
                    echo '<div style="font-size: 13px; color: #000">Some error occured, try again!</div>';
                    break;
            }
        } else 
            echo '<div style="font-size: 13px; color: #000">Some error occured, try again!</div>';
        ?>
        </div>
        <hr>
        <div class="popup-footer">
            <button class="button-login" style="margin-bottom: 25px; width: 30%" onclick="btnCloseOnClick()">OK</button>
        </div>
    </div>
</div>