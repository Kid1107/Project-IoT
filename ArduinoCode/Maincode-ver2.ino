#include "Include.h"
void setup() 
{
  lcd.init();                //set up LCD
  lcd.backlight();
  lcd.print("SYSTEM IS BOOTING UP");
  lcd.setCursor(0,1);
  lcd.print("...");
  Serial.begin(9600);                       //set baudrate Serial
  Serial1.begin(115200);                    //set baudrate Serial1
  delay(1000);
  Serial1.print("checkin");                 //set 出勤 mode
  
  finger.begin(57600);                      //set baudrate fingerprint sensor
  delay(100);
  pinMode(A0,OUTPUT);                       //Buzzer
  CAU_HINH_MTP();
  delay(500);
  lcd.clear();
  SETUPFINGERPRINTSENSOR();                 //check connect fingerprint sensor
  Updatetime();                             //get realtime from sever
  
}

void loop() 
{

  MP=KEY_4X4();                             //SCAN KEYPAD 
  HIEN_THI_PHIM(MP);                        //Check Keypad output
  Updatetime();                             
  if (SCAN==true)                           //SCAN MODE          
  { 
    lcd.setCursor(0,0);
    lcd.print("ATTENDANCE SYSTEM");
    lcd.setCursor(0,1);
    if(mode==1)
      lcd.print("CHECK-IN");
    else
      lcd.print("CHECK-OUT");
    
    getFingerprintID();                     
    delay(50);            
  }
  else if (ADD==true)                       //ADD MODE
  {
    lcd.setCursor(0,0);
    lcd.print("Add Mode");
    lcd.setCursor(0,1);
    lcd.print("Tap ID: ");
    ID=Transfer_Num();                      //change string to int
    if (ID == 0) 
      return;
    Serial.println(ID);
    while (!  getFingerprintEnroll() );     //while getFingerprintEnroll()==0
    
  }
  else if (CLEAR==true)                     //CLEAR MODE
  {
    lcd.setCursor(0,0);
    lcd.print("Clear Mode");
    lcd.setCursor(0,1);
    lcd.print("Tap ID: ");
    ID=Transfer_Num();
    if (ID == 0) 
      return;
    deleteFingerprint(ID);                  //Delete id
    Serial.println(ID);
  }

}
