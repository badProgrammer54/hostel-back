<?php


namespace App\Services\Room;

use App\Interfaces\DataCreateRoomInterface;
use App\Models\Exceptions\ServiceException;
use App\Models\Room;
use App\Services\BaseService;

class RoomService extends BaseService
{


    /**
     * @param DataCreateRoomInterface $dataCreateRoom
     * @return Room
     */
    public function createRoom(DataCreateRoomInterface $dataCreateRoom): Room
    {
        /** @var Room $room */
        $room = (new Room())->create([
            'number' => $dataCreateRoom->getNumber(),
            'description' => $dataCreateRoom->getDescription(),
        ]);

        return $room;
    }

//    /**
//     * @param int $newsPostId
//     * @param DataUpdateNewsPostInterface $dataUpdateNewsPost
//     * @return NewsPost
//     * @throws ServiceException
//     */
//    public function updateNewsPost(int $newsPostId, DataUpdateNewsPostInterface $dataUpdateNewsPost): NewsPost
//    {
//        $dataPublishedAt = [];
//
//        $newsCategoryId = $dataUpdateNewsPost->getCategoryId();
//
//        /** @var NewsPost $newsPost */
//        $newsPost = $this->getModalById($this->newsPostRepository, $newsPostId);
//
//        if($newsCategoryId !== null) {
//            $this->getModalById($this->newsCategoryRepository, $newsCategoryId);
//        }
//
//        if (!$newsPost->getIsPublished() && $dataUpdateNewsPost->getIsPublished()) {
//            $dataPublishedAt = ['published_at' => date("Y-m-d H:i:s")];
//        }
//
//        $newsPost->update(array_merge($this->getValidDataToNewsPost($dataUpdateNewsPost->getDataToUpdate()),
//            $dataPublishedAt));
//
//        return $newsPost;
//    }
}