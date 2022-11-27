void CAU_HINH_MTP()
{
  pinMode(hang0,INPUT_PULLUP);
  pinMode(hang1,INPUT_PULLUP);
  pinMode(hang2,INPUT_PULLUP);
  pinMode(hang3,INPUT_PULLUP);
  
  pinMode(cot0,OUTPUT);
  pinMode(cot1,OUTPUT);
  pinMode(cot2,OUTPUT);
  pinMode(cot3,OUTPUT);
  
  digitalWrite(cot0,HIGH);
  digitalWrite(cot1,HIGH);
  digitalWrite(cot2,HIGH);
  digitalWrite(cot3,HIGH);

}
unsigned int QUET_MT_PHIM()                       //SCAN KEYPAD
{
  digitalWrite(cot0,LOW);
  digitalWrite(cot1,HIGH);
  digitalWrite(cot2,HIGH);
  digitalWrite(cot3,HIGH);
  if(digitalRead(hang0)==0)
    return 1;
  else if (digitalRead(hang1)==0)
    return 4;
  else if (digitalRead(hang2)==0)
    return 7;
  else if (digitalRead(hang3)==0)
    return 42;

    
    
  digitalWrite(cot0,HIGH);
  digitalWrite(cot1,LOW);
  digitalWrite(cot2,HIGH);
  digitalWrite(cot3,HIGH);
  if(digitalRead(hang0)==0)
    return 2;
  else if (digitalRead(hang1)==0)
    return 5;
  else if (digitalRead(hang2)==0)
    return 8;
  else if (digitalRead(hang3)==0)
    return 0;

    
  digitalWrite(cot0,HIGH);
  digitalWrite(cot1,HIGH);
  digitalWrite(cot2,LOW);
  digitalWrite(cot3,HIGH);
  if(digitalRead(hang0)==0)
    return 3;
  else if (digitalRead(hang1)==0)
    return 6;
  else if (digitalRead(hang2)==0)
    return 9;
  else if (digitalRead(hang3)==0)
    return 35;

    
  digitalWrite(cot0,HIGH);
  digitalWrite(cot1,HIGH);
  digitalWrite(cot2,HIGH);
  digitalWrite(cot3,LOW);
  if(digitalRead(hang0)==0)
    return 65;
  else if (digitalRead(hang1)==0)
    return 66;
  else if (digitalRead(hang2)==0)
    return 67;
  else if (digitalRead(hang3)==0)
    return 68;
  return 69;
}

unsigned int KEY_4X4()                            
{
  unsigned  int MPT1,MPT2;
    MPT1=QUET_MT_PHIM();
    if(MPT1!=69)
    {
      delay(10);
      MPT1=QUET_MT_PHIM();
      do
      {
        MPT2=QUET_MT_PHIM();
      }
      while(MPT2==MPT1);
      
    }
    return(MPT1);
}
uint16_t Transfer_Num(void)                         //Chuyen doi du lieu tu ban phim sang so nguyen
{
    uint16_t num = 0;
    tr=USER[0].toInt();
    ch=USER[1].toInt();
    dv=USER[2].toInt();
    if(MP==35)                          
    {
        if(USER[2]== " ")
        {
          if(USER[1]== " ")
              num=tr;
          else
          {
              num=(tr*10)+ch;
              delay(10);
          }
        }
        else
        {
          num= (tr*100)+(ch*10)+dv;
          delay(10);
          if(num>1000)
          {
            lcd.setCursor(0,2);
            lcd.print("Fail! Exceed valid");
            lcd.setCursor(0,3);
            lcd.print("range");
            return 0;
          }
        }
    }
  return num;
}
void HIEN_THI_PHIM(uint8_t MP)
{
  if(MP!=69)
  {
    if(MP==65)
    {
      lcd.clear();
      SCAN=true;
      ADD=false;
      CLEAR=false;
      ADMIN=false;
    }
    else if((MP==66)&&(ADMIN==true))
    {
      lcd.clear();
      SCAN=false;
      ADD=true;
      CLEAR=false;
      LCD_Location=8;                                  //SET lai vi tri nhap du lieu LCD
      Array_Location=0;                                //reset array
      for(int z=0;z<3;z++)
      {
        USER[z]=" ";
      }
    }
    else if((MP==67)&&(ADMIN==true))
    {
      
      lcd.clear();
      SCAN=false;
      ADD=false;
      CLEAR=true;
      LCD_Location=8;                                  //SET lai vi tri nhap du lieu LCD
      Array_Location=0;                                //reset array
      for(int z=0;z<3;z++)
      {
        USER[z]=" ";
      }
    }
    else if(MP==68)                                     //Change mode 出勤、退勤
    {
      lcd.clear();
      mode=!mode;
      if(mode==0)
        Serial1.print("checkout");
      else
        Serial1.print("checkin");
      
    }
    else if(MP==42)                                           //Xoa ID da nhap 
    {
       if (LCD_Location>8)
       {
          LCD_Location--;
          Array_Location--;
          USER[Array_Location]= " ";
          lcd.setCursor(LCD_Location,1);
          lcd.print(" ");
       }
     }
     
    else                                                      
    {
      if((LCD_Location<=10)&&(SCAN==false)&&(MP!=35) )       //Gioi han 3 chu so  //Nhap du lieu tu ban phim o che do ADD va CLEAR
      {
        USER[Array_Location]=MP;
        lcd.setCursor(LCD_Location,1);
        lcd.print(MP);
        LCD_Location++;
        Array_Location++;
        
      }
    }
    
   }
}
