<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;
use App\Model\Student;

class AgentController extends Controller
{
   public function index(Request $request)
    {
        if(isset($_GET['search'])){
            $agent = Agent::where('agent_name', 'like', '%' . $request->search . '%')
                    ->orWhere('agent_contact_number','like','%' . $request->search . '%')
                    ->paginate(10);
        }else{
            $agent = Agent::paginate(10);
        }
        return view('agent.index',compact('agent'));
     
    }

    public function create(Request $request)
    {
        return view('agent.create');
    }

    public function add(Request $request)
    {
        
        $validator = $request->validate([
        'agent_name' => 'required|min:3',
        'agent_contact_number' => 'required|digits:10|numeric|unique:agents',
        'status' => 'required',
        ],
        [
        'agent_name.required' => 'Agent Name is required',
        'agent_contact_number.required' => 'Agent Contact Number is required',
        'agent_contact_number.unique' => 'Agent Contact Number should be unique',
        'agent_contact_number.numeric' => 'Agent Contact Number should be numeric',
        'status.required' => 'Status is required',
        ]);

        $agent = new Agent;
        $agent->agent_name = $request->input('agent_name');
        $agent->agent_contact_number = $request->input('agent_contact_number');
        $agent->agent_email = $request->input('agent_email');
        $agent->status = $request->input('status');

        $name = strtoupper($request->input('agent_name'));

        if($agent->save()){
            $id = $agent->id;
            $num = 1000;
            $name = substr($name,0,3);
            $code = $num+$id;
            $sub = substr($code,'1');
            $data['agent_code'] = $name.$sub;
            $data['access_key'] = $name.$sub.rand(10,100);

            Agent::where('id',$id)->update($data);

            return redirect()->route('agent.index')->with('success',"Agent Created Successfully!");
        }
    }

    public function destroy(Request $request)
    {
        
        $id = base64_decode($request->id);   
        $agent = Agent::where('id',$id)->delete();
        if($agent){
            return redirect()->route('agent.index')->with('success',"Agent Deleted Successfully!");
        }
    }

    public function edit(Request $request)
    {
        $id = base64_decode($request->id);    
        $agent = Agent::find($id);
        return view('agent.edit',compact('agent'));
    }

    public function update(Request $request)
    {
      
       $id = $request->id;    
       $data = [
            'agent_name' => $request->input('agent_name'),
            'agent_contact_number' => $request->input('agent_contact_number'),
            'agent_email' => $request->input('agent_email'),
            'status' => $request->input('status'),
        ];

        $agent = Agent::where('id',$id)->update($data);

        if($agent){
            return redirect()->route('agent.index')->with('success',"Agent Updated Successfully!");
        }
    }

    public function getAgentUsers(Request $request)
    {
        $agent_code =  base64_decode($request->code);

        if(isset($_GET['search'])){
            $agent_users = Student::where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email','like','%' . $request->search . '%')
                    ->paginate(10);
        }else{
            $agent_users = Student::where('agent_code',$agent_code)->paginate(10);
        }
        return view('agent.agent_register_users',compact('agent_users'));
    }
}

