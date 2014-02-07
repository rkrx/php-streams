<?php
namespace Kir\Streams;

interface InfiniteInputStream extends ClosableStream {
	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);
}