<?php namespace App\Http\Controllers;

use App\Http\File\FileRepository;
use App\Http\Pack\PackRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\CreateFolderRequest;
use App\PersonalFolder;
use Illuminate\Http\Request;

class PackController extends Controller {
    /**
     * @var FileRepository
     */
    private $fileRepository;
    /**
     * @var PackRepository
     */
    private $packRepository;

    /**
     * @param FileRepository $fileRepository
     * @param PackRepository $packRepository
     */
    function __construct(FileRepository $fileRepository, PackRepository $packRepository)
    {

        $this->fileRepository = $fileRepository;
        $this->packRepository = $packRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param $group
     * @param $user
     * @param null $folder
     * @return Response
     */
	public function visit($group ,$user , $folder = null)
	{
        if($folder == null)
        {
            $title = $user->fullName() . "'s Back-Pack";
            $folders = $user->rootFolders();
            return view('inspina.pack.public', compact('user','group','folders','title'));
        }
        $title = $user->fullName() . "'s Back-Pack: " .$folder->name;
        $folders = $folder->subFolders()->get();
        $documents =  $folder->files()->get();
        return view('inspina.pack.public', compact('user','folders', 'documents', 'folder', 'group','title'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFileRequest $request
     * @param $folder
     * @return Response
     */
	public function store(CreateFileRequest $request, $folder)
	{
        $type = $request->file('file')->getClientOriginalExtension();
        $name = $request->name;
        if($request->file('file')->getClientSize() > 100000000)
        {
            return redirect()->back()->with('error', 'The file must be under 100Mb in size.');
        }

        if(!$this->fileRepository->authenticateType($type, $this->fileRepository->allowedTypes))
            return redirect()->back()->with('error', 'This file extension is not supported.');

        $this->packRepository->storeDocuments($_FILES, 'documents', $folder  ,$type, $name);
        $this->flash('The File has now been successfully uploaded to your back-pack');
        return redirect()->back();
	}

    /**
     * Display the specified resource.
     *
     * @param $folder
     * @internal param $personalFolder
     * @internal param int $id
     * @return Response
     */
	public function show($folder)
	{
        $title = 'Back-Pack: '.$folder->name;
		$subFolders = $folder->subFolders()->get();
        $documents =  $folder->files()->get();
        return view('inspina.pack.view', compact('subFolders', 'documents', 'folder','title'));
	}


    /**
     * Update the specified resource in storage.
     *
     * @param $folder
     * @param CreateFolderRequest $request
     * @internal param int $id
     * @return Response
     */
	public function update($folder, CreateFolderRequest $request)
	{
		$this->packRepository->renameFolder($folder, $request->name);
        $this->flash('You have successfully renamed the folder');
        return redirect()->back();
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $file
     * @internal param int $id
     * @return Response
     */
	public function destroy($folder, $file)
	{
		$this->packRepository->deleteFile($file);
        $this->flash('The file was successfully deleted from the folder');
        return redirect('pack/'.$folder->id);
	}

    public function storeFolder(CreateFolderRequest $request)
    {
        $folder = $this->packRepository->createFolder($request->name, \Auth::user());
        $this->flash('You have successfully created a new folder');
        return redirect('/pack/'.$folder->id);
    }

    public function destroyFolder($folder)
    {
        $name = $folder->name;
        if($folder->isSubFolder())
        {
            $parentFolder = PersonalFolder::find($folder->personal_folder_id);
            $this->packRepository->deleteFolder($folder);
            $this->flash('You have successfully deleted the '.$name.' folder');
            return redirect('/pack/' .$parentFolder->id);
        }
        $this->packRepository->deleteFolder($folder);
        $this->flash('You have successfully deleted the '.$name.' folder');
        return redirect('/');
    }

    public function storeSubFolder(CreateFolderRequest $request, $folder)
    {

        $this->packRepository->createSubFoldersOf($folder, $request->name);
        $this->flash('You have successfully created a new sub folder');
        return redirect()->back();
    }
}
