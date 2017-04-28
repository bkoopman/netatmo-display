#!/usr/bin/env python

import os
import sys
import argparse
from papirus import Papirus
from PIL import Image

# command line usage
# draw-image "filepath"

cfile = "/tmp/draw-image.counter"

def main():
	papirus = Papirus()
	p = argparse.ArgumentParser()
	p.add_argument('filepath', type=str)
	args = p.parse_args()
	if args.filepath:
		draw_image(papirus, args.filepath)
		
def draw_image(papirus, filepath):
	# assuming image size is correct for screen
	image = Image.open(filepath)
	papirus.display(image)
	
	# load counter from file
	try:
		file = open(cfile, 'r')
		counter = int(file.read())
		# open file for write
		file = open(cfile, 'w')
	except IOError:
		# create new file writeble for everybody
		file = open(cfile, 'w')
		os.chmod(cfile, 0o666)
		counter = 0
		
	# update counter
	counter += 1
	
	if counter >= 5:
		# perform a full update to the screen (slower)
		print("Drawing on PaPiRus...")
		papirus.update()
		counter = 0
	else:
		# update only the changed pixels (faster)
		print("Drawing partial update on PaPiRus...")
		papirus.partial_update()

	# update counter file
	file.write(str(counter))
	file.close()

if __name__ == '__main__':
	main()