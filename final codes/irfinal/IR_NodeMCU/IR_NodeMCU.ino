#include <ESP8266WiFi.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11 
int irpin = D0;

const char* ssid     = "Vivo";
const char* password = "YALINA_ANSARI";
const char* host = "inenoptimize7.000webhostapp.com";
DHT dht(DHTPIN, DHTTYPE);

void setup() 
{
  Serial.begin(115200);
  delay(100);
  dht.begin();
  pinMode(irpin,INPUT);
 
  
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
  int irvalue = digitalRead(irpin);
  int Device_id ;
 
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }
   while(client.available())
  {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }


  // IR 
  
   String url = "/API/Insert_IR.php?IR_value="+String(irvalue)+"&Device_id=1";
 // String url = "/API/Insert_IR.php?IR_value="+String(irvalue);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  delay(500);
  
 
  
  Serial.println();
  Serial.println("closing connection");
  delay(3000);
}
