<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
	        'ad' => 'required|string|max:20',
	        'soyad' => 'required|string|max:20',
	        'username' => 'required|string|max:16|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
	        'ad' => trim(mb_strtolower(htmlspecialchars($data['ad']))),
	        'soyad' => trim(mb_strtolower(htmlspecialchars($data['soyad']))),
	        'username' => trim(mb_strtolower(htmlspecialchars($data['username']))),
            'email' => htmlspecialchars($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }

	/**
	 * Register Custom *_*
	 * @param Request $request
	 */
	protected function register(Request $request){
    	$input=$request->all();
    	$validator=$this->validator($input);
    	if($validator->passes()){
    		$data=$this->create($input)->toArray();
    		$data['token']=str_random(25);
    		$user=User::find($data['id']);
    		$user->email_token=$data['token'];
    		$user->save();

    		Mail::send('mails.confirmation',$data,function($message) use ($data){
    			$message->to($data['email']);
    			$message->subject('Hesab təstiqlənməsi');
		    });
    		return redirect(route('daxilol'))->with('status','Hesab təstiqlənməsi üçün link e-mail ünvanınıza göndərildi.');
	    }
	    return redirect(route('qeydiyyat'))->with('errors',$validator->errors())->withInput();
    }


}
