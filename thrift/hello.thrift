namespace py hello.thrift
namespace php Hello.Thrift

include "exceptions.thrift"

service HelloService {
	string hello(
		1: required string name
	) throws (
		1: exceptions.EUnknown ie
	)
}
