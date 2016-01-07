# PacketTracker

This is a simple plugin for the [PocketMine-MP](https://github.com/PocketMine/PocketMine-MP) and [Steadfast2](https://github.com/Hydreon/Steadfast2)
server software for Minecraft: Pocket Edition. It is intended for troubleshooting and/or a deeper understanding of what is 
happening in the lower level networking of pocketmine. Right now it simply records all the data packets that are sent and
received in a 15 minute period and then writes an output file for viewing.  

## Usage

Plop into the plugins directory of your PocketMine-MP server and run your server as normal. When your server shuts down or
after 15 minutes (whichever comes first) there will be a report in the `/plugin/PacketTracker-Log`'s directory. You can run 
from source with [Dev Tools](http://forums.pocketmine.net/plugins/devtools.515/) or package and run from a PHAR.  

## TODO

1. Add notes to all the code 
2. Create a config file and make configurable (recording times, where to write logs, etc.)
3. Order report by packet counts
4. More information in report like how many players were online, etc. 
5. Delete log/reports after a number of days 


## Sample Report Generated: 

```
Packets tracked from 01-05-2016_09:55:15 through 10:10:14

SENT PACKETS
______________
ID               COUNT
SetEntityMotionPacket = 2749732
BatchPacket = 1038130
SetSpawnPositionPacket = 522
PlayStatusPacket = 522
StartGamePacket = 261
SetTimePacket = 5266
SetDifficultyPacket = 261
ContainerSetContentPacket = 6319
PlayerListPacket = 54770
CraftingDataPacket = 261
TextPacket = 182444
MovePlayerPacket = 12877
AdventureSettingsPacket = 502
SetEntityDataPacket = 416834
RespawnPacket = 535
MobEquipmentPacket = 718425
ContainerSetSlotPacket = 14148
MoveEntityPacket = 9742411
LevelEventPacket = 275305
AddEntityPacket = 15261
AddPlayerPacket = 43960
MobArmorEquipmentPacket = 53755
AnimatePacket = 644738
ContainerOpenPacket = 435
TileEventPacket = 19485
DisconnectPacket = 209
RemovePlayerPacket = 36707
ContainerClosePacket = 428
UpdateBlockPacket = 124435
UpdateAttributesPacket = 5460
EntityEventPacket = 55883
AddItemEntityPacket = 93558
RemoveEntityPacket = 105412
TakeItemEntityPacket = 39550
TileEntityDataPacket = 34


RECEIVED PACKETS
______________
ID               COUNT
LoginPacket = 276
MovePlayerPacket = 531261
ContainerSetSlotPacket = 15965
MobEquipmentPacket = 10273
MobArmorEquipmentPacket = 497
PlayerActionPacket = 44703
AnimatePacket = 21752
InteractPacket = 3582
UseItemPacket = 8519
TextPacket = 128
ContainerClosePacket = 434
RemoveBlockPacket = 475
CraftingEventPacket = 105
EntityEventPacket = 236
DropItemPacket = 4

__________________
Sent Packets: 16458835
Received Packets: 638210
TOTAL: 17097045

```
