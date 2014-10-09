<?php

use Pep\I18n\Locale\Locale;
use Pep\I18n\I18n;

class LocaleTest extends PHPUnit_Framework_TestCase {

  public function testLocale() {
    $headers = array(
      'en',
      'en-ca,en;q=0.8,en-us;q=0.6,de-de;q=0.4,de;q=0.2',
      'en-US,en;q=0.8,nl;q=0.6,af;q=0.4',
      'en-US,en;q=0.9,ja;q=0.8,fr;q=0.7,de;q=0.6,es;q=0.5,it;q=0.4,nl;q=0.3,sv;q=0.2,nb;q=0.1',
    );
    foreach ($headers as $header) {
      $i18n = I18n::parse($header);

      $this->assertEquals(strlen($i18n->getLocale()->getLanguage()), 2);

      echo $i18n->getLocale();
    }
  }

}