<?php namespace App\Http\Pack;


use App\Http\File\FileRepository;
use App\PersonalFile;
use App\PersonalFolder;

class PackRepository {

    /**
     * @var FileRepository
     */
    private $fileRepository;
    /**
     * @var PersonalFolder
     */
    private $folder;
    /**
     * @var PersonalFile
     */
    private $file;

    /**
     * Constructor:
     * @param PersonalFolder $folder
     * @param PersonalFile $file
     * @param FileRepository $fileRepository
     */
    function __construct(PersonalFolder $folder, PersonalFile $file, FileRepository $fileRepository)
    {


        $this->fileRepository = $fileRepository;
        $this->folder = $folder;
        $this->file = $file;
    }
    public function storeDocuments($file, $location, $folder, $type, $requestName)
    {
        if($requestName == null)
            $name = $file['file']['name'];
        else
        {
            $fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $requestName);
            $fileName = filter_var($fileName, FILTER_SANITIZE_URL);
            $name = $fileName.'.'.$type;
        }
        $rand = $this->fileRepository->randomFileName();
        $actualName = $name .  $rand . '.' . $type;

        $tmpName = $file['file']['tmp_name'];
        $destination = 'uploads/' . $location . '/' . $actualName;

        if (!move_uploaded_file($tmpName, $destination)) {
            return false;
        }

        $folder->files()->create([
            'name' => $name,
            'type' => $type,
            'rand' => $rand,
            'source' => $destination,
            'user_id' => \Auth::user()->id,
        ]);

        return true;

    }

    public function deleteFile($file)
    {
        $file->delete();
    }


    public function createFolder($request)
    {
        $folder = \Auth::user()->personalFolders()->create([
            'name' => $request->name,
            'permission' => $request->permission
        ]);

        return $folder;
    }

    public function createSubFoldersOf($folder, $request)
    {
        $subFolder = $folder->subFolders()->create([
            'name' => $request->name,
            'permission' => $request->permission,
            'sub_directory' => 1,
        ]);

        return $subFolder;
    }

    public function updateFolder($folder, $request)
    {
        $folder->name = $request->name;
        $folder->permission =  $request->permission;
        $folder->save();
        return $folder;
    }

    public function deleteFolder($folder)
    {
        $folder->delete();
    }

    public function filesForFolder($folder)
    {
        return $folder->files()->get();
    }

    public function subFoldersForFolder($folder)
    {
        return $folder->subFolders()->get();
    }

} 