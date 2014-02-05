<?php
namespace Kir\Streams\Impl;

class StringStreamTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var StringStream
	 */
	private $stream = null;

	/**
	 */
	public function setUp() {
		$this->stream = new StringStream('');
	}

	/**
	 */
	public function testRead() {
		$this->resetStream();
		$data = $this->stream->read(7);
		$this->assertEquals('This is', $data);
	}

	/**
	 */
	public function testReadAll() {
		$this->resetStream();
		$data = $this->stream->read();
		$this->assertEquals('This is a test', $data);
	}

	/**
	 */
	public function testWrite() {
		$this->resetStream();
		$this->stream->truncate();
		$this->stream->write('ABCDEFG');
		$this->stream->rewind();
		$data = $this->stream->read();
		$this->assertEquals('ABCDEFG', $data);
	}

	/**
	 */
	private function resetStream() {
		$this->stream->truncate();
		$this->stream->write('This is a test');
		$this->stream->rewind();
	}
}
 