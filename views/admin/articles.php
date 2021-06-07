<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Articles
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
                        <h3>New articles</h3>
                        <!-- <button>See all <span class="fas fa-arrow-right"></span></button> -->
                    </div>

                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <td style="justify-content: center;">No.</td>
                                    <td>Title</td>
                                    <td style="justify-content: center;">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($articles as $key => $article) {
                                ?>
                                    <tr>
                                        <td style="justify-content: center;"><?= $key ?></td>
                                        <td><?= $article->title ?></td>
                                        <td style="justify-content: center;"><span class="fas fa-times" style="cursor: pointer;" onclick="deleteArticle('<?= $article->_id ?>')"></span></td>
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
    const deleteArticle = (id) => {
        if (confirm('Do you really want to delete this article?')) {
            // Delete it!
            xhrPost(
                url = '?controller=admin&action=deleteArticle',
                data = {
                    'id': id
                },
                success = function(responseTxt) {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Delete successfully!");
                        window.location.href = '?controller=admin&action=articles';
                    } else {
                        alert("ERROR!");
                        return;
                    }


                },
                error = function(status, responseTxt) {
                    alert('Server error!');
                    // window.location.reload();
                }
            )

        } else {
            // Do nothing!

        }
    }
</script>