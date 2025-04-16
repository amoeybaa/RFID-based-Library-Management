import serial
import time

def read_serial_data(port='COM3', baudrate=9600, timeout=3):
    try:
        with serial.Serial(port, baudrate, timeout=timeout) as ser:
            data = ser.readline().strip().decode()
            time.sleep(0.5)
            return data if data else '0'
    except serial.SerialException as e:
        print("Serial error:", e)
        return '0'
