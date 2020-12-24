from machine import Pin
import BoilerOpen
import BoilerClose
from time import sleep

  
 p5 = Pin(5, Pin.IN)
 p4 = Pin(4, Pin,OUT)
 p0 = Pin(0, Pin,OUT)
 
 while True:
   va1 = p5.value()
   time.sleep(1)
   val2 = p5.value()
   if val1 and not val2:
     print ('Door Closed')
     p4.off()
     p0.on()
     exec(open('BoilerClose.py').read()
   elif not val1 and val2:
     print ('Door Open')
     p0.off()
     p4.on()
     exec(open('BoilerOpen.py').read()
 
 
