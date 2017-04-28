#!/usr/bin/env python

from gpiozero import Button
from subprocess import check_call
from signal import pause

# shutdown function
def shutdown():
	check_call(["/home/pi/scripts/splash.py"])
	check_call(["sudo", "poweroff"])

# PaPiRus HAT buttons (GPIO numbers)
SW1 = 16
SW2 = 26
SW3 = 20
SW4 = 21

# PaPiRus HAT buttons are connected to 3V3, so pullup false
# execute after holding the button for 1 second
shutdown_btn = Button(SW4, pull_up=False, hold_time=1)
shutdown_btn.when_held = shutdown

# wait for signal
pause()