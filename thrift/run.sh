#!/bin/bash
path='./src/python/hello-server.py'
# make sure full path to executable binary is found
! [ -x $path ] && echo "$path: executable not found" && exit 1
$path
