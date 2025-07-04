#include <ESP8266WiFi.h>
#define BUZZERPIN D0

 
const char* ssid     = "Vivo";
const char* password = "YALINA_ANSARI";
const char* host = "inenoptimize7.000webhostapp.com";

void setup() 
{
  Serial.begin(115200);
  delay(100);
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

        tone(BUZZERPIN,5000);
        delay(1000);
        noTone(BUZZERPIN);
        delay(1000);
        
    WiFiClient client16;

  
}