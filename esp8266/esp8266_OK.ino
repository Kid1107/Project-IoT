#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include "NTPClient.h"
#include "WiFiUdp.h"

const char* ssid     = "aterm-a957d3-g";
const char* password = "92a0353b2ac55";
const char* host = "192.168.10.102";
String id;
String tam;


const long utcOffsetInSeconds = 32400;
String minutes;
String flag="";
// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);


void setup() 
{
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  delay(10);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
  timeClient.begin();
//  Serial.println("");
//  Serial.println("WiFi connected");  
//  Serial.println("IP address: ");
//  Serial.println(WiFi.localIP());
}
void loop() 
{
  WiFiClient client;

  if (!client.connect(host, 80)) 
  {
    Serial.println("connection failed");
    return;
  }
  if (Serial.available() > 0) 
  {
    while (Serial.available() > 0) 
    {
      id = Serial.readString(); 
    }    
  }

  
  if((id!=tam)&&(id!="checkout")&&(id!="checkin"))
  {
    tam=id;
    String url= "/ALPS_N1/nhanvien.php/";
              url += "?id=";
              url += id;
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  }
  else if(id=="checkout")
  {
    tam="";
    String url= "/ALPS_N1/receivedmode.php/";
              url += "?md=";
              url += 0;
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  }
  else if(id=="checkin")
  {
    tam="";
    String url= "/ALPS_N1/receivedmode.php/";
              url += "?md=";
              url += 1;
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  }
  timeClient.update();
  minutes=timeClient.getMinutes();
  if(minutes!=flag)
  {
    flag=minutes;
    Serial.println(timeClient.getFormattedDate());
  }
//  unsigned long timeout = millis();
//  while (client.available() == 0) 
//  {
//    if (millis() - timeout > 5000)
//    {
//      Serial.println(">>> Client Timeout !");
//      client.stop();
//      return;
//    }
//  }
}
