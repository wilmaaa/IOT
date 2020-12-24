#include "painlessMesh.h"
#include <Arduino_JSON.h>
#include <ESP8266WiFi.h>

// MESH Details
#define MESH_PREFIX "PlsWork"      //name for your MESH
#define MESH_PASSWORD "PLeaseWork" //password for your MESH
#define MESH_PORT 5555             //default port


WiFiClient client;

int ledOpen = 5;
int ledClose = 4;
int switchReed = 0;

void setup()
{
  pinMode(ledOpen, OUTPUT);
  pinMode(ledClose, OUTPUT);
  pinMode(switchReed, INPUT);
  Serial.begin(9600);
  delay(10);

  Serial.println("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
}

int nodeNumber = 1;

//String to send to other nodes with sensor readings
String readings;

Scheduler userScheduler; // to control your personal task
painlessMesh mesh;

// User stub
void sendMessage();
String getReadings();

//Create tasks: to send messages and get readings;
Task taskSendMessage(TASK_SECOND * 5, TASK_FOREVER, &sendMessage);



void sendMessage()
{
  if (digitalRead(switchReed)==HIGH){
    digitalWrite(ledOpen, LOW);
    digitalWrite(ledClose, HIGH);
    Serial.println("Main Door Closed");
    String msg = ("Main Door Closed");
  else {
    digitalWrite(ledOpen, HIGH);
    digitalWrite(ledClose, LOW);
    Serial.println("Your Door is Open");
    String msg = ("Main Door Open");
  }

  {
    /* code */
  }
  
  mesh.sendBroadcast(msg);
}



// Needed for painless library
void receivedCallback(uint32_t from, String &msg)
{
  Serial.printf("Received from %u msg=%s\n", from, msg.c_str());
  JSONVar myObject = JSON.parse(msg.c_str());
  
}

void newConnectionCallback(uint32_t nodeId)
{
  Serial.printf("New Connection, nodeId = %u\n", nodeId);
}

void changedConnectionCallback()
{
  Serial.printf("Changed connections\n");
}

void nodeTimeAdjustedCallback(int32_t offset)
{
  Serial.printf("Adjusted time %u. Offset = %d\n", mesh.getNodeTime(), offset);
}

v