<?php
namespace Kir\Streams\Common\Tests;

use Kir\Streams\Impl\ResourceStream;

class ResourceStreamTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var ResourceStream
	 */
	private $stream = null;

	/**
	 */
	public function setUp() {
		$res = fopen('php://memory', 'r+');
		$this->stream = new ResourceStream($res);
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
 