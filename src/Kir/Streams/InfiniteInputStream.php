<?php
namespace Kir\Streams;

interface InfiniteInputStream extends Stream {
	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);
}