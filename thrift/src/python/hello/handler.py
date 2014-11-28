import logging

from exceptions.ttypes import EUnknown

class HelloHandler:
    '''
    Implements thrift server logic.
    '''

    def __init__(self):
        logging.info('Initializing handler')

    def __del__(self):
        logging.info('Disposing handler')


    # -------------------------------------------------------------------------
    # -------------- Thrift - HelloService Implementation -------------
    # -------------------------------------------------------------------------

    def hello(self, name):
        logging.info('Run hello request')
        return 'Hello ' + name
