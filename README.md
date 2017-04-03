# netatmo-display

Display for my Netatmo weather station, using Raspberry Pi Zero W

## Display options

- [Adafruit PiTFT 2.2" HAT 320x240](https://www.kiwi-electronics.nl/raspberry-pi/raspberry-pi-expansion-boards/raspberry-pi-displays/adafruit-pitft-2-2-inch-hat-zonder-touch)
- [PaPiRus ePaper HAT 2.7" 264x176](https://www.pi-supply.com/product/papirus-epaper-eink-screen-hat-for-raspberry-pi/)
- [Embedded Artists 2.7" ePaper display 264x176](https://www.embeddedartists.com/products/displays/lcd_27_epaper.php)
- [Conrad EA-LCD-009 264x176](https://www.conrad.nl/nl/embedded-artists-ea-lcd-009-developmentboard-1027644.html)
- [SOS Solutions PaPiRrus HAT 2,7" 264x176](https://www.sossolutions.nl/pi-supply-paprrus-hat-large-2-7)

## Screenshots using X virtual framebuffer and CutyCapt

- Black and white bitmap: `xvfb-run --server-args="-screen 0, 640x480x8" cutycapt --min-width=264 --min-height=176 --url=http://koopman.xs4all.nl/netatmo/?bw --out=/var/www/netatmo/image.bmp`

- Color: `xvfb-run --server-args="-screen 0, 640x480x16" cutycapt --min-width=320 --min-height=240 --url=http://koopman.xs4all.nl/netatmo/ --out=/var/www/netatmo/image.png`
