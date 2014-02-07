<?php
namespace Kir\Streams;

interface InputStream extends Stream {
	/**
	 * @return bool
	 */
	public function isEof();
}
