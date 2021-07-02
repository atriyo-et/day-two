<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Questions;
use App\Models\Options;
use Redirect;

class MCQ extends Controller
{
    public $Request; //Global - Request Variable

    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }

    function index(){
        $questions = Questions::all();
        
        return view('index',['questions' => $questions]);
    }
    
    function list(){
        $questions = Questions::all();
        
        return view('list',['questions' => $questions]);
    }

    function add(){
        if($this->Request->isMethod('get')):
            return view('add');
        else:
            
            $question = $this->Request->input('question');
            $point = $this->Request->input('point');
            $option = $this->Request->input('option');
            $correct = $this->Request->input('correct');
            $lastQuestion = Questions::orderBy('ques_num','DESC')->first();
            $ques_num = $lastQuestion->ques_num+1;
            Questions::create(['ques_num' => $ques_num, 'question' => $question, 'point' => $point ]);
            for($i=0; $i < count($option); $i++){
                Options::create(['ques_id' => $ques_num,'answer' => $option[$i], 'correct' => $correct[$i]]);
            }
            return redirect()->route('list');
        endif;
    }

    function edit(){
        if($this->Request->isMethod('get')):
            $question_id = $this->Request->id;
            $questions = Questions::where('id',$question_id)->first();
            $options = Options::where('ques_id',$question_id)->get();
            
            return view('edit',['questions' => $questions , 'options' => $options]);
        else:
            $question_id = $this->Request->input('id');
            $question = $this->Request->input('question');
            $point = $this->Request->input('point');
            $option = $this->Request->input('option');
            $correct = $this->Request->input('correct');
            $option_id = $this->Request->input('option_id');
            Questions::where('id',$question_id)->update(['question' => $question, 'point' => $point]);
            
            for($i=0; $i < count($option_id); $i++){
                Options::where('id',$option_id[$i])->where('ques_id',$question_id)->update(['answer' => $option[$i], 'correct' => $correct[$i]]);
            }
            return redirect()->route('list');

        endif;
    }

    function addoptions(){
        if($this->Request->isMethod('get')):
            $question_id = $this->Request->id;
            $questions = Questions::where('id',$question_id)->first();

            return view('add-options',['questions' => $questions ]);
        else:
            $question_id = $this->Request->input('question_id');
            $option = $this->Request->input('option');
            $correct = $this->Request->input('correct');

            for($i=0; $i < count($option); $i++){
                Options::create(['ques_id' => $question_id,'answer' => $option[$i], 'correct' => $correct[$i]]);
            }
            return redirect()->route('list');
        endif;
    }

    function delete(){
        $question_id = $this->Request->id;
        Questions::destroy($question_id);
        Options::where('ques_id',$question_id)->delete();
        
        return redirect()->route('list');
    }

    function quiz(){
        $totalQuestions = Questions::count();
        $selectedOptions = $this->Request->input('ques');
        $totalPoints = $pointsGained = 0; 
        for($i=1; $i <= $totalQuestions; $i++){
            $totalPoints = $totalPoints + Questions::where('ques_num',$i)->first()->point;
            $pointsGained = Options::where('id',$selectedOptions[$i])->first()->correct=='true'? $pointsGained + Questions::where('ques_num',$i)->first()->point: $pointsGained+0;
        }
        return view('result',['obtained' =>$pointsGained, 'total' =>$totalPoints]);
    }

    public static function getAnswer($question_number){
        return $options = Options::where('ques_id',$question_number)->orderBy('id','ASC')->get();
    }

    function api_get_all(){
        $questions = Questions::all();
        if($questions){
            $Q['success'] = true;
            $Q['total']= count($questions);
            foreach($questions as $question){
                $D['ques_id']= $question->id;
                $D['question']= $question->question;
                $D['ques_point']= $question->point;
                $D['quest_options']= Options::select('id','answer','correct')->where('ques_id',$question->id)->get();
                $Q['data'][]=$D;
            }
        }
        else{
            $Q['success'] = false;
            $Q['message'] =  'No data found';
        }
        return json_encode($Q);
    }

    function api_get_options_by_question_id($id=null){
        $question = Questions::where('id',$id)->first();
        if($question){
            $Q['success'] = true;
            $Q['data'] = Options::select('id','answer','correct')->where('ques_id',$question->id)->get();
        }
        else{
            $Q['success'] = false;
            $Q['message'] = 'Question id unknown';
        }
        echo json_encode($Q);
    }

    function api_get_correct_option_by_question_id($id=null){
        $question = Questions::where('id',$id)->first();
        if($question){
            $option = Options::where('ques_id',$question->id)->where('correct','true')->first();
            $Q['success'] = true;
            $Q['id'] = $option->id; 
            $Q['answer'] = $option->answer; 
        }
        else{
            $Q['success'] = false;
            $Q['message'] = 'Question id unknown';
        }
        echo json_encode($Q);
    }

    function api_check_correct_option_for_question($question=null,$option=null){
        $Ques = Questions::where('id',$question)->first();
        if($Ques){
            $Opt = Options::where('ques_id',$Ques->id)->where('id',$option)->first();
            if($Opt){
                if($Opt->correct=='true'){
                    echo json_encode(['success' => true, 'answer'=>true]);
                }
                else{
                    echo json_encode(['success' => true, 'answer'=>false]);
                }
            }
            else{
                echo json_encode(['success'=>false , 'message'=>'Option id unknown']);
            }
        }
        else{
            echo json_encode(['success' => false, 'error'=>'Question id unknown']);
        }
    }
    
    function api_add_new_question($question=null,$point=null){
        if($question && strlen($question)>5){
            if(Questions::where('question',trim($question))->count()){
                $data['success'] = false;
                $data['message'] = 'Question already exist';
            }
            else{
                $lastQuestion = Questions::orderBy('ques_num','DESC')->first();
                $ques_num = $lastQuestion->ques_num+1;
                if($insert = Questions::create(['ques_num' => $ques_num, 'question' => $question, 'point' => $point?$point:1 ])){
                    $data['success'] = true;
                    $data['message'] = 'Question successfully created';
                    $data['insert_id'] = $insert->id;
                }
                else{
                    $data['success'] = false;
                    $data['message'] = 'Question creation failed';
                }
            }
        }
        else{
            $data['success'] = false;
            $data['message'] = 'Question is too short';
        }
        echo json_encode($data);
    }

    function api_add_options_to_question($question=null,$option=null,$correct=null){
        if($option && strlen($option)>0){
            if(Questions::where('id',$question)->count()){
                if(Options::where('ques_id',$question)->count()<4){
                    if(Options::where('ques_id',$question)->where('answer',trim($option))->count()){
                        $data['success'] = false;
                        $data['message'] = 'Option already exist for this question';
                    }
                    else{
                        if($insert = Options::create(['ques_id' => $question,'answer' => $option, 'correct' => $correct==1?'true':($correct=='true'?'true':'false')])){
                            $data['success'] = true;
                            $data['message'] = 'Option successfully created';
                        }
                        else{
                            $data['success'] = false;
                            $data['message'] = 'Option creation failed';
                        }
                    }
                }
                else{
                    $data['success'] = false;
                    $data['message'] = 'Maximum option limit reached';
                }
            }
            else{
                $data['success'] = false;
                $data['message'] = 'Invalid question id';
            }
        }
        else{
            $data['success'] = false;
            $data['message'] = 'Option is too short';
        }
        echo json_encode($data);
    }
}
