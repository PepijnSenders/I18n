<?php

namespace Pep\I18n;

use Pep\I18n\Locale\Locale;

class I18n {

  /**
   * @var Pep\I18n\Locale\Locale
   */
  private $locale;

  public function __construct(Locale $locale) {
    $this->locale = $locale;
  }

  public static function fromHttpAccept($httpAccept) {
     $locale = Locale::parse($httpAccept);

     $i18n = new self($locale);

     return $i18n;
  }

  public function getLocale() {
    return $this->locale;
  }

}