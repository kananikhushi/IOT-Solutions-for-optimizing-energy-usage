#include <ESP8266WiFi.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11 

int pirpin = D7;
 
const char* ssid     = "realme 8";
const char* password = "Virus@hacker1";
const char* host = "inenoptimize7.000webhostapp.com";
DHT dht(DHTPIN, DHTTYPE);

void setup() 
{
  Serial.begin(115200);
  delay(100);
  dht.begin();

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
  
  int pirvalue = digitalRead(pirpin);
  int Device_id;

 
  Serial.print("connecting to ");
  Serial.println(host);

  // PIR Sensor start
  WiFiClient client1;
  const int httpPort = 80;
  if (!client1.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }
  String url1 = "/API/Insert_PIR.php?PIR_value="+String(pirvalue)+"&Device_id=1";
  Serial.print("Requesting URL: ");
  Serial.println(url1);
  
  client1.print(String("GET ") + url1 + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  delay(500);
  
  while(client1.available())
  {
    String line = client1.readStringUntil('\r');
    Serial.print(line);
  }
  // PIR sensor End 

  
  Serial.println();
  Serial.println("closing connection");
  delay(3000);
}
