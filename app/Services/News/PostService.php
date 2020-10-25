<?php


namespace App\Services\News;


use App\Interfaces\DataCreateNewsPostInterface;
use App\Interfaces\DataUpdateNewsPostInterface;
use App\Models\Exceptions\ServiceException;
use App\Models\NewsPost;
use App\Services\BaseService;

class PostService extends BaseService
{
    use NewsTrait;

    private const FIELDS_UPDATE = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content_raw',
        'content_html',
        'is_published',
        'published_at'
    ];

    /**
     * @param DataCreateNewsPostInterface $dataCreateNewsPost
     * @return NewsPost
     * @throws ServiceException
     */
    public function createNewsPost(DataCreateNewsPostInterface $dataCreateNewsPost): NewsPost
    {
        $this->getModalById($this->newsCategoryRepository, $dataCreateNewsPost->getCategoryId());

        /** @var NewsPost $newsPost */
        $newsPost = (new NewsPost())->create([
            'category_id' => $dataCreateNewsPost->getCategoryId(),
            'user_id' => $dataCreateNewsPost->getUserId(),
            'title' => $dataCreateNewsPost->getTitle(),
            'slug' => $dataCreateNewsPost->getSlug(),
            'excerpt' => $dataCreateNewsPost->getExcerpt(),
            'content_raw' => $dataCreateNewsPost->getContentRaw(),
            'content_html' => $dataCreateNewsPost->getContentHtml(),
            'is_published' => $dataCreateNewsPost->getIsPublished(),
            'published_at' => $dataCreateNewsPost->getIsPublished() ? date("Y-m-d H:i:s") : null,
        ]);

        return $newsPost;
    }

    /**
     * @param int $newsPostId
     * @param DataUpdateNewsPostInterface $dataUpdateNewsPost
     * @return NewsPost
     * @throws ServiceException
     */
    public function updateNewsPost(int $newsPostId, DataUpdateNewsPostInterface $dataUpdateNewsPost): NewsPost
    {
        $dataPublishedAt = [];

        $newsCategoryId = $dataUpdateNewsPost->getCategoryId();

        /** @var NewsPost $newsPost */
        $newsPost = $this->getModalById($this->newsPostRepository, $newsPostId);

        if($newsCategoryId !== null) {
            $this->getModalById($this->newsCategoryRepository, $newsCategoryId);
        }

        if (!$newsPost->getIsPublished() && $dataUpdateNewsPost->getIsPublished()) {
            $dataPublishedAt = ['published_at' => date("Y-m-d H:i:s")];
        }

        $newsPost->update(array_merge($this->getValidDataToNewsPost($dataUpdateNewsPost->getDataToUpdate()),
            $dataPublishedAt));

        return $newsPost;
    }

    private function getValidDataToNewsPost(array $fieldsUpdate = []): array
    {
        $result = [];
        foreach (self::FIELDS_UPDATE as $field) {
            if (array_key_exists($field, $fieldsUpdate)) {
                $result[$field] = $fieldsUpdate[$field];
            }
        }

        return $result;
    }
}