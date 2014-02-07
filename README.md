php-streams
===========

This is a framework-agnostic set of byte-streams to abstract the support for streams in PHP. There is a documentation on the expected behavior. Exceptions and compliance-tests are also included.

Streams
-------

Bytestreams are useful to read and write byte-based data from resources. Those resources can be everything that is able to emit or consume a stream of bytes:

- Devices
- Files
- Networks
- Pipes
- Virtual resources
- etc

Through abstraction an application, service or framework could rely a appropriate interface and is henceforth aware of byte-streams of any form.


Overview
--------

![Inheritance](assets/diagram.png)

### Stream

The `Stream` is the base-class for a number of other classes. Its mail purpose is to give a base type for type-hinting:

```PHP
function handleStream(Stream $stream) {
	if($stream instanceof OutputStream) {
		// ...
	}
	if($stream instanceof InputStream) {
		// ...
	}
	throw new Exception('Unsupported stream type');
}
```

### ClosableStream

An `ClosableStream` is a stream, that can be closed. An IoC-aware component may not enforce this interface as closing a stream could lead to unexpected behavior.


### InfiniteInputStream

An `InfiniteInputStream` is a read-only stream, that has no end. The `InputStream` is good for situations were it doesn't matter if a `Stream` has other abilities then reading data. It does not ship methods to open or close a stream.

Examples:

* Virtual resources
  * [(linux) /dev/random](http://en.wikipedia.org/wiki//dev/random)
  * [(linux) /dev/null](http://en.wikipedia.org/wiki//dev/null)


### InputStream

An `InputStream` is a read-only stream, that has an end. The `InputStream` is good for situations were it doesn't matter if a `Stream` has other abilities then reading data and closing the stream.

Examples:

* Pipe
  * [STDIN](http://en.wikipedia.org/wiki/Standard_streams#Standard_input_.28stdin.29)
* Files
* Networkstreams


### OutputStream

An `OutputStream` is a write-only stream. It has no information on its size or the cursor-position in the stream. The `OutputStream` is good for situations were it doesn't matter if a `Stream` has other abilities then writing data and closing the stream.

Examples:

* Pipe
  * [STDOUT](http://en.wikipedia.org/wiki/Standard_streams#Standard_output_.28stdout.29)
  * [STDERR](http://en.wikipedia.org/wiki/Standard_streams#Standard_error_.28stderr.29)
* Files
* Networkstreams


### OpenableStream

TODO


### TruncatableStream

TODO


### SeekableStream

TODO


### RandomAccessStream

TODO


### VersatileStream

TODO
