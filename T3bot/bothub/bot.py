#!/usr/bin/python3.4
# -*- coding: utf-8 -*-

from __future__ import (absolute_import, division, print_function, unicode_literals)

from bothub_client.bot import BaseBot
from bothub_client.decorators import channel
from bothub_client.messages import Message
import re
from bothub.database.db import *

class Bot(BaseBot):
    @channel()
    def handle_message(self, event, conbotext):
        message = event.get('content')
        self.send_message('Echo: {}'.format(event['content']))
        if message == '/start':
            msg = Message(event).set_text('T3 아이디를 입력해주세요.')
      #      for item in menu:
      #          msg.add_keyboard_button(item)
            self.send_message(msg)

        elif re.compile('[a-zA-Z]+').match(message):
            compare_user(message)
            self.send_message("sdaf")

