<?php
declare(strict_types=1);


namespace App\MessageHandler;


use App\Message\DeletePhotoFile;
use App\Photo\PhotoFileManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeletePhotoFileHandler implements MessageHandlerInterface
{

    /**
     * @var PhotoFileManager
     */
    private $photoManager;

    public function __construct(
        PhotoFileManager $photoManager
    )
    {
        $this->photoManager = $photoManager;
    }

    public function __invoke(DeletePhotoFile $deletePhotoFile)
    {
        $this->photoManager->deleteImage($deletePhotoFile->getFilename());

    }
}