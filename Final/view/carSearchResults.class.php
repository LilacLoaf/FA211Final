<?php
/*
 * carSearchResults.class.php
 * View class that loads the existing search_results.php view
 */

class carSearchResults {
    public function display(array $vehicles): void {
        // This will include your existing layout
        include __DIR__ . '/search_results.php';
    }
}

