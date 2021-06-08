<input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2> <span></span> <span>Admin page</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="?controller=admin&action=index#" <?= $file =='dashboard' ? 'class="active"' : '' ?>><span class="fas fa-tachometer-alt"></span>
                    <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=admin&action=users" <?= $file =='users' ? 'class="active"' : '' ?>><span class="fas fa-user"></span>
                    <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=admin&action=articles" <?= $file =='articles' ? 'class="active"' : '' ?>><span class="fas fa-project-diagram"></span>
                    <span>Articles</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=admin&action=subjects" <?= $file =='subjects' ? 'class="active"' : '' ?>><span class="fab fa-first-order"></span>
                    <span>Subjects</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=admin&action=posts" <?= $file =='posts' ? 'class="active"' : '' ?>><span class="fas fa-boxes"></span>
                    <span>Posts</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=admin&action=accounts" <?= $file =='accounts' ? 'class="active"' : '' ?>><span class="fas fa-user-circle"></span>
                    <span>Accounts</span>
                    </a>
                </li>
                <li>
                    <a href="/"><span class="fad fa-home"></span>
                    <span>Home Page</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>