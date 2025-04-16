from flask import Flask, render_template
from serial_reader import read_serial_data

app = Flask(__name__)

@app.route('/')
def index():
    serial_data = read_serial_data()
    return render_template('index.html', serial_data=serial_data)

if __name__ == '__main__':
    app.run(debug=True)
