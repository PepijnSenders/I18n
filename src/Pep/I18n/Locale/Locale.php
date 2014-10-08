<?php

namespace Pep\I18n\Locale;

use Pep\I18n\Locale\LocaleException;

class Locale {

  private $language;
  private $region;
  private $script;

  public function __construct($language, $region = "", $script = "") {
    if (!isset($language)) {
      throw new LocaleException('Locale needs a language');
    }
    $this->language = $language;
    $this->region = $region;
    $this->script = $script;
  }

  public static function parse($httpAccept = "", $localeString = "en_US") {
    if (strlen($httpAccept) > 1) {
      $localeStrings = explode(',', $httpAccept);
      foreach ($localeStrings as $locale) {
        if (preg_match("/(.*);q=([0-1]{0,1}.d{0,4})/i", $locale, $matches)) {
          $locales[$matches[1]] = (float) $matches[2];
        } else {
          $locales[$locale] = 1.0;
        }
      }

      $maxQ = max($locales);
      $localeString = array_search($maxQ, $locales);
    }

    $parsedLocale = locale_parse($localeString);
    $locale = new self(
      @$parsedLocale['language'],
      @$parsedLocale['region'],
      @$parsedLocale['script']
    );

    return $locale;
  }

  public function getLanguage() {
    return $this->language;
  }

  public function getRegion() {
    return $this->region;
  }

  public function getScript() {
    return $this->script;
  }

  public function __toString() {
    $formatted = "{$this->language}";
    if ($this->region) {
      $formatted .= "_{$this->region}";
    }
    if ($this->script) {
      $formatted .= "-{$this->script}";
    }
    return $formatted;
  }

}