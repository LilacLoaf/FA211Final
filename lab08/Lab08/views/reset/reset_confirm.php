<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: reset_confirm.class.php
* Description: Shows password reset result.
*/

class ResetConfirm extends View {
    public function display($success) {
        $this->header();
        echo '<div class="row"><div class="column middle">';
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
