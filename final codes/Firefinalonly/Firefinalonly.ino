#include <ESP8266WiFi.h>
#include "DHT.h"
#define BUZZERPIN D5
#define DHTPIN D1
#define DHTTYPE DHT11 
int firepin = D2;
 
const char* ssid     = "Vivo";
const char* password = "YALINA_ANSARI";
const char* host = "inenoptimize7.000webhostapp.com";
DHT dht(DHTPIN, DHTTYPE);

void setup() 
{
  Serial.begin(115200);
  delay(100);
  dht.begin();
  pinMode(firepin,INPUT);
   pinMode(BUZZERPIN,OUTPUT);
  
  
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
  int firevalue = digitalRead(firepin);
  int Device_id;
 
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }
  
  String url = "/API/Insert_Fire.php?FS_value="+String(firevalue)+"&Device_id=1";
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  delay(500);
  
  while(client.available())
  {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

// SMS
    if(firevalue==0){
        digitalWrite(BUZZERPIN, HIGH);
        
    WiFiClient client16;
  
    if (!client16.connect(host, httpPort)) {
      Serial.println("connection failed");
      return;
    }

    String firesmsurl ="https://inenoptimize7.000webhostapp.com/API/firesms.php";
    Serial.print("SMS URL:");
    Serial.println(firesmsurl);

  
  
  client16.print(String("GET ") + firesmsurl + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(5000);
  
  while(client16.available()){
    String line16 = client16.readStringUntil('\r');
    Serial.print(line16);
  }
}
  
  Serial.println();
  Serial.println("closing connection");
  delay(3000);
}