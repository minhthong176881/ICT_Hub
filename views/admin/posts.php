<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Posts
        </h2>
        <div class="search-wrapper">
            <span class="fas fa-search"></span>
            <input type="search" placeholder="Search here">
        </div>
        <div class="user-wrapper">
            <img src="assets/img/dominhthong.jpg" width="30px" height="30px" alt="">
            <div>
                <h4><?= $user_given_name ?></h4>
                <p>Super Admin</p>
            </div>
        </div>
    </header>
    <main>
        <div class="">

            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h3>New posts</h3>
                        <!-- <button onclick="createArticle()">Create Post <span class="fas fa-arrow-right"></span></button> -->
                    </div>

                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <td style="justify-content: center;">No.</td>
                                    <td>Title</td>
                                    <td>Author</td>
                                    <td>Tag</td>
                                    <td style="justify-content: center;">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($posts as $key => $post) {
                                ?>
                                    <tr>
                                        <td style="justify-content: center;"><?= $key ?></td>
                                        <td><?= $post->title ? $post->title : "No title" ?></td>
                                        <td><?= $post->author ? $post->author->given_name : "No user" ?></td>
                                        <td>
                                            <span class="status purple"></span>
                                            <?php
                                            if (($post->tags)) {
                                                foreach ($post->tags as $tag) { ?>
                                                    <a href="" onclick="return false"> <?= $tag->name ?></a> &ensp;
                                            <?php
                                                }
                                            } else echo 'No tag';
                                            ?>
                                        </td>
                                        <td style="justify-content: center;">
                                            <!-- <span class="fas fa-edit action" style="cursor: pointer;" onclick="editPost('<?= $post->_id ?>')"></span> -->
                                            <span class="fas fa-times action" style="cursor: pointer;" onclick="deletePost('<?= $post->_id ?>')"></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
    const deletePost = (id) => {
        if (confirm('Do you really want to delete this post?')) {
            // Delete it!
            xhrPost({
                url: '?controller=admin&action=deletePost',
                data: {
                    'id': id
                },
                success: (responseTxt) => {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Delete post successfully!");
                        window.location.href = '?controller=admin&action=posts';
                    } else {
                        alert("ERROR!");
                        return;
                    }


                },
                error: (status, responseTxt) => {
                    alert('Server error!');
                    // window.location.reload();
                }
            })

        } else {
            // Do nothing!
        }
    }
    // const editPost = (id) => {
    //     window.location.href = '?controller=admin&action=editPosts&_id=' + id;
    // }
</script>