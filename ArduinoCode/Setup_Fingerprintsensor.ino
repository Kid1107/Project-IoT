void SETUPFINGERPRINTSENSOR()
{
  if (finger.verifyPassword()) 
  {
      lcd.clear();
      lcd.print("SYSTEM IS READY");
      delay(1000);
      //lcd.clear();
  }
  else 
  {
      while (!finger.verifyPassword()) 
      {
        lcd.clear();
        lcd.print("ERROR !!!");
        lcd.setCursor(0,1);
        lcd.print("CANNOT CONNECT TO");
        lcd.setCursor(0,2);
        lcd.print("SENSOR");
      }
  }
  finger.getParameters();
}
