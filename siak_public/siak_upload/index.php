<?php
session_start();

    // Include the DirectoryLister class
    require_once('resources/DirectoryLister.php');

    // Initialize the DirectoryLister object
    $lister = new DirectoryLister();

    // Return file hash
    if (isset($_GET['hash'])) {

        // Get file hash array and JSON encode it
        $hashes = $lister->getFileHash($_GET['hash']);
        $data   = json_encode($hashes);

        // Return the data
        die($data);

    }

    // Initialize the directory array
    if (isset($_GET['dir']) && $_SESSION['username'] != "fimprs") {
        $dirArray = $lister->listDirectory($_GET['dir']);
    } else {
        $dirArray = $lister->listDirectory('.');
    }

    // Define theme path
    if (!defined('THEMEPATH')) {
        define('THEMEPATH', $lister->getThemePath());
    }

    // Set path to theme index
    $themeIndex = $lister->getThemePath(true) . '/index.php';

    // Initialize the theme
    if (file_exists($themeIndex)) {
        include($themeIndex);
    } else {
        die('ERROR: Failed to initialize theme');
    }
