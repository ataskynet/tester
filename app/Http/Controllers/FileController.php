<?php namespace App\Http\Controllers;

use App\Folder;
use App\Group;
use App\Http\Client\ClientRepository;
use App\Http\File\FileRepository;
use App\Http\File\FolderRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\CreateFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use ZipArchive;

class FileController extends Controller
{

    protected $client;

    protected $repo;
    /**
     * @var FolderRepository
     */
    private $folderRepository;


    /**
     * @param FileRepository $repo
     * @param ClientRepository $client
     * @param FolderRepository $folderRepository
     */
    function __construct(FileRepository $repo, ClientRepository $client, FolderRepository $folderRepository)
    {
        $this->repo = $repo;
        $this->client = $client;
        $this->folderRepository = $folderRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'File Manager';
        $groups = $this->client->groupsForUser($this->user());
        return view('inspina.file.manager', compact('title', 'groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($group, $folder)
	{
		$title = $folder->name . ' DropZone';
        return view('inspina.file.dropzone', compact('title', 'folder', 'group'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param $folder
     * @param CreateFileRequestRequest|CreateFileRequest|Request $request
     * @return Response
     */
	public function store($folder ,CreateFileRequest $request)
	{

        $type = strtolower($request->file('file')->getClientOriginalExtension());
        $name = $request->name;

        if($request->file('file')->getClientSize() > 100000000)
        {
            return redirect()->back()->with('error', 'The file must be under 100Mb in size.');
        }

        if(!$this->repo->authenticateType($type, $this->repo->allowedTypes))
        {
            return redirect()->back()->withErrors('This file extension is not supported. Allowed types are');
        }


        $this->repo->uploadGroupDocument($request->file('file'), 'documents', $folder  , $name);

        $this->flash('The File has now been successfully uploaded');
		return redirect()->back();
	}

    public function storeMultiple($folder)
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

                $this->repo->uploadGroupDocument($file, 'test', $folder  , null);
                $uploadcount ++;
            }
        }
        if($uploadcount == $file_count){

            $this->flash('Files Uploaded successfully');
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $group
     * @param $folder
     * @internal param int $id
     * @return Response
     */
	public function show($group, $folder = null)
	{
        if($folder == null)
        {
            $this->flash('I am sorry. The folder is no longer available.');
            return redirect()->back();
        }
        $title = 'File Manager: '.$folder->name;
        $documents = $folder->files()->latest()->paginate(14);
        $subFolders = $folder->folders()->latest()->get();

        return view('inspina.file.manager', compact('title','group','folder', 'documents', 'subFolders'));
	}

    /**
     * @internal param $file_name
     * @param $file
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function download($file)
    {
        $this->repo->downloadFile($file);
        $this->flash('File download failed.');
        return redirect()->back();
    }
	public function destroy($folder, $file)
	{
        $file->delete();
        $this->flash('You have deleted a file from this group');
		return redirect('manager/'.$folder->group()->first()->username.'/'.$folder->id);
	}

    public function redirect($group, $folder)
    {
        return redirect('/manager/'.$group->username . '/'.$folder->id .'/main/');
    }
    /**
     * @param CreateFolderRequest $request
     * @param $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFolder(CreateFolderRequest $request, $group)
    {
        $folder = $this->folderRepository->create($request->name, $group);
        $this->flash('You have successfully created a new folder');
        return redirect('manager/'.$folder->group()->first()->username.'/'.$folder->id);
    }

    public function updateFolder($folder, CreateFolderRequest $request)
    {
        $this->folderRepository->update($request->name, $folder);
        $this->flash('You have successfully renamed the folder');
        return redirect()->back();
    }

    public function destroyFolder($folder)
    {
        $name = $folder->name;
        $group = $folder->group()->first();
        $this->folderRepository->destroy($folder);
        $this->flash('You have successfully deleted the '.$name.' folder');
        return redirect($group->username);
    }

    public function storeSubFolder(CreateFolderRequest $request, $folder)
    {

        $this->folderRepository->createSubDirectory($folder, $request->name);
        $this->flash('You have successfully created a new sub folder');
        return redirect()->back();
    }

    /**
     * @param $folder
     * @return $this
     */
    public function zipFolderFiles($folder)
    {
        $files =$folder->files()->get();
        // Here we choose the folder which will be used.
        $dirName = 'uploads/documents/';

        // Choose a name for the archive.
        $zipFileName = $folder->name.'.rar';

        // Create "MyCoolName.zip" file in public directory of project.
        $zip = new ZipArchive;

        if ( $zip->open( $dirName. $zipFileName, ZipArchive::CREATE ) === true ) {
            // Copy all the files from the folder and place them in the archive.
            foreach($files as $file)
            {
                $file = $dirName.$file->name;
                $zip->addFile($file, basename($file));
            }

            $zip->close();

            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );



            return Response::download('uploads/documents/'.$zipFileName, $zipFileName, $headers);
        }

        return redirect()->back()->withErrors('Folder could be downloaded');
    }
}
