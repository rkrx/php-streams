<?php
namespace Kir\Streams;

interface InputStream extends Stream {
	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);

	/**
	 * @return bool
	 */
	public function isAtEnd();
}
