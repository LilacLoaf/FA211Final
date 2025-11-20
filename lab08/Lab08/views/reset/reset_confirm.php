<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: reset_confirm.class.php
* Description: Shows password reset result.
*/

class ResetConfirm extends View {
    //function that displays the password reset results
    public function display($success) {
        $this->header();
        //message formatting
        echo '<div class="row"><div class="column middle">';
        //displays success or failure message depending on results
        if ($success) {
            echo "<p>Password reset successful.</p><a href='index.php?action=logout'>Logout</a>";
        } else {
            echo "<p>Password reset failed.</p><a href='index.php?action=reset'>Try Again</a>";
        }
        echo '</div></div>';
        $this->footer();
    }
}
?>
