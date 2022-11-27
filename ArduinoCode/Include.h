#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27,20,4);  // set the LCD address to 0x27 for a 16 chars and 2 line display

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial2);       

const int hang0 = 9;
const int hang1 = 8;
const int hang2 = 7;
const int hang3 = 6;

const int cot0 = 13;
const int cot1 = 12;
const int cot2 = 11;
const int cot3 = 10;

boolean SCAN=1,ADD=0,CLEAR=0;
boolean ADMIN=false;
boolean mode=1;
uint16_t MP;
uint16_t ID;
uint8_t tr=0,ch=0,dv=0;
String TIME,TIME_SPLIT1,TIME_SPLIT2;
int moc;


uint8_t LCD_Location;
uint8_t Array_Location;
String USER[3]={" "," "," "};
