<?php
namespace SimpleHealth;
use \SimpleHealth\ValidatorResult as ValidatorResult;
use \SimpleHealth\ValidatorInterface as ValidatorInterface;
use \ValueObjects\StringLiteral\StringLiteral as StringLiteral;
use \ValueObjects\Structure\Collection as Collection;

class NodeValidator implements ValidatorInterface {
	function __construct() {
	}

	public function isValid(Collection $reports) {
		foreach ($reports->toArray() as $report) {
			if($report->pass === false) {
				return new ValidatorResult(false, $report->message);
			}
		}

		return new ValidatorResult(true, StringLiteral::fromNative(''));
	}
}