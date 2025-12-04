<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: welcome_controller.php
 * Description:
 */

class WelcomeController
{
    public function index(): void
    {
        $view = new WelcomeView();
        $view->display();
    }
}