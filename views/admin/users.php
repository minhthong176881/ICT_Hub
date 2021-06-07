<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Users
        </h2>
        <div class="search-wrapper">
            <span class="fas fa-search"></span>
            <input type="search" placeholder="Search here">
        </div>
        <div class="user-wrapper">
            <img src="assets/img/dominhthong.jpg" width="30px" height="30px" alt="">
            <div>
                <h4><?= $user_given_name?></h4>
                <p>Super Admin</p>
            </div>
        </div>
    </header>
    <main>
        <div class="">
            <!-- <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Posts</h3>
                        <button>See all <span class="fas fa-arrow-right"></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Post Title</td>
                                        <td>User</td>
                                        <td>Tag</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($posts as $post) {
                                    ?>
                                        <tr>
                                            <td><?= $post->title ? $post->title : "No title" ?></td>
                                            <td><?= $post?->author ? $post->author->given_name: "No user" ?></td>
                                            <td>
                                                <span class="status purple"></span>
                                                <?php
                                                if(($post->tags)){
                                                    foreach($post->tags as $tag){ ?>
                                                        <a href=""> <?= $tag->name ?></a> &ensp;
                                                        <?php
                                                    }
                                                    
                                                }
                                                else echo 'No tag';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <!-- <tr>
                                        <td>UI/UX Design</td>
                                        <td>UI Teams</td>
                                        <td>
                                            <span class="status purple"></span>
                                            review
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Web development</td>
                                        <td>Frontend</td>
                                        <td>
                                            <span class="status pink"></span>
                                            in progress
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ushop app</td>
                                        <td>Mobile Teams</td>
                                        <td>
                                            <span class="status orange"></span>
                                            pending
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>UI/UX Design</td>
                                        <td>UI Teams</td>
                                        <td>
                                            <span class="status purple"></span>
                                            review
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Web development</td>
                                        <td>Frontend</td>
                                        <td>
                                            <span class="status pink"></span>
                                            in progress
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ushop app</td>
                                        <td>Mobile Teams</td>
                                        <td>
                                            <span class="status orange"></span>
                                            pending
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>UI/UX Design</td>
                                        <td>UI Teams</td>
                                        <td>
                                            <span class="status purple"></span>
                                            review
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Web development</td>
                                        <td>Frontend</td>
                                        <td>
                                            <span class="status pink"></span>
                                            in progress
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ushop app</td>
                                        <td>Mobile Teams</td>
                                        <td>
                                            <span class="status orange"></span>
                                            pending
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h3>New users</h3>
                        <!-- <button>See all <span class="fas fa-arrow-right"></span></button> -->
                    </div>

                    <div class="card-body">
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4><?= $user->given_name ? $user->given_name : "No name" ?></h4>
                                        <small><?= $user->email ?></small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <!-- <span class="fas fa-users"></span> -->
                                    <!-- <span class="fas fa-phone"></span> -->
                                    <?php if ($user->external == true) {
                                        echo '<span class="fab fa-facebook"></span>';
                                    }
                                    ?>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-times" style="cursor: pointer;"
                                     onclick="deleteUser('<?= $user->_id ?>')"> </span>
                                    
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Lewis Hamilton</h4>
                                        <small>CEO Excerpt</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-users"></span>
                                    <span class="fas fa-phone"></span>
                                    <span class="fab fa-facebook"></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Lewis Hamilton</h4>
                                        <small>CEO Excerpt</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-users"></span>
                                    <span class="fas fa-phone"></span>
                                    <span class="fab fa-facebook"></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Lewis Hamilton</h4>
                                        <small>CEO Excerpt</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-users"></span>
                                    <span class="fas fa-phone"></span>
                                    <span class="fab fa-facebook"></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Lewis Hamilton</h4>
                                        <small>CEO Excerpt</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-users"></span>
                                    <span class="fas fa-phone"></span>
                                    <span class="fab fa-facebook"></span>
                                </div>
                            </div>
                            <div class="customer">
                                <div class="info">
                                    <img src="assets/img/nguyenduchung.jpg" width="40px" height="40px" alt="">
                                    <div>
                                        <h4>Lewis Hamilton</h4>
                                        <small>CEO Excerpt</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fas fa-users"></span>
                                    <span class="fas fa-phone"></span>
                                    <span class="fab fa-facebook"></span>
                                </div>
                            </div> -->

                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
<script>
    const deleteUser = (id) => {
        if (confirm('Do you really want to delete this user?')) {
            // Delete it!
            xhrPost(
                url = '?controller=admin&action=deleteUser',
                data = {
                    'id': id
                },
                success = function(responseTxt) {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Delete successfully!");
                        window.location.href = '?controller=admin&action=users';
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