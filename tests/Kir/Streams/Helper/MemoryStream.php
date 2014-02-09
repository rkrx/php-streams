<?php
namespace Kir\Streams\Helper;

class MemoryStream extends ResourceStream {
	/**
	 */
	public function __construct() {
		parent::__construct('php://memory', 'r+');
	}
}