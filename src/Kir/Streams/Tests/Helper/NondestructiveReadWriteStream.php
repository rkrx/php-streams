<?php
namespace Kir\Streams\Tests\Helper;

use Kir\Streams\Exceptions\IOException;
use Kir\Streams\RandomAccessStream;
use Kir\Streams\TruncatableStream;

class NondestructiveReadWriteStream implements RandomAccessStream, TruncatableStream {
	/**
	 * @var RandomAccessStream
	 */
	private $stream = null;

	/**
	 * @param RandomAccessStream $sourceStream
	 */
	public function __construct(RandomAccessStream $sourceStream) {
		// Should solved differently some time
		$this->stream = new MemoryStream();
		$this->stream->write($sourceStream->read());
		$this->stream->rewind();
	}

	/**
	 * @throws IOException
	 * @param int $length
	 * @return string
	 */
	public function read($length = null) {
		return $this->stream->read($length);
	}

	/**
	 * @return bool
	 */
	public function isAtEnd() {
		return $this->stream->isAtEnd();
	}

	/**
	 * @throws IOException
	 * @param string $data
	 * @return $this
	 */
	public function write($data) {
		$this->stream->write($data);
		return $this;
	}

	/**
	 * @throws IOException
	 * @param int $pos
	 * @return $this
	 */
	public function setPosition($pos) {
		$this->stream->setPosition($pos);
		return $this;
	}

	/**
	 * @throws IOException
	 * @return int
	 */
	public function getPosition() {
		return $this->stream->getPosition();
	}

	/**
	 * @throws IOException
	 * @return $this
	 */
	public function rewind() {
		$this->stream->rewind();
		return $this;
	}

	/**
	 * @throws IOException
	 * @return int
	 */
	public function getSize() {
		return $this->stream->getSize();
	}

	/**
	 * @throws IOException
	 * @return $this
	 */
	public function truncate() {
		$this->stream->truncate();
	}
}