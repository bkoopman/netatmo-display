# gpiozero

    sudo apt-get install python3-gpiozero python-gpiozero

Documentation is available at https://gpiozero.readthedocs.io/

## /etc/rc.local

    # shutdown script listening to GPIO
    python /home/pi/scripts/shutdown.py &

    # update-weather script listening to GPIO
    python /home/pi/scripts/update-weather.py &

## crontab -e

    # generate netatmo display image every 15 minutes between 5am and 2am (next day)
    */15 0-2,5-23 * * * /usr/local/bin/weather-update >/dev/null 2>&1
