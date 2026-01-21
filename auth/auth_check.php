<?php
/**
 * =======================================
 * AUTH CHECK (PAGE PROTECTION)
 * =======================================
 */

// Session sudah dimulai di config.php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}
