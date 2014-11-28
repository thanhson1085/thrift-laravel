<?php

class HelloController extends BaseController {

    public function index($name)
    {
        $thrift_client = new Thrift\ThriftClient(
            'Hello\Thrift\HelloServiceClient',
            'localhost',
            9093,
            3600
        );
        $ret = $thrift_client->hello($name);
        echo $ret;die
    }

}
