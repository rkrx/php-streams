<?php
namespace Kir\Streams;

interface OpenableStream extends Stream {
	/**
	 * @return $this
	 */
	public function open();
} 