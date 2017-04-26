#!/usr/bin/env python

from gpiozero import Button
from subprocess import check_call
from signal import pause

# weather-update function
def weather_update():
	check_call(["/usr/local/bin/weather-update"])

# PaPiRus HAT buttons (GPIO numbers)
SW1 = 16
SW2 = 26
SW3 = 20
SW4 = 21

# PaPiRus HAT buttons are connected to 3V3, so pullup false
button = Button(SW1, pull_up=False)
button.when_pressed = weather_update

# wait for signal
pause()