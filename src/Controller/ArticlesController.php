<?php
// src/Controller/ArticlesController.php
namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();
        // Retrieve the search term from the query string
        $search = $this->request->getQuery('search');
        // Initialize the query to retrieve all articles along with their associated likes
        $query = $this->Articles->find('all')->contain(['Likes']);
        // If a search term is provided, filter articles by titles that contain the search term
        if ($search) {
            $query->where(['Articles.title LIKE' => '%' . $search . '%']);
        }
        // Fetch articles and include the likes count
        $articles = $this->paginate($query);
        // Calculate the total like count for all articles
        $totalLikes = $this->Articles->Likes->find()->count();
        // Fetch the like counts for each article, grouping by article_id
        $likeCounts = $this->Articles->Likes
            ->find()
            ->select([
                'article_id',
                'count' => $this->Articles->Likes->find()->func()->count('id'),
            ])
            ->group('article_id')
            ->all();

        // Set empty array and fill it with the like counts for each article
        $likeCountsArray = [];
        foreach ($likeCounts as $likeCount) {
            $likeCountsArray[$likeCount->article_id] = $likeCount->count;
        }
        // Use the set method to pass variables to the view template
        $this->set(compact('articles', 'totalLikes', 'likeCountsArray'));
    }

    public function view($slug = null)
    {
        $this->Authorization->skipAuthorization();

        // Retrieve the article by its slug, including associated tags, comments with user info, and likes
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain([
                'Tags',
                'Comments' => function ($q) {
                    return $q
                        ->contain(['Users'])
                        ->leftJoinWith('CommentLikes') // Join with CommentLikes table
                        ->select([
                            'Comments.id',
                            'Comments.body',
                            'Comments.created',
                            'Comments.user_id',
                            'Comments.article_id',
                            'Users.email',
                            'likes_count' => $q
                                ->func()
                                ->count('CommentLikes.id'), // Count the number of likes for each comment
                        ])
                        ->group('Comments.id');
                },
            ])
            ->firstOrFail();

        $currentUserEmail = $this->request->getAttribute('identity')->email;

        // Use the set method to pass var to the view template
        $this->set(compact('article', 'currentUserEmail'));

        //set to false to hide Logout button shown in Default Layout
        $this->set('showLogoutButton', false);
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->_form($article);
    }

    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        $this->_form($article);
    }

    protected function _form($article)
    {
        $this->Authorization->authorize($article);

        if ($this->request->is(['post', 'put', 'patch'])) {
            $article = $this->Articles->patchEntity(
                $article,
                $this->request->getData(),
                ['associated' => ['Tags']]
            );

            $article->user_id = $this->request
                ->getAttribute('identity')
                ->getIdentifier();

            // Handle the image file upload
            $image = $this->request->getData('image_file');

            // Check if image is uploaded
            if ($image && $image->getError() === UPLOAD_ERR_OK) {
                $name = $image->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'articles' . DS . $name;

                if (!file_exists(WWW_ROOT . 'img' . DS . 'articles')) {
                    mkdir(WWW_ROOT . 'img' . DS . 'articles', 0777, true);
                }

                $image->moveTo($targetPath);
                $article->image = $name;
            } else {
                // Image is missing, set a validation error
                $this->Flash->error(__('Please upload an image.'));
                return;
            }

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(
                __(
                    'Unable to save your article. Please ensure all fields are filled in correctly, including an image.'
                )
            );
        }

        $tags = $this->Articles->Tags->find('list')->all();
        $this->set(compact('article', 'tags'));
        $this->render('_form');
    }

    public function delete($slug)
    {
        // Find the article by slug
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        // Authorize the user to delete the article
        $this->Authorization->authorize($article);
        // Try to delete the article
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('Could not delete the article.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function tags()
    {
        // the passed URL path segments in the request
        $tags = $this->request->getParam('pass');
        $this->Authorization->skipAuthorization();
        $articles = $this->Articles->find('tagged', tags: $tags)->all();
        // Use the set method to pass variables to the view template
        $this->set([
            'articles' => $articles,
            'tags' => $tags,
        ]);
    }
}
