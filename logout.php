<?php
// 1. Initialize the session framework to access current cookie values
session_start();

// 2. Clear all active session payload array values
$_SESSION = array();

// 3. Destroy the session cookie completely inside the client browser if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Wipe file allocations off the server directory entirely
session_destroy();

// 5. Force access route redirection back to the login screen portal
header("Location: login.php");
exit();
?>