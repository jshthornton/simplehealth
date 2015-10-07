<?php
use \SimpleHealth\SimpleHealthBuilder as SimpleHealthBuilder;
use \Mockery;

class SimpleHealthBuilderTest extends PHPUnit_Framework_TestCase {
  public function testBuildReturnsCorrespondingObject() {
  	$subject = new SimpleHealthBuilder();
  	$subject->endpoints = ['http://www.php.net/'];
  	$obj = $subject->build();

  	$this->assertInstanceOf('\SimpleHealth\SimpleHealth', $obj);
  }
}
