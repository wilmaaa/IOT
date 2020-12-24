import serial
from Tkinter import *
import tkMessageBox
import MainBedClose
import MainBedOpen

port = "COM4"
ser = serial.Serial(port,115200)
value = 0

while True:
    value = ser.readline()
    if value == "Main Door Closed":
        exec(open('MainBedClose.py').read()
    elif value == "Main Door Open":
        exec(open('MainBedOpen.py').read()
    time.sleep(1)