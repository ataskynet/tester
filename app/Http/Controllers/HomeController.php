<?php namespace App\Http\Controllers;

use App\course;
use App\Http\Mail\UserMailer;
use App\Http\Post\PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * Create a new controller instance.
     * @param PostRepository $postRepository
     * @param UserMailer $mailer
     */
	public function __construct(PostRepository $postRepository, UserMailer $mailer)
	{
		//$this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->mailer = $mailer;
    }

    public function returnProfilePicture($email){
        $user = User::where('email', $email)->first();

        return $user->profileSource();
    }
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $title = 'Activity Feed';
        $statuses = $this->postRepository->feedForUser($this->user());
        $user = $this->user();
        return view('inspina.home.feed', compact('title','user', 'statuses'));
	}

    public function admin()
    {
        return $this->view('dashboard.admin', 'DashBoard');
    }

    public function noAccount()
    {
        return $this->view('partials.inspina.oops', 'Ooops!');
    }

    public function createFile()
    {
        $title = 'File Manager';
        $message = 'Upload a file';
        return view('file', compact('title', 'message'));
    }

    public function uploadFile(Request $request)
    {
        $name = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $location = 'uploads/';
        if(move_uploaded_file($tmpName, $location.$name))
        {
            return redirect()->back()->with('message', 'File has already been uploaded');
        } else {
            return redirect()->back()->with('message', 'File has already been uploaded');
        }

    }

    public function sendMail(UserMailer $mailer)
    {
        Mail::raw('Laravel with Mailgun is easy!', function($message)
        {
            $message->to('kamausamuel11@gmail.com');
        });
       #$mailer->sendConfirmationMailTo($this->user(), str_random(60));
    }

    public function upload()
    {
        // getting all of the post data

        $files = Input::file('files');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);
            if($validator->passes()){
                $destinationPath = 'uploads';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;
            }
        }
        if($uploadcount == $file_count){

            return Response::json('success', 200);
        }
        else {
            return Response::json('error', 400);
        }
    }
    public function tester()
    {
        $input = Input::all();

        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $destinationPath = 'uploads/test'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        dd();
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
}
