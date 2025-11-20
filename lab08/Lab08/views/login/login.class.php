<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: login.class.php
* Description: Displays the login form.
*/

class Login extends View {
    //function to display the login page
    public function display() {
        $this->header();
        echo '
        <div class="row">
            <div class="column middle">
                <h2>Login</h2>
                //prompts the user to login using the information they created when registering
                <form action="index.php?action=verify" method="post">
                    <label>Username: <input type="text" name="username" required></label><br>
                    <label>Password: <input type="password" name="password" required></label><br>
                    //submit button for the form
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>';
        $this->footer();
    }
}
?>
