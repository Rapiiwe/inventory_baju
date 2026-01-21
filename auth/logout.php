<?php
/**
 * =======================================
 * LOGOUT
 * =======================================
 */

// Session sudah dimulai di config.php

// Hapus semua data session
$_SESSION = [];

// Hancurkan session
session_destroy();

// Redirect ke login
header("Location: index.php?page=login");
exit;
