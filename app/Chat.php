<?php
namespace App;

use App\Models\Kullaniciler\User;
use App\Models\rooms;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Mesajlar\Message;

class Chat implements MessageComponentInterface
 {
     protected $clients;
     protected $subscriptions;
     public function __construct()
     {
         $this->clients = new \SplObjectStorage();
         $this->subscriptions = [];
     }
     public function onOpen(ConnectionInterface $conn)
     {
         $this->clients->attach($conn);
     }
     public function onMessage(ConnectionInterface $from, $msg)
     {
         $message = json_decode($msg, true);
         echo($msg);
         try {
             if ($message['type'] === "connection") {
                 $user_id = $message['user_id'];
                 $receiver_id = $message['receiver_id'];
                 // Her iki kullanıcıyı da aynı odaya ekleyin
                 $websocketClient = DB::table('websocket_room_ids')
                     ->where('user_id', $message['user_id']) 
                     ->where('client_id', $message['receiver_id'])
                     ->where('ilan_id', $message['ilan_id'])
                     ->first();
                 $websocketClient2 = DB::table('websocket_room_ids')
                     ->where('user_id',  $message['receiver_id']) 
                     ->where('client_id',$message['user_id']) 
                     ->where('ilan_id', $message['ilan_id'])
                     ->first();
                
                if ($websocketClient === null && $websocketClient2 === null) {
                        $room_id = $this->generateRoomId();
                        $this->joinRoom($room_id, $from);

                        echo("Room id nullable: {$room_id}");
                        $newRoom = DB::table('websocket_room_ids')->insert([
                            'user_id' => $message['user_id'],
                            'client_id' => $message['receiver_id'],
                            'ilan_id' => $message['ilan_id'],
                            'room_id' => $room_id,
                            'isMessage'=>false,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $this->sendRoomId($from, $room_id);
                } else {
                    if ($websocketClient !== null && isset($websocketClient->room_id)) {
                            echo("\nRoom not nullable: {$websocketClient->room_id} \n");
                            $this->joinRoom($websocketClient->room_id, $from);
                            $this->sendRoomId($from, $websocketClient->room_id);
                        } else if ($websocketClient2 !== null && isset($websocketClient2->room_id)) {
                            echo("\nRoom not nullable : {$websocketClient2->room_id}\n");
                            $this->joinRoom($websocketClient2->room_id, $from);
                            $this->sendRoomId($from, $websocketClient2->room_id);
                        }
                    }
                
             }
         } catch (\Exception $e) {
             echo "\nMesaj kaydedilirken bir hata oluştu: " . $e->getMessage();
         }
         if ($message['type'] === 'start_private_chat') {
             try {
                 echo("try Başlangıcı \n");

                  DB::table('websocket_room_ids')
                  ->where('ilan_id' , $message['ilan_id']) 
                  ->where('user_id' , $message['user_id'])
                  ->orWhere('client_id',$message['user_id'])
                  ->where('client_id' , $message['receiver_id'])
                  ->orWhere('user_id',$message['receiver_id'])
                  ->update([
                     'isMessage'=> true , 
                      'updated_at' => now(),
                  ]); 
                  $user_id = $message['user_id'];
                   $odalar = DB::table('websocket_room_ids')
                   ->where(function ($query) use ($user_id) {
                       $query->where('user_id', $user_id)
                             ->orWhere('client_id', $user_id);
                   })
                   ->get();

                 $newMessage = Message::create([
                     'user_id' => $message['user_id'],
                     'room_id' => $message['room_id'],
                     'receiver_id' => $message['receiver_id'],
                     'content' => $message['content'],
                 ]);
                 echo "Mesaj başarıyla kaydedildi.";
                 $this->sendMessageToRoom($from, $message);
             } catch (\Exception $e) {
                 echo "Mesaj kaydedilirken bir hata oluştu: " . $e->getMessage();
             }
         }
     }
     public function onClose(ConnectionInterface $conn)
     {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
     }
     public function onError(ConnectionInterface $conn, \Exception $e)
     {
         // Hata işleme kodları
     }
     protected function generateRoomId()
     {
        $randomInteger = rand(1, 1000);
        return $randomInteger;
     }
     protected function joinRoom($room_id, ConnectionInterface $conn)
     {
        $this->subscriptions[$room_id][] = $conn;
     }
     protected function sendRoomId(ConnectionInterface $conn, $room_id)
     {
         $conn->send(json_encode(['type' => 'room_id', 'room_id' => $room_id]));
     }
     protected function sendMessageToRoom(ConnectionInterface $from, $message)
     {
         $room_id = $message['room_id'];
         if (isset($this->subscriptions[$room_id])) {
             foreach ($this->subscriptions[$room_id] as $client) {
                 // Gönderen dışındaki tüm kullanıcılara mesajı gönder
                 if ($client !== $from) {
                     $client->send(json_encode(['type' => 'message', 'content' => json_encode($message)]));
                 }
             }
         }
     }
     protected function getClientByUserId($user_id)
     {
         foreach ($this->clients as $client) {
             if ($client->resourceId == $user_id) {
                 return $client;
             }
         }
         return null;
     }
 }



//  protected function sendMessageToRoom(ConnectionInterface $from, $message)
//  {
//      $room_id = $message['room_id'];
//      if (isset($this->subscriptions[$room_id])) {
//         $count = 0;
//         $isSeens  = false;
//         $type = "sender";
//          foreach ($this->subscriptions[$room_id] as $client) {
             
//                 if($count <= 1 )
//                 {
//                     if($count == 1){
//                         $message_ids = $message['message_id'];
//                         echo("\n Mesaj id : {$message_ids}");
//                         $message = Message::find($message_ids);
//                         if ($message) {
//                             $message->isSeens = true;
//                             $message->save();
//                         }
//                         $this->isSeens = true;
//                     }else{
//                         $this->isSeens =false;
//                     }
                  
//                     $count++;
                    
//                 }
//                 if ($client !== $from) 
//                 { 
//                     $this->type = "receiver";    
//                 }
//                 else{
//                      $this->type = "sender";    
//                 }

//                 echo("\n sent message \n"); 
//                 echo($count);
//                 $message['goruldu']=$this->isSeens;
//                 $client->send(json_encode(['type' => $this->type, 'content' => json_encode($message)]));
//              }
//          }
     
//  }