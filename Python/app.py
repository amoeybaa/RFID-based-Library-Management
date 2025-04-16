from flask import Flask, render_template
from serial_reader import read_serial_data

app = Flask(__name__)

@app.route('/')
def index():
    serial_data = read_serial_data()
    return render_template('index.html', serial_data=serial_data)

if __name__ == '__main__':
    app.run(debug=True)


'''
from flask import Flask, render_template
import time
import serial

app = Flask(__name__)

def read_serial_data():
    ser = serial.Serial('COM3', 9600, timeout=3)
    data = ser.readline().strip().decode()
    if(data):
        time.sleep(0.5)
        print(data)
        return data
    else:
        time.sleep(0.5)
        print('0')
        return '0'

@app.route('/')
def index():
    while(True):
        serial_data = read_serial_data()
        if(serial_data == '0'):
            return render_template('index.html')
        else:
            return render_template('index.html', serial_data=serial_data)

if __name__ == '__main__':
    app.run(debug=True)
'''