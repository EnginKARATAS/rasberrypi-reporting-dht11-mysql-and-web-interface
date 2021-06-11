<h3>How to use?</h3>
Equipment Used
Rasberry Pi 3b+
1 Piece DHT11 Heat-Humidity Sensor
power cord
3 Pieces Female-Male Cables
1 resistor (Preferably 4.7k)
1 Piece Board
Small cable to make several connections

<h3>How did do it?</h3>
1. We installed the Rasbian operating system on our Rasberry 3b+
https://www.youtube.com/watch?v=q29tQKh_5p8
<br>
<br>

2. We installed python (since we are on linux, python is compiled with the tonny editor) and then we installed a library (Adafruit) to get the information from DHT11.
https://roboticadiy.com/raspberry-pi-4-data-logger-dht11-dht22-sensor-data-logger/
note: take into account from the title Installing DHT11/ DHT22 Library for Raspberry PI 4: to Code Raspberry Pi 4 Data Logger: in the link.
<br>
<br>

3. We designed our circuit
In the link in step2, we did exactly the diagram in the title Circuit diagram for DHT11/DHT22 to Raspberry Pi 4: It doesn't matter if rasbery is 3 or 4 when building a circuit.
You can find which pin corresponds to where by typing raspberry pi 3b+ pinout on google
<br>
<br>

4.We set up Mysql
Since mysql runs with maria db on rasberry, we set up mariadb.
https://pimylifeup.com/raspberry-pi-mysql/
*We have done the valid operations up to the title of Installing the PHP MySQL Connector in the link above
*We created our database and tables in mysql with t-sql, that is, by typing select * from etc.
![mysql_select](/project_images/mysql_select.png)
<br>
<br>

5.CODE: We inserted the values ​​that came with the Adafruit library from the sensor.
code on github!
![adafruit](/project_images/py.png)

<br>
<br>

6.internal network connection
<br>
<br>

7.external network connection(VPN)
<br>
<br>
8.Php-ChartJS
![adafruit](/project_images/filter.png)
<h3>Datatable</h3>
<br>
<br>
8.1 test
![](/project_images/datatable.png)
<h3>Export as pdf</h3>
<br>
<br>
![adafruit](/project_images/pdf.png)
<h3>Chart With ChartJs</h3>
<br>
<br>
![adafruit](/project_images/chart.png)
<br>
<br>
<h2>Summary</h2>
With the Raspberry Pi and DHT11 Heat-Humidity Sensor, the humidity and temperature information of the environment is logged on the database. In this project, we talk about how to write the humidity and temperature measurement of the environment to the MySQL database using the DHT11 temperature and humidity sensor, Raspberry Pi and Python software language, and how to monitor the data with PHP language.
Hardware materials used; Raspberry Pi, 1 Piece DHT11 Temperature-Humidity Sensor, Power cable, 3 Pieces Female-Male Cable, 1 Piece resistor (Preferably 4.7k), 1 Piece Board, 
Small cable to make a few connections.
<br>
<br>
2. METHODS USED
2.1 PHP
It is a web-based programming language created to develop dynamic websites and web applications. In this project, this programming language is used to connect with the database and display the log records on the user interface.
2.2 CSS
In its simplest form, HTML tags can be visualized in terms of color, size, format, font, etc. enables development. In this project, the ready library bootstrap css and a very small amount of personalized css are used.
<br>
<br>
2.3 BOOTSTRAP
It is a web design tool that includes all the tools necessary to create a website, and allows us to design responsively with a flexible structure using these tools and to adjust the size of smart devices such as phones and tablets. It is used to design the interface we created in our project.
<br>
<br>
2.4 PYTHON
Python is a powerful and dynamic programming language used in many fields. In our project, a library (Adafruit) is used to get the temperature and humidity information from our DHT11 sensor by using the Python programming language.
<br>
<br>
2.5 RASPBERRY PI
Raspberry Pi is a single board computer. The CPU is on the board. It is similar to a traditional motherboard with exposed ports and electronic circuitry consisting of many small switches. It also has all the components needed to connect the inputs and outputs of the devices you want to add. It does not contain an operating system or program. In our project, we complete our circuit by connecting our Raspberry Pi 3b model device to receive data from the DHT11 sensor.
<br>
<br>
2.6 DATATABLES
Datatables is a structure that eliminates many problems of the developer or programmer in terms of data representation. Thanks to this structure, operations such as paging, searching, adding, deleting, exporting (pdf, xls, etc.) The jquery library is used. This structure was preferred while showing the temperature and humidity values ​​in our project.
<br>
<br>
2.7 CHARTJS
ChartJS; It is a javascript library that allows you to prepare visual graphics in Line, Bar, Radar, Pie, Polar, Bubble, Scatter styles. Its ability to work on mobile devices such as phones and tablets and its support by all modern browsers are also the plus sides of the library. Moreover, all graphic indicators are animated and customizable.
<br>
<br>
3. REFERENCES
• https://www.youtube.com/watch?v=q29tQKh_5p8
<br>
• https://roboticadiy.com/raspberry-pi-4-data-logger-dht11-dht22-sensor-data-logger/
<br>
• https://pimylifeup.com/raspberry-pi-mysql/
<br>
• https://www.sanagrafi.com/javascript-chartjs/