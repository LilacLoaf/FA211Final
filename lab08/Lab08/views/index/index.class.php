<?php
/*
* Author: Paxton Ducy
* Date: 2025-11-13
* Name: index.class.php
* Description: Displays the user registration form.
*/

class Index extends View {
    public function display() {
        $this->header();
        echo '
        <div class="row">
            <div class="column middle">
                <h2>Register</h2>
                //register prompt that asks for username, password etc. with a submit button to add it to database
                <form action="index.php?action=register" method="post">
                    <label>User ID: <input type="text" name="user_id" required></label><br>
                    <label>Username: <input type="text" name="username" required></label><br>
                    <label>Password: <input type="password" name="password" minlength="5" required></label><br>
                    <label>Full Name: <input type="text" name="fullname" required></label><br>
                    <label>Email: <input type="email" name="email" required></label><br>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>';
        $this->footer();
    }
}
?>
