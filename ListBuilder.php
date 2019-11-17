<?php
/**
 * Created by PhpStorm.
 * User: Brunet Sylvain
 * Date: 16/11/2019
 * Time: 15:38
 */

  class ListBuilder
  {

      private $list = [];

      public function contains($val)
      {
          return in_array($val, $this->list);
      }

      public function add($val)
      {
          if(!$this->contains($val)) {
              $this->list[] = $val;
          }
      }

      public function get()
      {
          return $this->list;
      }

  }
?>