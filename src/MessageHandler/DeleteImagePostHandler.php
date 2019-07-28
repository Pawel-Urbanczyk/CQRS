<?php
declare(strict_types=1);


namespace App\MessageHandler;

use App\Message\DeletePonkaToImage;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteImagePostHandler implements MessageHandlerInterface
{
    /**
     * @var PhotoFileManager
     */
    private $photoManager;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        PhotoFileManager $photoManager,
        EntityManagerInterface $entityManager
    )
    {
        $this->photoManager = $photoManager;
        $this->entityManager = $entityManager;
    }

    public function __invoke(DeletePonkaToImage $deletePonkaToImage)
    {
        $imagePost = $deletePonkaToImage->getImagePost();
        $this->photoManager->deleteImage($imagePost->getFilename());

        $this->entityManager->remove($imagePost);
        $this->entityManager->flush();
    }
}