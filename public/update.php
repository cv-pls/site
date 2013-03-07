<?php

  // DISCLAIMER: This code is supposed to quick, not good :-P

  if (empty($_GET['browser'])) {
    header('HTTP/1.1 400 Bad Request');
    exit('Browser ID empty');
  }

  $browser = strtolower($_GET['browser']);
  $branch = !empty($_GET['branch']) ? strtolower($_GET['branch']) : 'master';

  switch ($browser) {
    case 'mozilla':
      $cType = 'application/rdf+xml';
      $manifestFile = $branch === 'alpha' ? 'dev/update.rdf' : 'update.rdf';
      break;

    case 'chrome':
      $cType = 'text/xml';
      $manifestFile = $branch === 'alpha' ? 'dev/update.xml' : 'update.xml';
      break;

    default:
      header('HTTP/1.1 400 Bad Request');
      exit('Invalid browser ID');
  }

  $path = __DIR__ . '/' . $browser . '/' . $manifestFile;

  if (!is_file($path)) {
    header('HTTP/1.1 404 Not Found');
    exit('File not found');
  }

  header('Content-Type: ' . $cType);
  header('Content-Length: ' . filesize($path));
  readfile($path);
