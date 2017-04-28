#!/usr/bin/env python

from subprocess import check_call

# clear screen 
check_call(["/usr/local/bin/papirus-clear"])

# load splash screen
check_call(["/home/pi/scripts/draw-image.py", "/var/www/html/splash.bmp"])