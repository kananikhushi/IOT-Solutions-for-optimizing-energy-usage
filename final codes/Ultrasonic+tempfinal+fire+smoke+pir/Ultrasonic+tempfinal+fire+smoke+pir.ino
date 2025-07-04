#include <ESP8266WiFi.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11 
#define trigPin D5
#define echoPin D6
#define firepin D2
int smokepin = D3; 
int pirpin = D7;

 
const char* ssid     = "realme 8";
const char* password = "Virus@hacker1";
const char* host = "inenoptimize7.000webhostapp.com";
DHT dht(DHTPIN, DHTTYPE);

void setup() 
{
  Serial.begin(115200);
  delay(100);
    pinMode(trigPin, OUTPUT);
    pinMode(echoPin, INPUT);
    dht.begin();
    pinMode(firepin,INPUT);
    pinMode(smokepin,INPUT);
    pinMode(pirpin,INPUT);
  
    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);
    
    WiFi.begin(ssid, password); 
    while (WiFi.status() != WL_CONNECTED) 
    {
      delay(500);
      Serial.print(".");
    }
 
    Serial.println("");
    Serial.println("WiFi connected");  
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
    Serial.print("Netmask: ");
    Serial.println(WiFi.subnetMask());
    Serial.print("Gateway: ");
    Serial.println(WiFi.gatewayIP());
}

void loop() 
{  
    int Device_id;
    //pir
    int pirvalue = digitalRead(pirpin);  
    //smoke
    int smokevalue = digitalRead(smokepin);
    //fire
    int firevalue = digitalRead(firepin);


 
    float h = dht.readHumidity();
    // Read temperature as Celsius (the default)
    float t = dht.readTemperature();
  
   long duration, inches, cm;
    digitalWrite(trigPin, LOW);
    delayMicroseconds(2);
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(5);
    digitalWrite(trigPin, LOW);

    //TAKE READING ON ECHO PIN 
    duration = pulseIn(echoPin, HIGH);

    //convert the time into a distace 
    inches = microsecondsToInches(duration);  
    cm = microsecondsToCentimeters(duration);
    Serial.println(inches);
    Serial.print("in, ");
    Serial.println(cm);
    Serial.print("cm");
 
    Serial.print("connecting to ");
    Serial.println(host);

    //fire
    WiFiClient client1;
    const int httpPort = 80;
    if (!client1.connect(host, httpPort)) 
    {
      Serial.println("connection failed");
      return;
    }

    String url1 = "/API/Insert_Fire.php?FS_value="+String(firevalue)+"&Device_id=1";
    Serial.print("Requesting URL: ");
    Serial.println(url1);
    
    client1.print(String("GET ") + url1 + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
    if(firevalue==0)
    {
      Serial.println("FIRE sensor detected");
      // SMS
      if(firevalue==0)
      // {
      //     digitalWrite(BUZZERPIN, HIGH);
      // } 
      WiFiClient client16;
    
      if (!client1.connect(host, httpPort)) 
      {
        Serial.println("connection failed");
        return;
      }

      String firesmsurl ="https://inenoptimize7.000webhostapp.com/API/firesms.php";
      Serial.print("SMS URL:");
      Serial.println(firesmsurl);
      delay(5000);
  
      while(client1.available())
      {
      String line16 = client1.readStringUntil('\r');
      Serial.print(line16);
      }
    }
    else
    {
      Serial.println("FIRE not detected");
    }
    delay(500);

    // Ultrasonic
    WiFiClient client2;
    // const int httpPort = 80;
    if (!client2.connect(host, httpPort)) 
    {
      Serial.println("connection failed");
      return;
    }
    
    String url2 = "/API/Insert_Ultrasonic.php?Ult_value="+String(inches)+"&Device_id="+String(Device_id);

    Serial.print("Requesting URL: ");
    Serial.println(url2);
    
    client2.print(String("GET ") + url2 + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
    if(inches>350)
    {
      Serial.println("Alert there is some Component detected");
    }
    delay(500);

    while(client2.available())
    {
      String line = client2.readStringUntil('\r');
      Serial.print(line);
    }


    // add temp data


    WiFiClient client3;
    
    if (!client3.connect(host, httpPort)) 
    {
      Serial.println("connection failed");
      return;
    }
    String url3 = "/API/Insert_Temperature.php?Temprature=" + String(t) + "&Humidity="+ String(h);
    Serial.print("Requesting URL: ");
    Serial.println(url3);
    
    client3.print(String("GET ") + url3 + " HTTP/1.1\r\n" +
                "Host: " + host + "\r\n" + 
                "Connection: close\r\n\r\n");
    if(t>27)
    {
      Serial.println("Warm Weather");
    }
    else
    {
      Serial.println("Cold Weather");
    }
    delay(500);
    
    while(client3.available())
    {
      String line = client3.readStringUntil('\r');
      Serial.print(line);
    } 

    WiFiClient client4;
    //const int httpPort = 80;
    if (!client4.connect(host, httpPort)) 
    {
      Serial.println("connection failed");
      return;
    }

    // Ultrasonic
    
    String url4 = "/API/Insert_Smoke.php?Smoke_value="+String(smokevalue)+"&Device_id=1";
    Serial.print("Requesting URL: ");
    Serial.println(url4);
    
    client4.print(String("GET ") + url4 + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
    if(smokevalue==0)
    {
      Serial.println("Smoke Detected");
    }
    else
    {
      Serial.println("No Smoke");
    }
    delay(500);
    
    while(client4.available())
    {
      String line = client4.readStringUntil('\r');
      Serial.print(line);
    }
    WiFiClient client5;
    if (!client5.connect(host, httpPort)) 
    {
      Serial.println("connection failed");
      return;
    }
    String url5 = "/API/Insert_PIR.php?PIR_value="+String(pirvalue)+"&Device_id=1";
    Serial.print("Requesting URL: ");
    Serial.println(url5);
    
    client5.print(String("GET ") + url5 + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
    if(pirvalue==0)
    {
      Serial.println("Motion detected");
    }
    else
    {
      Serial.println("No Motion Detected");
    }
    delay(500);
    
    while(client5.available())
    {
      String line = client5.readStringUntil('\r');
      Serial.print(line);
    }
    Serial.println();
    Serial.println("closing connection");
    delay(3000);
}
    long microsecondsToInches(long microseconds)
    {
      return microseconds/74/2;
    }

    long microsecondsToCentimeters(long microseconds)
    {
      return microseconds/29/2;
    }

