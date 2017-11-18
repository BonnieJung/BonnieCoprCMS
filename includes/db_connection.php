<?php
  // 1. Create a database connection
  define("DB_DRIVER", "localhost");
  define("DB_USER", "widget_cms");
  define("DB_PASS", "secret");
  define("DB_NAME", "widget_corp");
  $connection = mysqli_connect(DB_DRIVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>