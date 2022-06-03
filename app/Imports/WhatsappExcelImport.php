<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\WhatsappController;

class WhatsappExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $workon = session()->get('workon');
        $messageTotext = session()->get('messageTotext');
        $caption_image = session()->get('caption_image');
        $fileuploads = session()->get('fileuploads');


foreach($collection as $key => $values){
    if($key > 0){    
      $mobilenumber = substr($values['2'], -10);
          if ($workon == "text") {
            (new WhatsappController)
            ->sendRequesttoWhats($mobilenumber,$messageTotext);
          }
          if ($workon == "image") {
            (new WhatsappController)
            ->sendRequesttoWhatshorfileupload('image',$mobilenumber,$fileuploads,$caption_image);
          }
          if ($workon == "video") {
            (new WhatsappController)
            ->sendRequesttoWhatshorfileupload('video',$mobilenumber,$fileuploads,$caption_image);
          }
          if ($workon == "audio") {
            (new WhatsappController)
            ->sendRequesttoWhatshorfileupload('audio',$mobilenumber,$fileuploads,$caption_image);
          }
          if ($workon == "document") {
            (new WhatsappController)
            ->sendRequesttoWhatshorfileuploaddocument('document',$mobilenumber,$fileuploads,$caption_image);
          }
            }
        }
    }
}
