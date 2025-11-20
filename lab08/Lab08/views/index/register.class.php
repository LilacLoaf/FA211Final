<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: register.class.php
* Description: Displays result of registration attempt.
*/

class Register extends View {
    public function display($success) {
        //displays a success or failure alert when you register
        $this->header();
        echo '<div class="row"><div class="column middle">';
        if ($success) {
            echo "<p>Registration successful.</p><a href='index.php?action=login'>Login</a>";
        } else {
            echo "<p>Registration failed. Try again.</p><a href='index.php'>Back to register</a>";
        }
        echo '</div></div>';
        $this->footer();
    }
}
?>
