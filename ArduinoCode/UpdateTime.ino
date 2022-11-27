void Updatetime()
{
  while (Serial1.available() > 0) 
  {
    TIME = Serial1.readString();                    //Get time from ESP8266
    delay(50);
    for(int i = 0;i<TIME.length();i++)
    {
       if(TIME.charAt(i) == 'T')
           moc = i;
    }
       TIME_SPLIT1=TIME;                            //split string 
       TIME_SPLIT2=TIME;
       TIME_SPLIT1.remove(moc);
       TIME_SPLIT2.remove(0,moc+1);
  }
  if(SCAN==true)
  {
    lcd.setCursor(0,3);
    lcd.print(TIME_SPLIT1);                         //print date
    lcd.setCursor(15,3);
    lcd.print(TIME_SPLIT2);                         //print time
  }
  
}
