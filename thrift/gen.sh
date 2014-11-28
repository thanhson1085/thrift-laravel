#!/bin/bash

thrift --gen py -out src/python hello.thrift
thrift --gen php -out src/php hello.thrift
thrift --gen py -out src/python exceptions.thrift
thrift --gen php -out src/php exceptions.thrift
