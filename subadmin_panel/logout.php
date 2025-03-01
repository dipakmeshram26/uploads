<?php
// Start the session
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: ../admin_panel/dashboard.php");
exit();
?>
