
# Bu kod ne yapıyor?
# sensör bilgilerini alarak hem databaseye hemde text dosyasına logluyor.
# mariadb kütüphanesini ekliyoruzimport mariadb
import sys
# adafruit kütüphanesinin dht sensörleri için olan alanını ekliyoruz
import Adafruit_DHT
import time
from datetime import datetime




"""---------mariadb bağlantısı----------"""
try:  # mariadb`ye bağlanmaya çalışacak
    conn = mariadb.connect(
        user="root",
        password="123",
        host="192.168.1.109",
        port=3306,
        database="isi_nem_db"

    )
except mariadb.Error as e:
    print(f"MariaDB Platformuna bağlanırken hata oluştu: {e}")
    sys.exit(1)
# cursorumuzu başatıyoruz.
cur = conn.cursor()

    
"""-----------------------"""

# sensörümüzü adafruit içerisinden gösterdik
sensor = Adafruit_DHT.DHT11


# DHT gpio 4. pine bağlıdır.
sensor_pin = 4

# while döngüsünü kontrol etmek için bir değişken oluşturduk
running = True

# yeni .txt dosyası "w" yani write ile oluşturuldu
file = open('sensor_readings.txt', 'w')
file.write('tarih ve zaman, sıcaklık (C),sıcaklık (F), nem\n')

# sonsuz döngü
while running:

    try:
        
        # sıcaklık ve nem değerlerini sensörden oku
        humidity, temperature = Adafruit_DHT.read_retry(sensor, sensor_pin)

        # fahrenayt değerini hesapla
        temperature_f = temperature * 9/5.0 + 32

       
        # bazen bir okuma almayacaksınız ve
        # sonuçlar boş olacak
        # sonraki ifade sadece null olmayan okumaları kabul eder.
        if humidity is not None and temperature is not None:

            # sıcaklığı ve nemi ekranda göster
            print('Sıcaklık = ' + str(temperature) +','+ 'Fahrenayt Sıcaklık = ' + str(temperature_f) +',' + 'Nem = ' + str(humidity))
            # zaman, tarih, sicaklik'i Celsius'ta, sicaklik'i Fahrenheit'te ve nem'i .txt dosyasında kaydedin
            file.write(time.strftime('%H:%M:%S %d/%m/%Y') + ', ' + str(temperature) + ', '+ str(temperature_f)+',' + str(humidity) + '\n')
            """---"""
            date = datetime.now()
            query = "INSERT INTO veriler (isi,nem,tarih,tarih_tam) VALUES (%s, %s, %s, %s)"
            values = (str(temperature),str(humidity), datetime.now(), date, date.strftime("%Y-%m-%d %H:%M:%S"))
            cur.execute(query, values)
             
            conn.commit() 
            print(f"Son Eklenen ID: {cur.lastrowid}")
            """---"""
            time.sleep(5)

        else:
            print('Okuma alınamadı. Tekrar deneyin!')
            time.sleep(1)

    except KeyboardInterrupt:
        print('Program durdu')
        running = False
        file.close()
        conn.close()

