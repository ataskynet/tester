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


    public function createFolder($name)
    {
        $folder = \Auth::user()->personalFolders()->create([
            'name' => $name
        ]);

        return $folder;
    }

    public function createSubFoldersOf($folder, $name)
    {
        $subFolder = $folder->subFolders()->create([
            'name' => $name,
            'sub_directory' => 1,
        ]);

        return $subFolder;
    }

    public function renameFolder($folder, $name)
    {
        $folder->name = $name;
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