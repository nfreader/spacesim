<?php

namespace ssim\Data;

class AuditTypes {

  const NEWSTAR = "Added a star";

  static function getTypes() {
    return (new \ReflectionClass(__CLASS__))->getConstants();
  }

}