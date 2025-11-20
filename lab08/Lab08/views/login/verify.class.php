<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: verify_user.class.php
* Description: Shows login confirmation result.
*/

class VerifyUser extends View {
    //function that shows login results
    public function display($success) {
        $this->header();
        echo '<div class="row"><div class="column middle">';
        //displays a success or failure alert after the user enters their info and clicks login
        if ($success) {
            echo "<p>Login successful. <a href='index.php?action=reset'>Reset Password</a> or <a href='index.php?action=logout'>Logout</a></p>";
        } else {
            echo "<p>Login failed. <a href='index.php?action=login'>Try Again</a></p>";
        }
        echo '</div></div>';
        $this->footer();
    }
}
?>
