<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);


session_set_cookie_params([
    'lifetime' => 1800,         // 1800seconds -> 30 minutes
    'domain' => 'localhost',    // Cookie is valid for 'localhost' (change to your domain in production)
    'path' => '/',              // Cookie is valid across the entire site ( Cookie Path )
    'secure' => true,           // Cookie is only sent over HTTPS
    'httponly' => true          // Cookie not accessible via JavaScript (helps stop cross-site scripting attacks)
]);

session_start();

if (!isset($_SESSION["last_regeneration"])) {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
}
