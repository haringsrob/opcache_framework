<?php

/**
 * Runs the app.
 */
function runApp(bool $debug = false): void {
    \Framework\Core\App::$debug = $debug;

    $request = new \Framework\Core\Request();

    $request->getResponse();
}

function debugMessage(string $message) {
    $message = 'DEBUG: '. $message;
    logMessage($message);
    echo $message. '<br/>';
    echo 'Disable debug to no longer see these messages';
}

function logMessage(string $message): void {
    $time = new DateTime();
    $data = $time->format('Y-m-d H:i') . ': ' . $message;
    file_put_contents(__DIR__ . '/../log.txt', $data, FILE_APPEND);
}
