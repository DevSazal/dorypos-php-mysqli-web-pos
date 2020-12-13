<?php
session_start(); //to ensure you are using same session
require 'function.php';
session_destroy(); //destroy the session
header('location: index.php?app='.handler().'&token='.token()); //to redirect back to "index.php" after logging out
exit();

?>
