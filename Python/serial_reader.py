import serial
import time

'''
In case of Linux:

ser = serial.Serial(
	port='/dev/ttyUSB0',
	baudrate=9600,
	parity=serial.PARITY_NONE,
	stopbits=serial.STOPBITS_ONE,
	bytesize=serial.EIGHTBITS,
	timeout=1)
'''

def read_serial_data(port='COM3', baudrate=9600, timeout=3):
    try:
        with serial.Serial(port, baudrate, timeout=timeout) as ser:
            data = ser.readline().strip().decode()
            time.sleep(0.5)
            return data if data else '0'
    except serial.SerialException as e:
        print("Serial error:", e)
        return '0'
