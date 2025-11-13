<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: logout.class.php
* Description: Displays logout confirmation.
*/

class Logout extends View {
    public function display() {
        $this->header();
        echo '
        <div class="row">
            <div class="column middle">
                <p>You have been logged out.</p>
                <a href="index.php">Back to Register</a>
            </div>
        </div>';
        $this->footer();
    }
}
?>
