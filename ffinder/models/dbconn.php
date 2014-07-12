<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*  Get the Guitar1 database connection before anything else */
    $dsn = 'mysql:host=localhost;dbname=foodfinder';
    $username = 'foodfinder';
    $password = 'foodfinder';

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo "<p>There was an error connecting to the database.<br>"
            . "Message not displayed for security reasons" . "</p>";
        exit();
    }