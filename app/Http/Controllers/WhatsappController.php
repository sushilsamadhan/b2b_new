<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Imports\WhatsappExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class WhatsappController extends Controller
{
    public function rightmessage()
    {
        return view('whatsapp-message.index');
    }
    public function getAfterselectUsertype(Request $request)
    {
        if($request->Usertype == "Admin"){

        }
        if($request->Usertype == "Instructor"){
            echo '
                    <label class="label-text">Instructor Type</label>
                            <select name="is_external" class="form-control pl-2">
                                <option value="">Select All</option>
                                <option value="0">Internal (Olexpert Teachers)</option>
                                <option value="2">External (Freelancers)</option>
                                <option value="1">Internal and External Both</option>
                            </select>';
        }
        if($request->Usertype == "Student"){
            echo '
                <label class=""> Preference </label>
                <select class="form-control" id="package_type" name="package_type" onchange="getBoardOrCompetitive(this.value);">
                  <option value=""> Select All</option>
                  <option value="k12">Academic Courses</option>
                  <option value="18+">Competitive Courses</option>
                </select>';
        }
    }
    public function getBoardOrCompetitive(Request $request)
    {
        if($request->packType == "k12"){
            $boards = \App\Model\Category::where('parent_category_id',83)->get();
            echo '
                <label class=""> Board/Exam </label>
                <select class="form-control" name="board_exam_type" onchange="getBoardClasses(this.value);">
                  <option value=""> Select All</option>';

        foreach($boards as $boardsval){    
            echo '<option value="'.$boardsval->id.'">'.$boardsval->name.'</option>';
        }
            echo ' </select>';
        }
        if($request->packType == "18"){
            $con = ['is_compitative' => '1', 'parent_category_id' => '0'];
            $Competitive = \App\Model\Category::where($con)->get();
            echo '
                <label class=""> Board/Exam </label>
                <select class="form-control" name="board_exam_type" onchange="getBoardClasses(this.value);">
                  <option value=""> Select All</option>';
            foreach($Competitive as $Competitiveval){
                echo '<option value="'.$Competitiveval->id.'">'.$Competitiveval->name.'</option>';
            }
            echo ' </select>';
        }
    }
    public function get_board_comptitive_classes(Request $request)
    {
        $classes = \App\Model\Category::where('parent_category_id',$request->id)->get();
            echo '
                <label class=""> Class/Courses </label>
                <select class="form-control" name="class_name">
                  <option value=""> Select All</option>';
            foreach($classes as $classesval){
                echo '<option value="'.$classesval->id.'">'.$classesval->name.'</option>';
            }
            echo ' </select>';
    }
    public function send_whats_app_msg(Request $request)
    {

        if ($request->user_type == "Admin") {
            die('For Admin Not Working');
           // $users = DB::select("SELECT * FROM `users` WHERE `user_type` = 'Admin'");
        }elseif($request->user_type == "Instructor"){
            if($request->is_external != ""){
                $is_external = " Where `is_external` = ".$request->is_external;
            }else{
                $is_external = "";
            }
        $users = DB::select("SELECT * FROM `instructors` $is_external");
        }
        elseif($request->user_type == "Student"){
            $package_type = "";
            if($request->package_type != ""){
                $package_type = " WHERE `class_type` = '".$request->package_type."'";
                 if($request->board_exam_type != ""){
                    $board_exam_type = "";
                    if($request->board_exam_type == "9"){ $board_exam_type = "CBSE"; }
                    if($request->board_exam_type == "10"){ $board_exam_type = "ISC"; }
                    if($request->board_exam_type == "11"){ $board_exam_type = "ICSE"; }
                $board_exam_type=" AND `board` in ('".$request->board_exam_type."','".$board_exam_type."')";
                $package_type = $package_type.$board_exam_type;
            if($request->class_name != ""){
                    $class_name = " AND `class_name` = '".$request->class_name."'";
                    $package_type = $package_type.$class_name;
                }
            }
        }
        $users = DB::select("SELECT * FROM `students` $package_type");
        }else{
            die('For Admin Not Working');
           // $users = DB::select("SELECT * FROM `users`");
        }

        $messageTotext = $request->messageTotext;
        $caption_image = $request->caption_image;
        $fileuploads = $request->fileuploads;
        foreach ($users as $value) {
           $mobilenumber = $value->phone;
           $check = preg_match('/^[0-9]{10}+$/', $value->phone); 
           if($mobilenumber != "" && $check==1){      
              if ($request->workon == "text") {
                 $this->sendRequesttoWhats($mobilenumber,$messageTotext);
              }
              if ($request->workon == "image") {
                 $this->sendRequesttoWhatshorfileupload('image',$mobilenumber,$fileuploads,$caption_image);
              }
              if ($request->workon == "video") {
                 $this->sendRequesttoWhatshorfileupload('video',$mobilenumber,$fileuploads,$caption_image);
              }
              if ($request->workon == "audio") {
                 $this->sendRequesttoWhatshorfileupload('audio',$mobilenumber,$fileuploads,$caption_image);
              }
              if ($request->workon == "document") {
                 $this->sendRequesttoWhatshorfileuploaddocument('document',$mobilenumber,$fileuploads,$caption_image);
              }
           }
        }

        return redirect('/dashboard/send-whats-app-message')->with('success','Massage send successfull !');


    }

    public function sendRequesttoWhats($mobilenumber,$messageTotext){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/instance3304/messages/chat",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "token=b71qalo0ym8b6zie&to=+91".$mobilenumber."&body=".$messageTotext."&priority=1&referenceId=",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);    
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
    public function sendRequesttoWhatshorfileupload($workonwith,$mobilenumber,$filedata,$caption){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/instance3304/messages/".$workonwith,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "token=b71qalo0ym8b6zie&to=+91".$mobilenumber."&".$workonwith."=".$filedata."&caption=".$caption."&referenceId=",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }

    public function sendRequesttoWhatshorfileuploaddocument($workonwith,$mobilenumber,$filedata,$caption){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/instance3304/messages/".$workonwith,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "token=b71qalo0ym8b6zie&to=+91".$mobilenumber."&filename=".$caption."&document=".$filedata."&referenceId=",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }


    public function upload_files_send_whats_app_msg(Request $request){
        $path=$request->file('files')->store('asset_rumbok/whatsapp','public');
        if($path){
            echo url('storage/app/public').'/'.$path;
        }
    }

    public function rightmessage_using_excel(){
        return view('whatsapp-message.importexcelwhatsapp');
    }

    public function send_whats_app_msg_using_excel(Request $request){
        session()->put('workon',$request->workon);
        session()->put('messageTotext',$request->messageTotext);
        session()->put('caption_image',$request->caption_image);
        session()->put('fileuploads',$request->fileuploads);
        $excelfile = $request->excelfile;

    $changeName = $request->excelfileuoloadname." -- ".date('d-M-Y');
    $guessExtension = $request->file('excelfile')->guessExtension();
    $path = $request->file('excelfile')->storeAs('asset_rumbok/whatsapp/excelfiles', $changeName.'.'.$guessExtension  ,'public');

        // $path=$request->file('excelfile')->store('asset_rumbok/whatsapp/excelfiles','public');

        Excel::import(new WhatsappExcelImport, $excelfile);

        session()->forget('workon');
        session()->forget('messageTotext');
        session()->forget('caption_image');
        session()->forget('fileuploads');
        return redirect('/dashboard/send-whats-app-message-using-excel')
        ->with('success','Massage send successfull !');
    }

    public function show_excel_files(){
        $path = 'storage/app/public/asset_rumbok/whatsapp/excelfiles';
        $files = scandir($path);
        return view('whatsapp-message.showallexcelsheets', compact('files'));
    }
}
