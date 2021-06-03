<?php
require_once('controllers/base_controller.php');
require_once('models/post.php');
require_once('models/user.php');
require_once('models/tag.php');
require_once('models/comment.php');
require_once('common/utility.php');

use Model\Comment;
use Common\Utility;

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
        $tag = new Tag();
        $tags = $tag->all();
        $data = array('tags' => $tags);
        $this->render('post', $data);
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
            $selectedPost = $this->post->getById($_GET['id']);
            $listPostFromAuthor = $this->post->getByAuthorId($selectedPost->author->_id);
            $data = array('post' => $selectedPost, 'listPost' => $listPostFromAuthor);
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
                echo $result;
            }
        }
    }

    public function edit() {
        session_start(); {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $currentPost = $this->post->getById($_GET['id']);
                $tag = new Tag();
                $tags = $tag->all();
                if ($currentPost->author->_id == $_SESSION['userId']) {
                    $this->render('edit', ['post' => $currentPost, 'tags' => $tags]);
                }  header('Location: ?controller=pages&action=error');
            } header('Location: ?controller=pages&action=error');
        }
    }

    public function postEdit()
    {
        session_start();
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $currentPost = $this->post->getById($_GET['id']);
            if ($currentPost->author->_id == $_SESSION['userId']) {
                if (isset($_POST['title']) && isset($_POST['tags']) && isset($_POST['content'])) {
                    $tag = new Tag();
                    $tags = explode(" ", $_POST['tags']);
                    $tagList = [];
                    $currentTags = [];
                    foreach ($currentPost->tags as $t) {
                        array_push($currentTags, $t->name);
                    }
                    foreach ($tags as $tg) {
                        $item = $tag->getByName($tg);
                        if (!empty($item)) {
                            unset($item->count);
                            array_push($tagList, $item);
                        }
                    }
                    $post = [
                        'title' => $_POST['title'],
                        'tags' => $tagList,
                        'content' => $_POST['content'],
                        'updated_at' => new MongoDB\BSON\UTCDateTime()
                    ];
                    $res = $this->post->update($currentPost->_id, $post);
                    if ($res > 0) {
                        foreach ($tags as $tg) {
                            $item = $tag->getByName($tg);
                            if (!empty($item)) {
                                if (!in_array($tg, $currentTags)) $tag->update($item->_id, $item->count + 1);
                            }
                        }
                        foreach ($currentTags as $ct) {
                            $i = $tag->getByName($ct);
                            if (!empty($i)) {
                                if (!in_array($ct, $tagList)) $tag->update($i->_id, $i->count - 1);
                            }
                        }
                        echo $res;
                    }
                    echo $res;
                }
            }
        }
    }

    public function delete()
    {
        session_start();
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $currentPost = $this->post->getById($_GET['id']);
            if ($currentPost->author->_id == $_SESSION['userId']) {
                $tag = new Tag();
                $tagList = [];
                $currentAuthor = $currentPost->author->_id;
                foreach ($currentPost->tags as $t) {
                    $item = $tag->getById($t->_id);
                    array_push($tagList, $item);
                }
                $res = $this->post->delete($currentPost->_id);
                if ($res > 0) {
                    foreach ($tagList as $tl) {
                        $tag->update($tl->_id, $tl->count - 1);
                    }
                    // header('Location: ?controller=users&action=profile&id=' . $currentAuthor);
                    echo $res;
                } else echo $res;
            }
        }
    }

    function postComment()
    {
        if (!empty($_POST['post_id']) && !empty($_POST['content'])) {
            if (!empty($_POST['user_id'])) {
                $postId = $_POST['post_id'];
                $userId = $_POST['user_id'];
                $content = $_POST['content'];
                $commentContent = [
                    'user_id' => new MongoDB\BSON\ObjectId($userId),
                    'content' => $content,
                    'created_at' => new MongoDB\BSON\UTCDateTime()
                ];
                $comment = new Comment();
                $comment->push($postId, $commentContent);
                $user = (new User())->getById($userId);

                header('Content-type: application/json');
                echo json_encode([
                    'user_id' => $userId,
                    'content' => $content,
                    'created_at' => Utility::gmdateToLocalDate($commentContent['created_at']->toDateTime()),
                    'avatar' => $user['avatar'] ?? '',
                    'given_name' => $user['given_name']
                ]);
                return;
            } else {
                return http_response_code(401);
            }
        } else {
            return http_response_code(400);
        }
    }
}
