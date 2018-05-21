<?php

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
  header("location: login.php");
  exit;
}
