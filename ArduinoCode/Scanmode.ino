
uint16_t getFingerprintID() {
  uint16_t p = finger.fingerSearch();
  if (p == FINGERPRINT_OK) 
  {
    Serial.println("Found a print match!");
    digitalWrite(A0,HIGH);
    delay(300);
    digitalWrite(A0,LOW);
    if(finger.fingerID==0)
      ADMIN=true;
    else
    {
      Serial1.print(finger.fingerID); 
      Serial.print(finger.fingerID);
    }    
    
    lcd.clear();
    lcd.print("FOUND ID #"); 
    lcd.setCursor(10,0);
    lcd.print(finger.fingerID); 
    
    delay(1000);
    lcd.clear();
  } 
  else if (p == FINGERPRINT_NOTFOUND) 
  {
    Serial.println("Did not find a match");
    
    digitalWrite(A0,HIGH);
    delay(100);
    digitalWrite(A0,LOW);
    delay(50);
    digitalWrite(A0,HIGH);
    delay(100);
    digitalWrite(A0,LOW);
    lcd.clear();
    lcd.print("DATA NOT FOUND !!");
    delay(1000);
    lcd.clear();
    return p;
  } 
  else 
  {
    Serial.println("Unknown error");
    return p;
  }
  
  return finger.fingerID;
}
