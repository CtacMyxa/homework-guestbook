<?php
namespace Work\GuestBookBundle\Entity;

class TestClass
{
  protected $test;
  protected $bar;

    public function getBar()
    {
        return $this->bar;
    }

    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }
}
