<?php
require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/user.php');
require_once('models/tag.php');

class PostsController extends BaseController
{
    private $post;
    function __construct()
    {
        parent::__construct();
        $this->post = new Post();
    }

    public function post()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            $tag = new Tag();
            $tags = $tag->all();
            $data = array('tags' => $tags);
            $this->render('post', $data);
        } else header('Location: ?controller=users&action=login');
    }

    public function tag()
    {
        if (isset($_GET['tag'])) {
            $posts = $this->post->getByTagName($_GET['tag']);
            $this->render('get_by_tag', ['posts' => $posts, 'tag' => $_GET['tag']]);
        }
    }

    public function detail()
    {
        if (isset($_GET['id'])) {
            $posts = $this->post->all();
            $selectedPost = $this->post->getById($_GET['id']);
            $listPostFromAuthor = $this->post->getByAuthorId($selectedPost->author->_id);
            $listPostFromOtherAuthor = [];
            foreach ($posts as $post) {
                if ($post->author->_id != $selectedPost->author->_id) array_push($listPostFromOtherAuthor, $post);
            }
            $data = array('post' => $selectedPost, 'listPost' => $listPostFromAuthor, 'other' => $listPostFromOtherAuthor);
            $this->render('detail', $data);
        } else header('Location: index.php?controller=pages&action=error');
    }

    public function save()
    {
        if (isset($_GET['userId']) && !empty($_GET['userId'])) {
            $user = new User();
            $tag = new Tag();
            $tagList = [];
            $currentUser = $user->getById($_GET['userId']);
            $author = [
                '_id' => $currentUser->_id,
                'given_name' => $currentUser->given_name
            ];
            if (isset($_POST['title']) && isset($_POST['tags']) && isset($_POST['content'])) {
                $tags = explode(" ", $_POST['tags']);
                foreach ($tags as $t) {
                    $item = $tag->getByName($t);
                    $tag->update($item->_id, 1);
                    unset($item->count);
                    array_push($tagList, $item);
                }
                $post = [
                    'title' => $_POST['title'],
                    'tags' => $tagList,
                    'content' => $_POST['content'],
                    'author' => $author,
                    'created_at' => new MongoDB\BSON\UTCDateTime()
                ];
                $result = $this->post->insert($post);
                if ($result > 0) header('Location: index.php?controller=pages&action=blog');
                else $this->render('post', ['result' => $result]);
            } else $this->render('post', ['result' => 0]);
        }
    }
}
