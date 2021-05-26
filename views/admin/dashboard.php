<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Dashboard
        </h2>
        <div class="search-wrapper">
            <span class="fas fa-search"></span>
            <input type="search" placeholder="Search here">
        </div>
        <div class="user-wrapper">
            <img src="assets/img/dominhthong.jpg" width="30px" height="30px" alt="">
            <div>
                <h4>NhonDz</h4>
                <p>Super admin</p>
            </div>
        </div>
    </header>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1><?= $userCount ?></h1>
                    <span>Users</span>
                </div>
                <div>
                    <span class="fas fa-users"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?= $artileCount ?></h1>
                    <span>Articles</span>
                </div>
                <div>
                    <span class="fas fa-project-diagram"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?= $subjectCount ?></h1>
                    <span>Subjects</span>
                </div>
                <div>
                    <span class="fab fa-first-order"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?= $postCount ?></h1>
                    <span>Posts</span>
                </div>
                <div>
                    <span class="fas fa-mail-bulk"></span>
                </div>
            </div>
        </div>

        <div class="recent-grid">
            <div class="projects">
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
                                            <td><?= $post->user ? $post->user->username: "No user" ?></td>
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
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customers">
                <div class="card">
                    <div class="card-header">
                        <h3>New users</h3>
                        <button>See all <span class="fas fa-arrow-right"></span></button>
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