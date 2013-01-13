<?php

  // DISCLAIMER: This code is supposed to quick, not good :-P

  $urlBase = 'https://cv-pls.pieterhordijk.com/';

  $ffUpdateManifest = 'mozilla/update.rdf';
  $ffUpdateBinary = 'mozilla/cv-pls_0.20.1.xpi';

  $cmUpdateManifest = 'chrome/update.xml';
  $cmUpdateBinary = 'chrome/cv-pls_0.20.1.crx';

  if (empty($_GET['browser'])) {
    header('HTTP/1.1 400 Bad Request');
    exit('Browser ID empty');
  }

  switch ($_GET['browser']) {
    case 'mozilla':
      header('Content-Type: application/rdf+xml');
      header('Content-Length: '.filesize($ffUpdateManifest));
      readfile($ffUpdateManifest);
      break;

    case 'chrome':
      header('Content-Type: text/xml');
      header('Content-Length: '.filesize($cmUpdateManifest));
      readfile($cmUpdateManifest);
      break;

    default:
      header('HTTP/1.1 400 Bad Request');
      exit('Invalid browser ID');
  }
