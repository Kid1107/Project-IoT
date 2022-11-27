uint16_t deleteFingerprint(uint16_t id) {
  uint16_t p = -1;
  
  p = finger.deleteModel(id);

  if (p == FINGERPRINT_OK) 
  {
    Serial.println("Deleted!");
    LCD_Location=8;
    Array_Location=0;
    lcd.setCursor(0,3);
    lcd.print("Deleted!      ");
    lcd.setCursor(10,3);
    lcd.print(id);
    delay(1000);
    for(int z=0;z<3;z++)
    {
      USER[z]=" ";
      delay(20);
    }
    lcd.clear();
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not delete in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.print("Unknown error: 0x"); Serial.println(p, HEX);
    return p;
  }   
    
    
}
