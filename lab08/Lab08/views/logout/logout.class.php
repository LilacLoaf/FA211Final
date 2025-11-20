<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: logout.class.php
* Description: Displays logout confirmation.
*/

class Logout extends View {
    //function that displays logout results
    public function display() {
        $this->header();
        echo '
        <div class="row">
        //displays a message and prompts the user back to registration
            <div class="column middle">
                <p>You have been logged out.</p>
                <a href="index.php">Back to Register</a>
            </div>
        </div>';
        $this->footer();
    }
}
?>
