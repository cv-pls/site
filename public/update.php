<?php

  // DISCLAIMER: This code is supposed to quick, not good :-P

  $urlBase = 'https://cv-pls.pieterhordijk.com/';

  $ffUpdateManifest = 'mozilla/update.rdf';
  $cmUpdateManifest = 'chrome/update.xml';

  if (empty($_GET['browser'])) {
    header('HTTP/1.1 400 Bad Request');
    exit('Browser ID empty');
  }

  switch ($_GET['browser']) {
    case 'mozilla':
      if (file_exists($ffUpdateManifest)) {
        header('Content-Type: application/rdf+xml');
        header('Content-Length: '.filesize($ffUpdateManifest));
        readfile($ffUpdateManifest);
      } else {
        header('HTTP/1.1 404 Not Found');
      }
      exit;

    case 'chrome':
      if (file_exists($cmUpdateManifest)) {
        header('Content-Type: text/xml');
        header('Content-Length: '.filesize($cmUpdateManifest));
        readfile($cmUpdateManifest);
      } else {
        header('HTTP/1.1 404 Not Found');
      }
      exit;

    default:
      header('HTTP/1.1 400 Bad Request');
      exit('Invalid browser ID');
  }
