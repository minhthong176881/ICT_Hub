<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <i class="fas fa-bars"></i>
            </label>
            Subjects
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
                        <h3>New subjects</h3>
                        <button onclick="createSubject()">Create Subject <span class="fas fa-arrow-right"></span></button>
                    </div>

                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <td style="justify-content: center;">No.</td>
                                    <td>Name</td>
                                    <td>Description</td>
                                    <td style="justify-content: center;">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($subjects as $key => $subject) {
                                ?>
                                    <tr>
                                        <td style="justify-content: center;"><?= $key ?></td>
                                        <td><?= $subject->name ?></td>
                                        <td><?= $subject->description ?></td>
                                        <td style="justify-content: center;"><span class="fas fa-times" style="cursor: pointer;" onclick="deleteSubject('<?= $subject->_id ?>')"></span></td>
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
    const createSubject = () => {
            window.location.href = "?controller=admin&action=createSubject";
        }
    const deleteSubject = (id) => {
        if (confirm('Do you really want to delete this subject?')) {
            // Delete it!
            xhrPost({
                url: '?controller=admin&action=deleteSubject',
                data: {
                    'id': id
                },
                success: (responseTxt) => {
                    response = JSON.parse(responseTxt);
                    if (response.result == "OK") {
                        alert("Delete successfully!");
                        window.location.href = '?controller=admin&action=subjects';
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
</script>