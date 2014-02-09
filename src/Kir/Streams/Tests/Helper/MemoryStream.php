<?php
namespace Kir\Streams\Tests\Helper;

class MemoryStream extends ResourceStream {
	/**
	 */
	public function __construct() {
		parent::__construct('php://memory', 'r+');
	}
}