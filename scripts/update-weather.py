#!/usr/bin/python

# import the modules to send commands to the system and access GPIO pins
import RPi.GPIO as gpio
import time
import os

# PaPiRus HAT buttons
SW1 = 16
SW2 = 26
SW3 = 20
SW4 = 21

# use Broadcom SOC pin numbers
gpio.setmode(gpio.BCM)

# set up button as an input (internal pullups enabled and pin in reading mode)
gpio.setup(SW1, gpio.IN, pull_up_down=gpio.PUD_DOWN)

# shutdown function
def Update(channel):
        os.system("/usr/local/bin/weather-update")

# execute function when button pressed
gpio.add_event_detect(SW1, gpio.RISING, callback=Update, bouncetime=300)

# now wait
while 1:
        time.sleep(1)