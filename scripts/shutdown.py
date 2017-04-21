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
gpio.setup(SW4, gpio.IN, pull_up_down=gpio.PUD_DOWN)

# shutdown function
def Shutdown(channel):
        os.system("sudo shutdown -h now")

# execute function when button pressed
gpio.add_event_detect(SW4, gpio.RISING, callback=Shutdown, bouncetime=300)

# now wait
while 1:
        time.sleep(1)