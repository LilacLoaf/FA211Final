<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: reset.class.php
* Description: Password reset form if user is logged in, else error.
*/

class Reset extends View {
    public function display() {
        $this->header();
        echo '<div class="row"><div class="column middle">';
        if (isset($_COOKIE["username"])) {
            $username = htmlspecialchars($_COOKIE["username"]);
            echo "
            <h2>Reset Password</h2>
            <form action='index.php?action=do_reset' method='post'>
                <label>Username: <input type='text' name='username' value='$username' readonly></label><br>
                <label>New Password: <input type='password' name='password' minlength='5' required></label><br>
                <input type='submit' value='Reset Password'>
            </form>";
        } else {
            echo "<p>Error: You must be logged in to reset password.</p>";
        }
        echo '</div></div>';
        $this->footer();
    }
}
?>
