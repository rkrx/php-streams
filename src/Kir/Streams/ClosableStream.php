<?php
namespace Kir\Streams;

interface ClosableStream extends Stream {
	/**
	 * @return $this
	 */
	public function close();
} 