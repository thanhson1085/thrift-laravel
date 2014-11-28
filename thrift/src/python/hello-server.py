#!/usr/bin/env python

import sys
import logging

from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from thrift.server import TNonblockingServer

from hello.thrift import HelloService
from hello.handler import HelloHandler

port = 9093

handler = HelloHandler()
processor = HelloService.Processor(handler)
transport = TSocket.TServerSocket(port=port)
tfactory = TBinaryProtocol.TBinaryProtocolFactory()
pfactory = TBinaryProtocol.TBinaryProtocolFactory()
server = TNonblockingServer.TNonblockingServer(processor, transport, tfactory, pfactory, 10) # be able to run 10 threads

# log to stdout
log = logging.getLogger()
log.setLevel(logging.DEBUG)
formatter = logging.Formatter('%(asctime)s - %(levelname)s - %(threadName)s - %(message)s')

ch = logging.StreamHandler(sys.stdout)
ch.setLevel(1)

ch.setFormatter(formatter)
log.addHandler(ch)

logging.info('Hello server starting on port %d', port)
try:
    server.serve()
except (KeyboardInterrupt, SystemExit):
    logging.info('Caught signal, stopping threads')
    logging.info('Threads stopped, terminating')
