<?php
namespace Kir\Streams;

interface InputStream extends Stream {
	/**
	 * @return bool
	 */
	public function isEof();

	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);
}
