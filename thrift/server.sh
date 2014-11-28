#!/bin/bash
SCREEN_NAME=hello_thrift
path='./src/python/hello-server.py'
# make sure full path to executable binary is found
! [ -x $path ] && echo "$path: executable not found" && exit 1

case "${1:-''}" in
    'start')
        if screen -list | grep -q "$SCREEN_NAME"; then
            screen -S $SCREEN_NAME -X quit
        fi
        screen -m -d -S $SCREEN_NAME $path
        echo "OK"
        ;;

    'stop')
        if screen -list | grep -q "$SCREEN_NAME"; then
            screen -S $SCREEN_NAME -X quit
            echo "OK"
        fi
        ;;
    *)
        if screen -list | grep -q "$SCREEN_NAME"; then
            screen -S $SCREEN_NAME -X quit
        fi
        screen -m -d -S $SCREEN_NAME $path
        echo "OK"
        ;;
esac
