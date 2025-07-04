#include <ESP8266WiFi.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11 
#define trigPin D5
#define echoPin D6

 
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

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }

  // Ultrasonic
  
  String url = "/API/Insert_Ultrasonic.php?Ult_value="+String(inches)+"&Device_id=1";

  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  delay(500);
  
  while(client.available())
  {
    String line = client.readStringUntil('\r');
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
